<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class ReportCenter extends CW_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		//Part No.
		$partnoObj = $this->db->query("SELECT DISTINCT a.partno FROM incomingspec a");
		$partnoArr = $partnoObj->result_array();
		$partnoArr = $this->array_switch($partnoArr, 'partno', '');
		$this->smarty->assign('partnoArr',$partnoArr);
		
		$partnoSql = '';
		$partno = emptyToNull($this->input->post("partno"));
		if($partno != '')
		{
			$partnoSql = " AND b.partno = '".$partno."' ";
		}
		$starttimeSql = '';
		$starttime = emptyToNull($this->input->post("starttime"));
		if($starttime != '')
		{
			$starttimeArr = explode('/', $starttime);
			$starttime = $starttimeArr[2].'-'.$starttimeArr[0].'-'.$starttimeArr[1]." 00:00:00";
			$starttimeSql = " AND a.testTime >= '".$starttime."' ";
		}
		$endtimeSql = '';
		$endtime = emptyToNull($this->input->post("endtime"));
		if($endtime != '')
		{
			$endtimeArr = explode('/', $endtime);
			$endtime = $endtimeArr[2].'-'.$endtimeArr[0].'-'.$endtimeArr[1]." 23:59:59";
			$endtimeSql = " AND a.testTime <= '".$endtime."' ";
		}
		
		$resultList = array();
		$limitLine1 = array();
		$limitLine2 = array();
		$nominalVal = array();
		
		if($partno == '' && $starttime == '' && $endtime == '')
		{
			//
		}
		else
		{
			$resultSql = "SELECT 
					  a.testTime,a.measvlaue,
					  b.nominalvalue,b.tolerancenum,
					  c.name AS unitname
					  FROM testresultinfo a
					  JOIN incomingspec b ON a.partno = b.id
					  JOIN unit c ON b.unit = c.id ".$partnoSql.$starttimeSql.$endtimeSql;
			$resultObj = $this->db->query($resultSql);
			$resultArr = $resultObj->result_array();
			
			if(count($resultArr) != 0)
			{
				$unitname = $resultArr[0]['unitname'];
				$this->smarty->assign("unitname",$unitname);
			}
			
			foreach ($resultArr as $value)
			{
				$measvlaue = $value['measvlaue'];
				for($i = 0; $i < 5; $i++)
				{
					$measvlaue = substr($measvlaue, 0, strlen($measvlaue)-1);
					if(is_numeric($measvlaue))
					{
						$measvlaue = $measvlaue;
						break;
					}
					else
					{
						continue;
					}
				}
				$resultList[$value['testTime']] = $measvlaue;
				$limitLine1[$value['testTime']] = $value['nominalvalue']-$value['tolerancenum'];
				$limitLine2[$value['testTime']] = $value['nominalvalue']+$value['tolerancenum'];
				$nominalVal[$value['testTime']] = $value['nominalvalue'];
			}
		}
		$this->smarty->assign("resultList",$resultList);
		$this->smarty->assign("limitLine1",$limitLine1);
		$this->smarty->assign("limitLine2",$limitLine2);
		$this->smarty->assign("nominalVal",$nominalVal);
		$this->smarty->assign("currenmenu","reportcenter");
		$this->smarty->display("reportCenter.tpl");
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
}
