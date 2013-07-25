<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class InspectResult extends CW_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('PHPExcel');
		//取得Supplier
		$supplierObj = $this->db->query("SELECT DISTINCT supplier FROM incomingspec");
		$supplierArr = $supplierObj->result_array();
		$supplier = $this->array_switch($supplierArr, 'supplier', '(ALL)');
		$this->smarty->assign('supplier',$supplier);
		//取得Type
		$typeObj = $this->db->query("SELECT id,name FROM type");
		$typeArr = $typeObj->result_array();
		$type = $this->array_switch1($typeArr, 'name', '(ALL)');
		$this->smarty->assign('type',$type);
		//result
		$testresult = array('' => '(ALL)',
						   '0' => 'Fail',
						   '1' => 'Pass'
						  );
		$this->smarty->assign('testresult',$testresult);
	}
	
	public function index($offset = 0, $limit = 30)
	{
		$testresultSql = '';
		$testresult = emptyToNull($this->input->post("testresult"));
		if($testresult != '')
		{
			$testresultSql = " AND a.result = '".$testresult."' ";
		}
		$supplierSql = '';
		$supplier = emptyToNull($this->input->post("supplier"));
		if($supplier != '')
		{
			$supplierSql = " AND b.supplier = '".$supplier."' ";
		}
		$typeSql = '';
		$type = emptyToNull($this->input->post("type"));
		if($type != '')
		{
			$typeSql = " AND b.type = '".$type."' ";
		}
		$batchNoSql = '';
		$batchNo = emptyToNull($this->input->post("batchno"));
		if($batchNo != '')
		{
			$batchNoSql = " AND a.betchno LIKE '%".$batchNo."%' ";
		}
		$timeFromSql = '';
		$timeFrom = emptyToNull($this->input->post("timefrom"));
		if($timeFrom != '')
		{
			$timeFromArr = explode('/', $timeFrom);
			$timeFrom = $timeFromArr[2].'-'.$timeFromArr[0].'-'.$timeFromArr[1]." 00:00:00";
			$timeFromSql = " AND a.testTime >= '".$timeFrom."' ";
		}
		$timeToSql = '';
		$timeTo = emptyToNull($this->input->post("timeto"));
		if($timeTo != '')
		{
			$timeToArr = explode('/', $timeTo);
			$timeTo = $timeToArr[2].'-'.$timeToArr[0].'-'.$timeToArr[1]." 23:59:59";
			$timeToSql = " AND a.testTime <= '".$timeTo."' ";
		}
		
		$resultSql = "SELECT 
					  a.id,a.testTime,a.measvlaue,a.result,a.betchno,a.imgurl,
					  b.partno,b.supplier,b.nominalvalue,b.tolerancenum,
					  c.name AS typename,
					  d.username AS inspector,
					  e.name AS unitname
					  FROM testresultinfo a
					  JOIN incomingspec b ON a.partno = b.id 
					  JOIN type c ON b.type = c.id
					  JOIN inspector d ON a.inspector = d.id
					  JOIN unit e ON b.unit = e.id ".$testresultSql.$supplierSql.$typeSql.$batchNoSql.$timeFromSql.$timeToSql.
					  " ORDER BY a.testTime DESC";
		$resultObj = $this->db->query($resultSql);
		$resultArr = $resultObj->result_array();
		
		$totalcount = count($resultArr);
		$this->smarty->assign('totalcount',$totalcount);
		$this->load->library('pagination');
		$config['full_tag_open'] = '<div class="locPage">';
		$config['full_tag_close'] = '</div>';
		$config['base_url'] = '';
		$config['uri_segment'] = 3;
		$config['total_rows'] = count($resultArr);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$resultSql = $resultSql." LIMIT ".$offset.",".$limit;
		$resultObj = $this->db->query($resultSql);
		$resultArr = $resultObj->result_array();
		
		$this->smarty->assign("offset",$offset);
		$this->smarty->assign("resultArr",$resultArr);
		$this->smarty->assign("currenmenu","inspectresult");
		$this->smarty->display("inspectResult.tpl");
	}
	
	public function inspectResultPost()
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
			$this->db->query("DELETE FROM testresultinfo WHERE id IN (".$deleteId.")");
			$this->index();
		}
	}
	
	public function exportResult()
	{
		$testresultSql = '';
		$testresult = emptyToNull($this->input->post("testresult"));
		if($testresult != '')
		{
			$testresultSql = " AND a.result = '".$testresult."' ";
		}
		$supplierSql = '';
		$supplier = emptyToNull($this->input->post("supplier"));
		if($supplier != '')
		{
			$supplierSql = " AND b.supplier = '".$supplier."' ";
		}
		$typeSql = '';
		$type = emptyToNull($this->input->post("type"));
		if($type != '')
		{
			$typeSql = " AND b.type = '".$type."' ";
		}
		$batchNoSql = '';
		$batchNo = emptyToNull($this->input->post("batchno"));
		if($batchNo != '')
		{
			$batchNoSql = " AND a.betchno LIKE '%".$batchNo."%' ";
		}
		$timeFromSql = '';
		$timeFrom = emptyToNull($this->input->post("timefrom"));
		if($timeFrom != '')
		{
			$timeFromArr = explode('/', $timeFrom);
			$timeFrom = $timeFromArr[2].'-'.$timeFromArr[0].'-'.$timeFromArr[1]." 00:00:00";
			$timeFromSql = " AND a.testTime >= '".$timeFrom."' ";
		}
		$timeToSql = '';
		$timeTo = emptyToNull($this->input->post("timeto"));
		if($timeTo != '')
		{
			$timeToArr = explode('/', $timeTo);
			$timeTo = $timeToArr[2].'-'.$timeToArr[0].'-'.$timeToArr[1]." 23:59:59";
			$timeToSql = " AND a.testTime <= '".$timeTo."' ";
		}
		
		$resultSql = "SELECT
					  a.testTime,a.measvlaue,a.result,a.betchno,a.imgurl,
					  b.partno,b.supplier,b.nominalvalue,b.tolerancenum,
					  c.name AS typename,
					  d.username AS inspector,
					  e.name AS unitname
					  FROM testresultinfo a
					  JOIN incomingspec b ON a.partno = b.id 
					  JOIN type c ON b.type = c.id
					  JOIN inspector d ON a.inspector = d.id
					  JOIN unit e ON b.unit = e.id ".$testresultSql.$supplierSql.$typeSql.$batchNoSql.$timeFromSql.$timeToSql;
		$resultObj = $this->db->query($resultSql);
		$resultArr = $resultObj->result_array();
		
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Shanghai');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', 'No.')
		            ->setCellValue('B1', 'Time')
		            ->setCellValue('C1', 'Part No.')
		            ->setCellValue('D1', 'Type')
					->setCellValue('E1', 'Meas. Value')
					->setCellValue('F1', 'Result')
					->setCellValue('G1', 'Batch No.')
					->setCellValue('H1', 'Supplier')
					->setCellValue('I1', 'Inspetor')
					->setCellValue('J1', 'Nominal/Tol');
		
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		
		if(count($resultArr) != 0)
		{
			$i = 2;
			foreach ($resultArr as $value)
			{
				$testResult = '';
				if($value['result'] == 0)
				{
					$testResult = '不合格';
				}
				else
				{
					$testResult = '合格';
				}
				$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$i, $i-1)
			            ->setCellValue('B'.$i, $value['testTime'])
			            ->setCellValue('C'.$i, $value['partno'])
			            ->setCellValue('D'.$i, $value['typename'])
						->setCellValue('E'.$i, $value['measvlaue'])
						->setCellValue('F'.$i, $testResult)
						->setCellValue('G'.$i, $value['betchno'])
						->setCellValue('H'.$i, $value['supplier'])
						->setCellValue('I'.$i, $value['inspector'])
						->setCellValue('J'.$i, $value['nominalvalue'].'+/-'.$value['tolerancenum'].$value['unitname']);
				$i++;
			}
		}
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="InspectResult.xls"');
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
	
	private function array_switch($var1,$var2,$var3)
	{
		$arr = array('' => $var3);
		foreach($var1 as $val)
		{
			$arr += array($val[$var2] => $val[$var2]);
		}
		
		return $arr;
	}
	
	private function array_switch1($var1,$var2,$var3)
	{
		$arr = array('' => $var3);
		foreach($var1 as $val)
		{
			$arr += array($val['id'] => $val[$var2]);
		}
		
		return $arr;
	}
}
