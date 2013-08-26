<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Login extends CW_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('cookie');
		$this->load->library('PHPExcel');
	}

	public function index()
	{
		$this->session->sess_destroy();
		$this->smarty->display('login.tpl');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url()."index.php/login");
	}

	public function login2($userName = null, $password = null)
	{
		$this->session->sess_destroy();
		$_POST['userName'] = $userName;
		$_POST['password'] = $password;
		$this->validateLogin();
	}

	public function validateLogin()
	{
		$var = '';
		if ($this->_authenticate($var))
		{
			//登录成功
			$this->input->set_cookie('type', $this->input->post('type'), 3600 * 24 * 30);
			redirect(base_url().'index.php/incomingSpec');
		}
		else
		{
			//登录失败
			$this->smarty->assign('loginErrorInfo', $var);
			$this->index();
		}
	}
	
	private function _checkDataFormat(&$result)
	{
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
			$result = validation_errors();
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function checkUsername1($str)
	{
		$r1 = preg_match("/^[a-zA-Z0-9]{6,}$/", $str);
		if ($r1 == 0)
		{
			$this->form_validation->set_message('checkUsername1', '%s 只能包含英文字母，数字，长度最少为6位。');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function checkUsername2($str)
	{
		$docNum = substr_count($str, '.');
		$lineNum = substr_count($str, '_');
		if ($docNum + $lineNum > 1)
		{
			$this->form_validation->set_message('checkUsername2', '%s 只能包含一个下划线或点.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function checkUsername3($str)
	{
		$r1 = preg_match("/^\..*/", $str);
		$r2 = preg_match("/^_.*/", $str);
		$r3 = preg_match("/.*\.$/", $str);
		$r4 = preg_match("/.*_$/", $str);
		if ($r1 || $r2 || $r3 || $r4)
		{
			$this->form_validation->set_message('checkUsername3', '%s 不能以下划线或点开始或结束.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	private function _authenticate(&$var)
	{
		$this->lang->load('form_validation', 'english');
		//check data format
		if (!($this->_checkDataFormat($result)))
		{
			$var = $result;
			return FALSE;
		}
		else
		{
			$tmpRes = $this->db->query('SELECT a.*,b.name AS rolename FROM 
										user a
										JOIN role b ON a.role = b.id
										AND a.username = ?', strtolower($this->input->post('username')));
			if ($tmpRes)
			{
				if ($tmpRes->num_rows() > 0)
				{
					$tmpArr = $tmpRes->first_row('array');
					if ($tmpArr['password'] == strtolower($this->input->post('password')))
					{
						$this->session->set_userdata('username', strtolower($this->input->post('username')));
						$this->session->set_userdata('userId', $tmpArr['id']);
						$this->session->set_userdata('rolename', $tmpArr['rolename']);
						return TRUE;
					}
					else
					{
						//密码错误
						$var = "*Incorrect Password";
						return FALSE;
					}
				}
				else
				{
					//用户名不存在
					$var = "*No Such User";
					return FALSE;
				}
			}
			else
			{
				//查询失败
				$var = "*System Busy,Try Latter";
				return FALSE;
			}
		}
	}
	
	public function clientLogin($username = null,$password = null)
	{
		$inspectorObj = $this->db->query("SELECT * FROM inspector a
									 WHERE a.username = '".$username."' 
									 AND a.password = '".$password."'");
		$inspectorArr = $inspectorObj->result_array();
		
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
					->setCellValue('C1', 'Tets Voltage')
		            ->setCellValue('D1', 'Type')
					->setCellValue('E1', 'test frequency')
					->setCellValue('F1', 'Nominal value')
					->setCellValue('G1', 'Unit')
					->setCellValue('H1', 'Tol')
					->setCellValue('I1', 'Residual inductance');
		
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		
		if(count($inspectorArr) != 0)
		{
			$incomingSpecObj = $this->db->query("SELECT a.*,b.name AS typename,c.name AS unitname
												FROM incomingspec a
												JOIN type b ON a.type = b.id
												JOIN unit c ON a.unit = c.id");
			$incomingSpecArr = $incomingSpecObj->result_array();
			
			if(count($incomingSpecArr) != 0)
			{
				$i = 2;
				foreach ($incomingSpecArr as $value) 
				{
					$unitname = '';
					if($value['unitname'] == 'Ω')
					{
						$unitname = '';
					}
					else
					{
						if(strlen($value['unitname']) == 1)
						{
							$unitname = '';
						}
						else
						{
							$unitname = substr($value['unitname'], 0, 1);
						}
					}
					
					$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A'.$i, $value['partno'])
			            ->setCellValue('B'.$i, $value['supplier'])
						->setCellValue('C'.$i, $value['testvoltage'])
			            ->setCellValue('D'.$i, $value['typename'])
			            ->setCellValue('E'.$i, $value['testfrequency'])
						->setCellValue('F'.$i, $value['nominalvalue'])
						->setCellValue('G'.$i, $unitname)
						->setCellValue('H'.$i, $value['tolerancenum'])
						->setCellValue('I'.$i, $value['residualinductance']);
					$i++;
				}
			}
		}
		else
		{
			$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A2', 'error');
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="clientLogin.xls"');
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

	public function uploadFile($username = null,$password = null)
	{
		if (PHP_OS == 'WINNT')
		{
			$uploadRoot = getcwd()."\\assets\\uploadedSource";
			$slash = "\\";
		}
		else if (PHP_OS == 'Darwin')
		{
			$uploadRoot = "/Library/WebServer/Documents/aptana/xiong/assets/uploadedSource";
			$slash = "/";
		}
		else
		{
			$this->_returnUploadFailed("Incrrect System Operate");
			return;
		}
		if ($this->_checkTestUser($username, $password) === FALSE)
		{
			$this->_returnUploadFailed("Incrrect Inspector Username Or Password");
			return;
		}
		else
		{
			//保存上传文件
			$file_temp = @$_FILES['file']['tmp_name'];
			if($file_temp == '')
			{
				$this->_returnUploadFailed("file uploaded failed");
				return;
			}
			date_default_timezone_set('Asia/Shanghai');
			$dateStamp = date("Y_m_d");
			$dateStampFolder = $uploadRoot.$slash.$dateStamp;
			if (file_exists($dateStampFolder) && is_dir($dateStampFolder))
			{
				//do nothing
			}
			else
			{
				if (mkdir($dateStampFolder))
				{
				}
				else
				{
					$this->_returnUploadFailed("time folder created failed");
					return;
				}
			}
			
			$file_name = $dateStamp.$slash.$_FILES['file']['name'];
			//complete upload
			$filestatus = move_uploaded_file($file_temp, $uploadRoot.$slash.$file_name);

			if (!$filestatus)
			{
				$this->_returnUploadFailed("file save failed");
				return;
			}
			else
			{
				//do noting
			}
			//解压缩文件
			if (PHP_OS == 'WINNT')
			{
				//判断.zip文件是否有空格，并解压缩
				$file = $uploadRoot.$slash.$file_name;
				$file1 = str_replace(' ', '', $file);
				rename($file,$file1);
				exec('C:\Progra~1\7-Zip\7z.exe x '.$file1.' -o'.$uploadRoot.$slash.$dateStamp.' -y', $info);
			}
			else if (PHP_OS == 'Darwin')
			{
				$zip = new ZipArchive;
				if ($zip->open($uploadRoot.$slash.$file_name) === TRUE)
				{
					$zip->extractTo($uploadRoot.$slash.$dateStamp.$slash);
					$zip->close();
					//关闭处理的zip文件
				}
				else
				{
					$this->_returnUploadFailed("zip file uncompress failed");
					return;
				}
			}			
			
			$handle = @fopen($uploadRoot.$slash.$dateStamp.$slash.substr($_FILES['file']['name'], 0, -4).$slash.'TestResult.csv', "r");
			
			//解析文件并插入数据库
			$this->db->trans_start();
			//解析.csv
			if ($handle)
			{
				$i = 0;
				while (($buffer = fgets($handle)) !== false)
				{
					$i = $i + 1;
					if ($i == 1)
					{
						$tmpArray = explode(",", $buffer);
						continue;
					}
					$tmpArray = explode(",", $buffer);
					//取得测试时间
					$testTime = $tmpArray[0];
					//取得测试站号
					$testStation = $tmpArray[1];
					//取得设备序列号
					$equipmentSn = $tmpArray[2];
					//取得测试者id
					$tmpRes = $this->db->query("SELECT id FROM inspector WHERE username = ?", array($tmpArray[3]));
					if ($tmpRes->num_rows() == 0)
					{
						$this->db->trans_rollback();
						$this->_returnUploadFailed("can not find such inspector");
						return;
					}
					else
					{
						$inspector = $tmpRes->first_row()->id;
					}
					
					//取得part no.
					$tmpRes = $this->db->query("SELECT id FROM incomingspec WHERE partno = ?", array($tmpArray[4]));
					if ($tmpRes->num_rows() == 0)
					{
						$this->db->trans_rollback();
						$this->_returnUploadFailed("can not find such Part No.");
						return;
					}
					else
					{
						$partNO = $tmpRes->first_row()->id;
					}
					
					//取得产品sn
					$betchno = $tmpArray[5];
					//处理测试结果
					if ($tmpArray[6] == 'PASS')
					{
						$testResult = 1;
					}
					else
					{
						$testResult = 0;
					}
					
					//删除NULL,tab,new line,纵向列表符,回车,普通空白
					$measvalue = trim($tmpArray[12]);
					
					$imgurl = $dateStamp.'/'.substr($_FILES['file']['name'], 0, -4).'/'.'TestResult-img.png';
					
					//插入testresultinfo
					$tmpSql = "INSERT INTO `testresultinfo`(`betchno`, `equipmentsn`, `testTime`, `testStation`, `inspector`, `partno`, `result`, `measvlaue`, `imgurl`) ";
					$tmpSql .= "VALUES ('$betchno','$equipmentSn','$testTime','$testStation',$inspector,$partNO,$testResult,'$measvalue','$imgurl')";
					$tmpRes = $this->db->query($tmpSql);
					
					if ($tmpRes === TRUE)
					{
						//
					}
					else
					{
						$this->db->trans_rollback();
						$this->_returnUploadFailed("insert into testresultinfo failed");
						return;
					}
				}
				fclose($handle);
			}
			else
			{
				$this->_returnUploadFailed("TestResult.csv file open failed");
				return;
			}
		}
		$this->_returnUploadOk();
		return;
	}
	
	private function _returnUploadOK()
	{
		$this->db->trans_commit();
		$this->load->helper('xml');
		$dom = xml_dom();
		$uploadResult = xml_add_child($dom, 'uploadResult');
		xml_add_child($uploadResult, 'result', 'true');
		xml_add_child($uploadResult, 'info', 'success');
		xml_print($dom);
	}
	
	private function _returnUploadFailed($err)
	{
		$this->load->helper('xml');
		$dom = xml_dom();
		$uploadResult = xml_add_child($dom, 'uploadResult');
		xml_add_child($uploadResult, 'result', 'false');
		xml_add_child($uploadResult, 'info', $err);
		xml_print($dom);
	}
	
	private function _checkTestUser($username,$password)
	{
		/*
		$inspectorObj = $this->db->query("SELECT * FROM inspector WHERE username = ? AND password = ?",array($username, $password));
		if($inspectorObj->num_rows() > 0)
		{
			return $inspectorObj->first_row('array');
		}
		else
		{
			return FALSE;
		}
		 */
		return TRUE; 
	}
	
}

/*end*/
