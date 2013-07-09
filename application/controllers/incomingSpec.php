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
		$typeArr = $this->array_switch($typeArr,"name");
		$this->smarty->assign("typeArr",$typeArr);
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
	
	public function index($offset = 0, $limit = 30)
	{
		$incomingspecSql = "SELECT a.*,b.name,c.name AS typename
						    FROM incomingspec a
						    JOIN unit b ON a.unit = b.id
						    JOIN type c ON a.type = c.id";
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
		
		$this->smarty->assign("incomingspecArr",$incomingspecArr);
		$this->smarty->assign("currenmenu","incomingspect");
		$this->smarty->display("incomingSpec.tpl");
	}
	
	public function createGet()
	{
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
			if(substr($testvoltage, -3) != 'Vdc' || !is_numeric(substr($testvoltage, 0, -3)))
			{
				$err .= 'Incorrect fortmart Of Test Voltage<br>';
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
		$this->smarty->assign("incomingRecord",$incomingRecord);
		$this->smarty->assign("currenmenu","incomingspect");
		$this->smarty->display("incomingSpecEdit.tpl");
	}
	
	public function editPost()
	{
		$incomingSpecId = emptyToNull($this->input->post("incomingSpecId"));
		$err = "";
		$partno = emptyToNull($this->input->post("partno"));

		$supplier = emptyToNull($this->input->post("supplier"));

		$description = emptyToNull($this->input->post("description"));
		$type = emptyToNull($this->input->post("type"));
		$testvoltage = emptyToNull($this->input->post("testvoltage"));

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
						//  Loop through each row of the worksheet in turn
						for ($row = 2; $row <= $highestRow; $row++)
						{
							$errDetail = '';
							
						    $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
							
							if($rowData[0][0] == '' && $rowData[0][1] == '' && $rowData[0][2] == '' && $rowData[0][3] == '' && $rowData[0][4] == '' && $rowData[0][5] == '' && $rowData[0][6] == '' && $rowData[0][7] == '' && $rowData[0][8] == '')
							{
								//
							}
							else
							{
								if($rowData[0][0] != '')
							    {
							    	$partNo = $rowData[0][0];
							    }
							    else
							    {
							    	$errDetail .= $partNoTitle.',';
							    }
								
								if($rowData[0][1] != '')
								{
									$supplier = $rowData[0][1];
								}
								else
								{
									$errDetail .= $supplierTitle.',';
								}
								
								$description = $rowData[0][2];
								
								switch ($rowData[0][3]) 
								{
									case 'Inductor':
										$type = 1;
										break;
									case 'Resistor':
										$type = 3;
										break;
									case 'Capacitor':
										$type = 2;
										break;
									default:
										$errDetail .= $typeTitle.',';
										break;
								}
	
								$voltage = $rowData[0][4];
								
								if($voltage != '')
								{
									if($voltage == 'NA')
									{
										$voltage = '';
									}
									else
									{
										$voltageVal = substr($voltage, 0, -3);
										$voltageUnit = substr($voltage, -3);
										if(!(is_numeric($voltageVal) && $voltageUnit == 'Vdc'))
										{
											$errDetail .= $voltageTitle.',';
										}
									}
								}
								
								$frquency = $rowData[0][5];
								
								$nominaValue = $rowData[0][7];
								
								if($rowData[0][7] != '')
								{
									if(is_numeric($rowData[0][7]) || is_numeric(substr($rowData[0][7], 0, -1)))
									{
										// type = Inductor
										if($type == 1)
										{
											if(is_numeric($rowData[0][7]))
											{
												$nominaValue = $rowData[0][7];
											}
											else
											{
												$nominaValue = substr($rowData[0][7], 0, -1);
											}									
											$unit = 5;
										}
										//type = Capacitor
										elseif($type == 2)
										{
											if(is_numeric($rowData[0][7]))
											{
												$nominaValue = $rowData[0][7];
											}
											else
											{
												$nominaValue = substr($rowData[0][7], 0, -1);
											}							
											$unit = 9;
										}
										//type = Resistor
										else if($type == 3)
										{
											if(is_numeric($rowData[0][7]))
											{
												$nominaValue = $rowData[0][7];
											}
											else
											{
												$nominaValue = substr($rowData[0][7], 0, -1);
											}
											$unit = 1;
										}
										else
										{
											$errDetail .= $nominaValueTitle.',';
										}
									}
									elseif(is_numeric(substr($rowData[0][7], 0, -2)))
									{
										$nominaValue = substr($rowData[0][7], 0, -2);
										$part2 = substr($rowData[0][7], -2);
										switch ($part2) {
											case 'Ω':
												$unit = 1;
												break;
											case 'kΩ':
												$unit = 2;
												break;
											case 'MΩ':
												$unit = 3;
												break;
											case 'GΩ':
												$unit = 4;
												break;
											case 'mh':
												$unit = 6;
												break;
											case 'uh':
												$unit = 7;
												break;
											case 'nh':
												$unit = 8;
												break;
											case 'pF':
												$unit = 10;
												break;
											case 'uF':
												$unit = 11;
												break;
											case 'nF':
												$unit = 12;
												break;
											default:
												$errDetail .= $nominaValueTitle.',';
												break;
										}
									}
									elseif(is_numeric(substr($rowData[0][7], 0, -3)))
									{
										$nominaValue = substr($rowData[0][7], 0, -3);
										$part2 = substr($rowData[0][7], -3);
										switch ($part2) {
											case 'Ω':
												$unit = 1;
												break;
											case 'kΩ':
												$unit = 2;
												break;
											case 'MΩ':
												$unit = 3;
												break;
											case 'GΩ':
												$unit = 4;
												break;
											case 'mh':
												$unit = 6;
												break;
											case 'uh':
												$unit = 7;
												break;
											case 'nh':
												$unit = 8;
												break;
											case 'pF':
												$unit = 10;
												break;
											case 'uF':
												$unit = 11;
												break;
											case 'nF':
												$unit = 12;
												break;
											default:
												$errDetail .= $nominaValueTitle.',';
												break;
										}
									}
									else
									{
										$errDetail .= $nominaValueTitle.',';
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
												$tolerance = $toleranceNum/$nominaValue*100;
											}
											elseif(is_numeric(substr($rowData[0][8], 3, -1)))
											{
												$toleranceNum = substr($rowData[0][8], 3, -1);
												$tolerance = $toleranceNum/$nominaValue*100;
											}
											elseif(is_numeric(substr($rowData[0][8], 3, -2)))
											{
												$toleranceNum = substr($rowData[0][8], 3, -2);
												$tolerance = $toleranceNum/$nominaValue*100;
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
								
								$adjust = $rowData[0][6];
								
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
										if(!is_numeric($adjust))
										{
											$errDetail .= $adjustTitle.',';
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
		$fileRoot = $root."\\doc\\templete.xls";
		$fileName = "templete.xls";
		
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
}
