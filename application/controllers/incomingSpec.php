<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class IncomingSpec extends CW_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('grocery_CRUD');
		$this->load->library('PHPExcel');
		//三种类型
		$typeObj = $this->db->query("SELECT * FROM type");
		$typeArr = $typeObj->result_array();
		$typeArrWithAll = $this->array_switch2($typeArr, 'name', '(ALL)');
		$typeArr = $this->array_switch($typeArr,"name");
		$this->smarty->assign("typeArr",$typeArr);
		$this->smarty->assign("typeArrWithAll",$typeArrWithAll);
		
		//取得单位
		$unitObj = $this->db->query("SELECT * FROM unit");
		$unitArr = $unitObj->result_array();
		$unitArr = $this->array_switch($unitArr,"name");
		$this->smarty->assign("unitArr",$unitArr);
		//freqUnit
		$freqUnitArr = array('kHz' => 'kHz',
							 'MHz' => 'MHz',
							 'GHz' => 'GHz'
							);
		$this->smarty->assign("freqUnitArr",$freqUnitArr);
	}
	
	public function index($offset = 0, $order = null, $limit = 30)
	{
		//取得PartNo
		$partNoObj = $this->db->query("SELECT DISTINCT a.partno
									   FROM incomingspec a
									  ");
		$partNoArr = $partNoObj->result_array();
		$partNoArr = $this->array_switch1($partNoArr, 'partno', '(ALL)');
		$this->smarty->assign("partNoArr",$partNoArr);
		//取得Supplier
		$supplierObj = $this->db->query("SELECT DISTINCT a.supplier
										 FROM incomingspec a
										");
		$supplierArr = $supplierObj->result_array();
		$supplierArr = $this->array_switch1($supplierArr, 'supplier', '(ALL)');
		$this->smarty->assign("supplierArr",$supplierArr);
		
		$partnoSql = '';
		$partNo = emptyToNull($this->input->post("partno"));
		if($partNo != "")
		{
			$partnoSql = " AND a.partno = '".$partNo."'";
		}
		$supplierSql = '';
		$supplier = emptyToNull($this->input->post("supplier"));
		if($supplier != "")
		{
			$supplierSql = " AND a.supplier = '".$supplier."'";
		}
		$typeSql = '';
		$type = emptyToNull($this->input->post("type"));
		if($type != '')
		{
			$typeSql = " AND a.type = ".$type;
		}
		$orderSql = '';
		$assignorderby = $order;
		switch ($order) 
		{
			case null:
				$orderSql = ' ORDER BY a.id DESC';
				break;
			case 'partno':
				$orderSql = ' ORDER BY a.partno ASC';
				$assignorderby = 'partnodesc';
				break;
			case 'partnodesc':
				$orderSql = ' ORDER BY a.partno DESC';
				$assignorderby = 'partno';
				break;
			case 'supplier':
				$orderSql = ' ORDER BY a.supplier ASC';
				$assignorderby = 'supplierdesc';
				break;
			case 'supplierdesc':
				$orderSql = ' ORDER BY a.supplier DESC';
				$assignorderby = 'supplier';
				break;
			case 'description':
				$orderSql = ' ORDER BY a.description ASC';
				$assignorderby = 'descriptiondesc';
				break;
			case 'descriptiondesc':
				$orderSql = ' ORDER BY a.description DESC';
				$assignorderby = 'description';
				break;
			case 'type':
				$orderSql = ' ORDER BY c.name ASC';
				$assignorderby = 'typedesc';
				break;
			case 'typedesc':
				$orderSql = ' ORDER BY c.name DESC';
				$assignorderby = 'type';
				break;
			case 'testvoltage':
				$orderSql = ' ORDER BY a.testvoltage ASC';
				$assignorderby = 'testvoltagedesc';
				break;
			case 'testvoltagedesc':
				$orderSql = ' ORDER BY a.testvoltage DESC';
				$assignorderby = 'testvoltage';
				break;
			case 'testfrequency':
				$orderSql = ' ORDER BY a.testfrequency ASC';
				$assignorderby = 'testfrequencydesc';
				break;
			case 'testfrequencydesc':
				$orderSql = ' ORDER BY a.testfrequency DESC';
				$assignorderby = 'testfrequency';
				break;
			case 'residualinductance':
				$orderSql = ' ORDER BY a.residualinductance ASC';
				$assignorderby = 'residualinductancedesc';
				break;
			case 'residualinductancedesc':
				$orderSql = ' ORDER BY a.residualinductance DESC';
				$assignorderby = 'residualinductance';
				break;
			case 'nominalvalue':
				$orderSql = ' ORDER BY a.nominalvalue ASC';
				$assignorderby = 'nominalvaluedesc';
				break;
			case 'nominalvaluedesc':
				$orderSql = ' ORDER BY a.nominalvalue DESC';
				$assignorderby = 'nominalvalue';
				break;
			case 'unit':
				$orderSql = ' ORDER BY b.name ASC';
				$assignorderby = 'unitdesc';
				break;
			case 'unitdesc':
				$orderSql = ' ORDER BY b.name DESC';
				$assignorderby = 'unit';
				break;
			case 'tolerance':
				$orderSql = ' ORDER BY a.tolerance ASC';
				$assignorderby = 'tolerancedesc';
				break;
			case 'tolerancedesc':
				$orderSql = ' ORDER BY a.tolerance DESC';
				$assignorderby = 'tolerance';
				break;
			case 'tolerancenum':
				$orderSql = ' ORDER BY a.tolerancenum ASC';
				$assignorderby = 'tolerancenumdesc';
				break;
			case 'tolerancenumdesc':
				$orderSql = ' ORDER BY a.tolerancenum DESC';
				$assignorderby = 'tolerancenum';
				break;
			default:
				break;
		}
		
		$incomingspecSql = "SELECT a.*,b.name,c.name AS typename
						    FROM incomingspec a
						    JOIN unit b ON a.unit = b.id
						    JOIN type c ON a.type = c.id"
							.$partnoSql.$supplierSql.$typeSql.$orderSql;
		$incomingspecObj = $this->db->query($incomingspecSql);
		$incomingspecArr = $incomingspecObj->result_array();
		
		$totalcount = count($incomingspecArr);
		$this->load->library('pagination');
		$config['full_tag_open'] = '<div class="locPage">';
		$config['full_tag_close'] = '</div>';
		$config['base_url'] = '';
		$config['uri_segment'] = 3;
		$config['total_rows'] = count($incomingspecArr);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$incomingspecSql = $incomingspecSql." LIMIT ".$offset.",".$limit;
		$incomingspecObj = $this->db->query($incomingspecSql);
		$incomingspecArr = $incomingspecObj->result_array();
		

		$this->smarty->assign("assignorderby",$assignorderby);
		$this->smarty->assign("incomingspecArr",$incomingspecArr);
		$this->smarty->assign("currenmenu","incomingspect");
		$this->smarty->display("incomingSpec.tpl");
	}
	
	public function incomingSpecPost()
	{
		if(count($_POST) == 0)
		{
			$this->index();
		}
		else
		{
			$deleteId = '';
			foreach ($_POST as $key => $value) 
			{
				$deleteId .= substr($key, 8).',';
			}
			$deleteId = substr($deleteId, 0, -1);
			$this->db->query("DELETE FROM incomingspec WHERE id IN (".$deleteId.")");
			$this->index();
		}
	}
	
	public function createGet()
	{
		//取得单位
		$unitObj = $this->db->query("SELECT a.* FROM unit a
									JOIN type b ON a.type = b.id
									AND b.name = 'Ind' ");
		$unitArrCreat = $unitObj->result_array();
		$unitArrCreat = $this->array_switch($unitArrCreat,"name");
		$this->smarty->assign("unitArrCreat",$unitArrCreat);
		
		$this->smarty->assign("currenmenu","incomingspect");
		$this->smarty->display("incomingSpecCreate.tpl");
	}
	
	public function createPost()
	{
		$err = "";
		$partno = emptyToNull($this->input->post("partno"));
		if($partno == '')
		{
			$err .= 'Part No is required<br>';
		}
		else
		{
			$partnoRecordObj = $this->db->query("SELECT id FROM incomingspec WHERE partno = ?",$partno);
			$partnoRecordArr = $partnoRecordObj->result_array();
			if(count($partnoRecordArr) != 0)
			{
				$err .= 'Part No already exists<br>';
			}
		}
		$supplier = emptyToNull($this->input->post("supplier"));
		if($supplier == '')
		{
			$err .= 'supplier No is required<br>';
		}
		$description = emptyToNull($this->input->post("description"));
		$type = emptyToNull($this->input->post("type"));
		$testvoltage = emptyToNull($this->input->post("testvoltage"));
		if($testvoltage != '')
		{
			if(is_numeric($testvoltage))
			{
				$testvoltage = $testvoltage.'Vdc';
			}
			else
			{
				$err .= "Incorrect fortmart Of Test voltage<br>";
			}
		}
		$frequencyvalue = emptyToNull($this->input->post("frequencyvalue"));
		$frequnit = emptyToNull($this->input->post("frequnit"));
		$testfrequency = '';
		if($frequencyvalue != '')
		{
			if(is_numeric($frequencyvalue))
			{
				$testfrequency = $frequencyvalue.$frequnit;
			}
			else
			{
				$err .= "Incorrect fortmart Of Test Freq<br>";
			}
		}
		$residualinductance = emptyToNull($this->input->post("residualinductance"));
		if($residualinductance != '')
		{
			if(!is_numeric($residualinductance))
			{
				$err .= "Incorrect fortmart Of Residual inductance<br>";
			}
		}
		$nominalvalue = emptyToNull($this->input->post("nominalvalue"));
		if($nominalvalue != '')
		{
			if(!is_numeric($nominalvalue))
			{
				$err .= "Nomimal Value must number<br>";
			}
		}
		else
		{
			$err .= "Nomimal Value is required<br>";
		}
		$unit = $this->input->post("unit");
		$tolerance = emptyToNull($this->input->post("tolerance"));
		if($tolerance != '')
		{
			if(!is_numeric($tolerance))
			{
				$err .= "Tol must number<br>";
			}
		}
		$tolerancenum = emptyToNull($this->input->post("tolerancenum"));
		if($tolerancenum != '')
		{
			if(!is_numeric($tolerancenum))
			{
				$err .= "Tol Num must number<br>";
			}
		}
		if($err != '')
		{
			//取得单位
			$unitObj = $this->db->query("SELECT a.* FROM unit a
										JOIN type b ON a.type = b.id
										AND b.name = 'Ind' ");
			$unitArrCreat = $unitObj->result_array();
			$unitArrCreat = $this->array_switch($unitArrCreat,"name");
			$this->smarty->assign("unitArrCreat",$unitArrCreat);
			$this->smarty->assign("errmesg",$err);
			$this->smarty->assign("currenmenu","incomingspect");
			$this->smarty->display("incomingSpecCreate.tpl");
		}
		else
		{
			$insertSql = "INSERT INTO `incomingspec` (`partno`, `supplier`, `description`, `type`, `testvoltage`, `testfrequency`, `nominalvalue`, `unit`, `tolerance`, `tolerancenum`, `residualinductance`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
			$this->db->query($insertSql, array(
									$partno,
									$supplier,
									$description,
									$type,
									$testvoltage,
									$testfrequency,
									$nominalvalue,
									$unit,
									$tolerance,
									$tolerancenum,
									$residualinductance
								));
			$this->index();
		}
	}
	
	public function editGet($var = 0)
	{
		$id = $var;
		$incomingRecordSql = "SELECT a.*,b.id AS unitid
							  FROM incomingspec a
						      JOIN unit b ON a.unit = b.id
						      AND a.id = ".$id;
		$incomingRecordObj = $this->db->query($incomingRecordSql);
		$incomingRecord = $incomingRecordObj->first_row("array");
		
		//取得单位
		$unitObj = $this->db->query("SELECT a.* FROM unit a
									JOIN type b ON a.type = b.id
									AND b.id = ".$incomingRecord['type']);
		$unitArrEdit = $unitObj->result_array();
		$unitArrEdit = $this->array_switch($unitArrEdit,"name");
		$this->smarty->assign("unitArrEdit",$unitArrEdit);
		
		$this->smarty->assign("incomingRecord",$incomingRecord);
		$this->smarty->assign("currenmenu","incomingspect");
		$this->smarty->display("incomingSpecEdit.tpl");
	}
	
	public function editPost()
	{
		$incomingSpecId = emptyToNull($this->input->post("incomingSpecId"));
		$err = "";
		
		$partno = emptyToNull($this->input->post("partno"));
		if($partno == '')
		{
			$err .= 'Part No is required<br>';
		}
		else
		{
			$partnoRecordObj = $this->db->query("SELECT id FROM incomingspec WHERE partno = ? AND id != ?",array($partno,$incomingSpecId));
			$partnoRecordArr = $partnoRecordObj->result_array();
			if(count($partnoRecordArr) != 0)
			{
				$err .= "Part No '".$partno."' already exists<br>";
			}
		}
		$supplier = emptyToNull($this->input->post("supplier"));
		if($supplier == '')
		{
			$err .= 'supplier No is required<br>';
		}
		
		$description = emptyToNull($this->input->post("description"));
		$type = emptyToNull($this->input->post("type"));
		$testvoltage = emptyToNull($this->input->post("testvoltage"));
		if($testvoltage != '')
		{
			if(is_numeric($testvoltage))
			{
				$testvoltage = $testvoltage.'Vdc';
			}
			else
			{
				$err .= "Incorrect fortmart Of Test voltage '".$testvoltage."'<br>";
			}
		}
		
		$frequencyvalue = emptyToNull($this->input->post("frequencyvalue"));
		$frequnit = emptyToNull($this->input->post("frequnit"));
		$testfrequency = '';
		if($frequencyvalue != '')
		{
			$testfrequency = $frequencyvalue.$frequnit;
		}

		$residualinductance = emptyToNull($this->input->post("residualinductance"));
		
		$nominalvalue = emptyToNull($this->input->post("nominalvalue"));

		$unit = $this->input->post("unit");
		$tolerance = emptyToNull($this->input->post("tolerance"));
		
		$tolerancenum = emptyToNull($this->input->post("tolerancenum"));
		
		if($err != '')
		{
			
			$incomingRecordSql = "SELECT a.*,b.id AS unitid
							  FROM incomingspec a
						      JOIN unit b ON a.unit = b.id
						      AND a.id = ".$incomingSpecId;
			$incomingRecordObj = $this->db->query($incomingRecordSql);
			$incomingRecord = $incomingRecordObj->first_row("array");
			
			//取得单位
			$unitObj = $this->db->query("SELECT a.* FROM unit a
										JOIN type b ON a.type = b.id
										AND b.id = ".$incomingRecord['type']);
			$unitArrEdit = $unitObj->result_array();
			$unitArrEdit = $this->array_switch($unitArrEdit,"name");
			$this->smarty->assign("unitArrEdit",$unitArrEdit);
			
			$this->smarty->assign("incomingRecord",$incomingRecord);
			$this->smarty->assign("errmesg",$err);
			$this->smarty->assign("currenmenu","incomingspect");
			$this->smarty->display("incomingSpecEdit.tpl");
		}
		else
		{
			$incomingSpecSql = "UPDATE `incomingspec` SET 
				  			`partno` = ? ,
				  			`supplier` = ?,
				  			`description` = ?,
				  			`type` = ?,
				  			`testvoltage` = ?,
				  			`testfrequency` = ?,
				  			`nominalvalue` = ?,
				 		 	`unit` = ?,
				  			`tolerance` = ?,
				  			`tolerancenum` = ?,
				  			`residualinductance` = ? WHERE id = ?";
			$this->db->query($incomingSpecSql, array(
								$partno,
								$supplier,
								$description,
								$type,
								$testvoltage,
								$testfrequency,
								$nominalvalue,
								$unit,
								$tolerance,
								$tolerancenum,
								$residualinductance,
								$incomingSpecId
						    ));
			$this->index();
		}
	}
	
	public function delete($var)
	{
		$incomingSpecId = $var;
		$this->db->query("DELETE FROM incomingspec WHERE id = ?",$incomingSpecId);
		$this->index();
	}
	
	public function importConfigGet()
	{
		$this->smarty->assign("currenmenu","incomingspect");
		$this->smarty->display("incomingSpecImportConfig.tpl");
	}
	
	public function importConfigPost()
	{
		$file_name = $_FILES['file']['name'];
		$file_temp = $_FILES['file']['tmp_name'];
		$temp = explode(".", $file_name);
		$extension = end($temp);
		if($extension == 'xls' || $extension == 'xlsx')
		{
			$root = getcwd();
			$slash = "\\";
			$fileRoot = $root.$slash."assets".$slash."uploadedSource";
			$filestatus = @move_uploaded_file($file_temp, iconv('utf-8', 'gbk', $fileRoot.$slash.$file_name));
			if (!$filestatus)
			{
				$this->smarty->assign("currenmenu","incomingspect");
				$this->smarty->assign("errmesg","Save File Failed.");
				$this->smarty->display("incomingSpecImportConfig.tpl");
			}
			else
			{
				$fileRoot_name = iconv('utf-8', 'gbk', $fileRoot.$slash.$file_name);
				try 
				{
				    $inputFileType = PHPExcel_IOFactory::identify($fileRoot_name);
				    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
				    $objPHPExcel = $objReader->load($fileRoot_name);
				}
				catch(Exception $e) 
				{
					$this->smarty->assign("currenmenu","incomingspect");
					$this->smarty->assign("errmesg",$e->getMessage());
					$this->smarty->display("incomingSpecImportConfig.tpl");
					return;
				}
				
				//  Get worksheet dimensions
				
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();
				//col names
				$partNoTitle = '';
				$supplierTitle = '';
				$descriptionTitle = '';
				$typeTitle = '';
				$voltageTitle = '';
				$frquencyTitle = '';
				$nominaValueTitle = '';
				$toleranceTitle = '';
				$adjustTitle = '';
				//col values
				$partNo = '';
				$supplier = '';
				$description = '';
				$type = '';
				$voltage = '';
				$frquency = '';
				$nominaValue = '';
				$unit = '';
				$tolerance = '';
				$toleranceNum = '';
				$adjust = '';
				//check col num
				if($highestColumn == 'I')
				{
					//get first row
					$rowDataTitle = $sheet->rangeToArray('A1:'.$highestColumn.'1',NULL,TRUE,FALSE);
					//col names
					$partNoTitle = $rowDataTitle[0][0];
					$supplierTitle = $rowDataTitle[0][1];
					$descriptionTitle = $rowDataTitle[0][2];
					$typeTitle = $rowDataTitle[0][3];
					$voltageTitle = $rowDataTitle[0][4];
					$frquencyTitle = $rowDataTitle[0][5];
					$adjustTitle = $rowDataTitle[0][6];
					$nominaValueTitle = $rowDataTitle[0][7];
					$toleranceTitle = $rowDataTitle[0][8];
					//check excel col name
					if($partNoTitle == 'Part No.')
					{
						//error detail
						$errDetailTotal = '';
						$valSql = '';
						$partnoArr = array();
						//partno in db
						$partnoArrDbObj = $this->db->query("SELECT 
															DISTINCT a.partno
															FROM incomingspec a
														   ");
						$partnoArrDb = $partnoArrDbObj->result_array();
						$partnoInDb = array();
						foreach ($partnoArrDb as $key => $value) 
						{
							array_push($partnoInDb,$value['partno']);
						}
						//  Loop through each row of the worksheet in turn
						for ($row = 2; $row <= $highestRow; $row++)
						{
							$errDetail = '';
							
						    $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
							
							if(trim($rowData[0][0]) == '' && trim($rowData[0][1]) == '' && trim($rowData[0][2]) == '' && $rowData[0][3] == '' && $rowData[0][4] == '' && $rowData[0][5] == '' && $rowData[0][6] == '' && $rowData[0][7] == '' && $rowData[0][8] == '')
							{
								//
							}
							else
							{
								if(trim($rowData[0][0]) != '')
							    {
							    	$partNo = trim($rowData[0][0]);
									if(in_array($partNo, $partnoArr))
									{
										$errDetail .= $partNoTitle.' already exist in your excel file,';
									}
									else
									{
										array_push($partnoArr,$partNo);
										if(in_array($partNo, $partnoInDb))
										{
											$errDetail .= $partNoTitle.' already exist in your system,';
										}
									}
							    }
							    else
							    {
							    	$errDetail .= $partNoTitle.',';
							    }
								
								if(trim($rowData[0][1]) != '')
								{
									$supplier = trim($rowData[0][1]);
								}
								else
								{
									$errDetail .= $supplierTitle.',';
								}
								
								$description = $rowData[0][2];
								
								switch (strtolower(trim($rowData[0][3]))) 
								{
									case 'inductor':
										$type = 1;
										break;
									case 'resistor':
										$type = 3;
										break;
									case 'capacitor':
										$type = 2;
										break;
									default:
										$errDetail .= $typeTitle.',';
										break;
								}
	
								$voltage = trim($rowData[0][4]);
								
								if($voltage != '')
								{
									if(strtolower($voltage) == 'na')
									{
										$voltage = '';
									}
									else
									{
										$voltageVal = substr($voltage, 0, -3);
										$voltageUnit = strtolower(substr($voltage, -3));
										if(!(is_numeric($voltageVal) && $voltageUnit == 'vdc'))
										{
											$errDetail .= $voltageTitle.',';
										}
									}
								}
								
								$frquency = trim($rowData[0][5]);
								if($frquency != '')
								{
									if(strtolower($frquency) == 'na')
									{
										$frquency = '';
									}
									else
									{
										$frquencyVal = substr($frquency, 0, -3);
										$frquencyUnit = strtolower(substr($frquency, -3));
										$frquencyUnitArr = array('khz','mhz','ghz');
										if(is_numeric($frquencyVal) && in_array($frquencyUnit , $frquencyUnitArr))
										{
											if($frquencyUnit == 'khz')
											{
												$frquency = $frquencyVal.'kHz';
											}
											elseif($frquencyUnit == 'mhz')
											{
												$frquency = $frquencyVal.'MHz';
											}
											else
											{
												$frquency = $frquencyVal.'GHz';
											}
										}
										else
										{
											$errDetail .= $frquencyTitle.',';
										}
									}
								}
								
								$nominaValue = trim($rowData[0][7]);
								
								if($nominaValue != '')
								{
									if(is_numeric($nominaValue) || is_numeric(substr($nominaValue, 0, -1)))
									{
										// type = Inductor
										if($type == 1)
										{
											if(is_numeric($nominaValue))
											{
												$nominaValue = $nominaValue;
											}
											else
											{
												$nominaValue = substr($nominaValue, 0, -1);
											}									
											$unit = 8;
										}
										//type = Capacitor
										elseif($type == 2)
										{
											if(is_numeric($nominaValue))
											{
												$nominaValue = $nominaValue;
											}
											else
											{
												$nominaValue = substr($nominaValue, 0, -1);
											}							
											$unit = 9;
										}
										//type = Resistor
										else if($type == 3)
										{
											if(is_numeric($nominaValue))
											{
												$nominaValue = $nominaValue;
											}
											else
											{
												$nominaValue = substr($nominaValue, 0, -1);
											}
											$unit = 1;
										}
										else
										{
											$errDetail .= $nominaValueTitle.',';
										}
									}
									elseif(is_numeric(substr($nominaValue, 0, -2)))
									{
										$nominaValue = substr($nominaValue, 0, -2);
										$part2 = substr($rowData[0][7], -2);
										$arrOhm = array('Ω','KΩ','kΩ','MΩ','mΩ','GΩ','gΩ');
										if(in_array($part2, $arrOhm))
										{
											if($part2 == 'Ω')
											{
												$unit = 1;
											}
											elseif($part2 == 'kΩ' || $part2 == 'KΩ')
											{
												$unit = 2;
											}
											elseif($part2 == 'MΩ' || $part2 == 'mΩ')
											{
												$unit = 3;
											}
											else
											{
												$unit = 4;
											}
										}
										else
										{
											$part2Lower = strtolower(substr(trim($rowData[0][7]), -2));
											switch ($part2Lower) {
												case 'mh':
													$unit = 6;
													break;
												case 'uh':
													$unit = 7;
													break;
												case 'nh':
													$unit = 8;
													break;
												case 'pf':
													$unit = 10;
													break;
												case 'uf':
													$unit = 11;
													break;
												case 'nf':
													$unit = 12;
													break;
												default:
													$errDetail .= $nominaValueTitle.' Unit should one of (Ω/kΩ/MΩ/GΩ/mh/uh/nh/pF/uF/nF) or null,';
													break;
											}
										}
									}
									elseif(is_numeric(substr($nominaValue, 0, -3)))
									{
										$nominaValue = substr($nominaValue, 0, -3);
										$part2 = substr($rowData[0][7], -3);
										$arrOhm = array('Ω','KΩ','kΩ','MΩ','mΩ','GΩ','gΩ');
										if(in_array($part2, $arrOhm))
										{
											if($part2 == 'Ω')
											{
												$unit = 1;
											}
											elseif($part2 == 'kΩ' || $part2 == 'KΩ')
											{
												$unit = 2;
											}
											elseif($part2 == 'MΩ' || $part2 == 'mΩ')
											{
												$unit = 3;
											}
											else
											{
												$unit = 4;
											}
										}
										else
										{
											$part2Lower = strtolower(substr(trim($rowData[0][7]), -2));
											switch ($part2Lower) {
												case 'mh':
													$unit = 6;
													break;
												case 'uh':
													$unit = 7;
													break;
												case 'nh':
													$unit = 8;
													break;
												case 'pf':
													$unit = 10;
													break;
												case 'uf':
													$unit = 11;
													break;
												case 'nf':
													$unit = 12;
													break;
												default:
													$errDetail .= $nominaValueTitle.' Unit should one of (Ω/kΩ/MΩ/GΩ/mh/uh/nh/pF/uF/nF) or null,';
													break;
											}
										}
									}
									else
									{
										$errDetail .= $nominaValueTitle.' incrrect formart,';
									}
								}
								else
								{
									$errDetail .= $nominaValueTitle.',';
								}
								
								$tolerance = $rowData[0][8];
								
								if($rowData[0][8] != '')
								{
									if(strpos($rowData[0][8], '%') != FALSE)
									{
										if(is_numeric(substr($rowData[0][8], 3, -1)))
										{
											$tolerance = substr($rowData[0][8], 3, -1);
											if($nominaValue != '')
											{
												$toleranceNum = $nominaValue*$tolerance/100;
											}
										}
										else
										{
											$errDetail .= $toleranceTitle.',';
										}	
									}
									else
									{
										if($nominaValue != '')
										{
											if(is_numeric(substr($rowData[0][8], 3)))
											{
												$toleranceNum = substr($rowData[0][8], 3);
												if($nominaValue == 0)
												{
													$tolerance = '';
												}
												else
												{
													$tolerance = $toleranceNum/$nominaValue*100;
												}
											}
											elseif(is_numeric(substr($rowData[0][8], 3, -1)))
											{
												$toleranceNum = substr($rowData[0][8], 3, -1);
												if($nominaValue == 0)
												{
													$tolerance = '0';
												}
												else
												{
													$tolerance = $toleranceNum/$nominaValue*100;
												}	
											}
											elseif(is_numeric(substr($rowData[0][8], 3, -2)))
											{
												$toleranceNum = substr($rowData[0][8], 3, -2);
												if($nominaValue == 0)
												{
													$tolerance = '0';
												}
												else
												{
													$tolerance = $toleranceNum/$nominaValue*100;
												}
											}
											elseif(is_numeric(substr($rowData[0][8], 3, -3)))
											{
												$toleranceNum = substr($rowData[0][8], 3, -3);
												if($nominaValue == 0)
												{
													$tolerance = '';
												}
												else
												{
													$tolerance = $toleranceNum/$nominaValue*100;
												}
											}
											else
											{
												$errDetail .= $toleranceTitle.',';
											}
										}
									}
								}
								else
								{
									$errDetail .= $toleranceTitle.',';
								}
								
								$adjust = trim($rowData[0][6]);
								
								if($type !== 1)
								{
									if($adjust != '')
									{
										$errDetail .= $adjustTitle.',';
									}
								}
								else
								{
									if($adjust != '')
									{
										$adjustVal = '';
										for ($i=0; $i < strlen($adjust); $i++) 
										{ 
											$adjustSub = substr($adjust, 0 ,strlen($adjust)-$i);
											if(is_numeric($adjustSub))
											{
												$adjustVal = $adjustSub;
												break;
											}
										}
										if($adjustVal == '')
										{
											$errDetail .= $adjustTitle.',';
										}
										else
										{
											$adjust = $adjustVal;
										}
									}
								}
							
								if($errDetail == '')
								{
									$valSql .= " ('".$partNo."','".$supplier."','".$description."','".$type."','".$voltage."','".$frquency."','".$nominaValue."','".$unit."','".$tolerance."','".$toleranceNum."','".$adjust."'), ";
								}
								else
								{
									$errDetailTotal .= 'Row'.$row.':'.substr($errDetail, 0, -1).'<br>';
								}
							}
							//return;
						}
													
						if($errDetailTotal != '')
						{
							$errDetailTotal = 'Import Failed.<br/>Detail:<br/>'.$errDetailTotal;
							unlink($fileRoot_name);
							$this->smarty->assign("currenmenu","incomingspect");
							$this->smarty->assign("errmesg",$errDetailTotal);
							$this->smarty->display("incomingSpecImportConfig.tpl");
						}
						else
						{
							$valSql = substr($valSql, 0, -2);
							$incomingSpecSql = 'INSERT INTO 
												`incomingspec`
												(`partno`, 
												 `supplier`, 
												 `description`, 
												 `type`, 
												 `testvoltage`, 
												 `testfrequency`, 
												 `nominalvalue`, 
												 `unit`,
												 `tolerance`, 
												 `tolerancenum`, 
												 `residualinductance`) 
												 VALUES'.$valSql;
							$this->db->query($incomingSpecSql);
							unlink($fileRoot_name);
							$this->index();
						}
					}
					else
					{
						$this->smarty->assign("currenmenu","incomingspect");
						$this->smarty->assign("errmesg",'The column in your file is incorrect.');
						$this->smarty->display("incomingSpecImportConfig.tpl");
						return;
					}
				}
				else
				{
					$this->smarty->assign("currenmenu","incomingspect");
					$this->smarty->assign("errmesg",'The number of column in your file is incorrect.');
					$this->smarty->display("incomingSpecImportConfig.tpl");
					return;
				}
			}
		}
		else
		{
			$this->smarty->assign("currenmenu","incomingspect");
			$this->smarty->assign("errmesg","Plese Import .xls or .xlsx File.");
			$this->smarty->display("incomingSpecImportConfig.tpl");
		}
		//$this->smarty->assign("currenmenu","incomingspect");
		//$this->smarty->display("incomingSpecImportConfig.tpl");	
	}
	
	
	
	public function exportConfig()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Shanghai');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', 'Part No.')
		            ->setCellValue('B1', 'Supplier')
		            ->setCellValue('C1', 'Material description')
		            ->setCellValue('D1', 'Type')
					->setCellValue('E1', 'Test voltageZ(Ca..)')
					->setCellValue('F1', 'test frequency(ind)')
					->setCellValue('G1', 'Residual inductance')
					->setCellValue('H1', 'Nominal value')
					->setCellValue('I1', 'Tolerance');
		
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		
		$incomingSpecSql = "SELECT a.*,b.name AS typename,c.name AS unitname
							FROM 
							incomingspec a
							JOIN type b ON a.type = b.id
							JOIN unit c ON a.unit = c.id";
		$incomingSpecObj = $this->db->query($incomingSpecSql);
		$incomingSpecArr = $incomingSpecObj->result_array();
		
		if(count($incomingSpecArr) != 0)
		{
			$i = 2;
			foreach ($incomingSpecArr as $value) 
			{
				$typename = "";
				switch ($value['typename']) 
				{
					case 'Ind':
						$typename = 'Inductor';
						break;
					case 'Cap':
						$typename = 'Capacitor';
						break;
					case 'Res':
						$typename = 'Resistor';
						break;
					default:
						break;
				}
				$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A'.$i, $value['partno'])
		            ->setCellValue('B'.$i, $value['supplier'])
		            ->setCellValue('C'.$i, $value['description'])
		            ->setCellValue('D'.$i, $typename)
					->setCellValue('E'.$i, $value['testvoltage'])
					->setCellValue('F'.$i, $value['testfrequency'])
					->setCellValue('G'.$i, $value['residualinductance'])
					->setCellValue('H'.$i, $value['nominalvalue'].$value['unitname'])
					->setCellValue('I'.$i, '+/-'.$value['tolerance'].'%');
				$i++;
			}
		}
		// Redirect output to a client’s web browser (Excel5)
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="IncomingSpec.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
	
	public function downloadTemplete()
	{
		$root = getcwd();
		$fileRoot = $root."\\doc\\template.xls";
		$fileName = "template.xls";
		
		if(!file_exists($fileRoot))
		{
			die("Error:Templete not found.");
		}
		else
		{
			header("Pragma: public");
   			header("Expires: 0");
    		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    		header("Cache-Control: public");
    		header("Content-Description: File Transfer");
    		header('Content-Type: application/vnd.ms-excel');
    		header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");
    		header("Content-Transfer-Encoding: binary");
    		header("Content-Length: " . filesize($fileRoot));
    		ob_end_flush();
			@readfile($fileRoot);
		}	
	}
	
	private function _checkDataFormat(&$var)
	{
		$this->lang->load('form_validation', 'english');
		$this->load->library('form_validation');
		$config = array(
			array(
				'field'=>'username',
				'label'=>'Username',
				'rules'=>'required|callback_checkUsername1'
			),
			array(
				'field'=>'password',
				'label'=>'Password',
				'rules'=>'required|alpha_numeric|min_length[6]|max_length[20]'
			)
		);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('*', '<br>');
		if ($this->form_validation->run() == FALSE)
		{
			$var = validation_errors();
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function getUnit($type)
	{
		$unit = '';
		$unitObj = $this->db->query("SELECT a.id,a.name
						  FROM unit a
						  JOIN type b 
						  ON a.type = b.id
						  AND a.type = ".$type);
		$unitArry = $unitObj->result_array();
		foreach ($unitArry as $value) 
		{
			$unit .= '<option class="unit option" value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		echo $unit;
	}
	
	public function getType($unit)
	{
		$type = '';
		$typeObj = $this->db->query("SELECT a.id,a.name
						  FROM type a
						  JOIN unit b 
						  ON b.type = a.id
						  AND b.id = ".$unit);
		$typeArry = $typeObj->result_array();
		foreach ($typeArry as $value) 
		{
			$type .= '<option class="unit option" value="'.$value['id'].'">'.$value['name'].'</option>';
		}
		echo $type;
	}
	
	private function array_switch($var1,$var2)
	{
		$arr = array();
		foreach($var1 as $val)
		{
			$arr += array($val['id'] => $val[$var2]);
		}
		
		return $arr;
	}
	
	protected function array_switch1($var1, $var2, $var3)
	{
		$arr = array("" => $var3);
		foreach ($var1 as $value) 
		{
			$arr = $arr + array($value[$var2] => $value[$var2]);
		}
		return $arr;
	}
	
	protected function array_switch2($var1, $var2, $var3)
	{
		$arr = array("" => $var3);
		foreach ($var1 as $value) 
		{
			$arr = $arr + array($value['id'] => $value[$var2]);
		}
		return $arr;
	}
}
