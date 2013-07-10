<?php /* Smarty version Smarty-3.1.8, created on 2013-07-10 15:15:11
         compiled from "application/views/templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3140351dd09ff81eaa7-22144013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9c889001306a3e2053110da57cc123d828ca022' => 
    array (
      0 => 'application/views/templates\\login.tpl',
      1 => 1373437806,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3140351dd09ff81eaa7-22144013',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'loginErrorInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51dd09ff8a0329_07485943',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51dd09ff8a0329_07485943')) {function content_51dd09ff8a0329_07485943($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="<?php echo base_url();?>
resource/css/screen.css" type="text/css" media="screen, projection"/>
		<link rel="stylesheet" href="<?php echo base_url();?>
resource/css/print.css" type="text/css" media="print"/>
		<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo base_url();?>
/resource/css/ie.css" type="text/css" media="screen, projection"/><![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>
resource/css/user.css" type="text/css" media="screen, projection"/>
		<script src="<?php echo base_url();?>
resource/js/jquery.js" type="text/javascript"></script>
		
		<!-- validationEngine -->
		<link rel="stylesheet" href="<?php echo base_url();?>
resource/css/template.css" type="text/css" media="screen, projection"/>
		<link rel="stylesheet" href="<?php echo base_url();?>
resource/css/validationEngine.jquery.css" type="text/css" media="screen, projection"/>
		<script src="<?php echo base_url();?>
resource/js/jquery.validationEngine.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>
resource/js/jquery.validationEngine-zh_CN.js" type="text/javascript"></script>

		<title>登录</title>
		<style>
			.logo_appName{
				text-align:center;
				margin-top:50px;
				margin-bottom:30px;
			}
			.appName{
				font-size:38px;
			    font-family:Arial;
			}
			img{
				width:25px;
				height:20px;
				vertical-align: -8px;
			}
			.locBlue{
				margin-left:50%;
				border-left:1px solid #666666;
				padding-left:30px;
			}
			.label1{
				font-size:16px;
			}
			.input1{
				height:20px;
				width:149px;
			}
			.button1{
				cursor:pointer;
				color:white;
				background-color:#0066CC;
				border: 0;
				border-radius:5px;
				width:85px;
				height:25px;
				font-size:16px;
				font-weight: bold;
			}
			.inline{
				margin-right:20px;
			}
			.span-21{
				margin-top:100px;
				text-align:center;
			}
			.error1{
				font-size:13px;
			}
		</style>
		<script>
			$(document).ready(function()
			{
				$(".locDefaultStr").click(function()
				{
					$(this).prev(".locDefaultStrContainer").focus();
				});
				$(".locDefaultStrContainer").focus(function()
				{
					$(this).next(".locDefaultStr").hide();
				});
				$(".locDefaultStrContainer").blur(function()
				{
					if ($(this).val() == "")
					{
						$(this).next(".locDefaultStr").show();
					}
				});
				$(".locDefaultStrContainer").blur();
				$("#locLoginForm").validationEngine('attach',
				{
					promptPosition : "centerRight",
					autoPositionUpdate : "true"
				});
			});
			function checkUserName(field, rules, i, options)
			{
				var err = new Array();
				var reg1 = /^[_\.].*/;
				var reg2 = /.*[_\.]$/;
				var str = field.val();
				if (reg1.test(str) || reg2.test(str))
				{
					err.push('*Can not begin with _ or .');
				}
				if ((countOccurrences(str, '.') + countOccurrences(str, '_')) > 1)
				{
					err.push('* 一个用户名仅允许包含一个下划线或一个点！');
				}
				if (err.length > 0)
				{
					return err.join("<br>");
				}
			}
		
			function countOccurrences(str, character)
			{
				var i = 0;
				var count = 0;
				for ( i = 0; i < str.length; i++)
				{
					if (str.charAt(i) == character)
					{
						count++;
					}
				}
				return count;
			}
		</script>
	</head>
	<body>
		<div class="container">
			<div class="prepend-2 span-60 append-2 last">
				<div class="logo_appName">
					<span class="appName">Incoming Inspection and Quality Control</span>
				</div>
				<div class="locSecond prepend-2 span-56 append-2 last">
					<div class="locBlue span-28 last">
						<form id="locLoginForm" action="<?php echo site_url('login/validateLogin');?>
" method="post">
							<div class="clear prepend-1">
								<div class="locWhite locMid label1">
									
								</div>
							</div>
							<div class="clear prepend-1 span-11 inline append-bottom10">
								<div class="relative">
									<input id="userName" name="username" class="locInputYellow locDefaultStrContainer input1 validate[required, custom[onlyLetterNumber], minSize[6]]" value="<?php echo (($tmp = @$_POST['username'])===null||$tmp==='' ? '' : $tmp);?>
" type="text" />
									<div class="locDefaultStr defaultStr1 locUserNameDefaultStr">
										username
									</div>
								</div>
							</div>
							<div class="clear prepend-1">
								<div class="locWhite locMid label1">
									
								</div>
							</div>
							<div class="clear prepend-1 span-11 inline append-bottom20">
								<div class="relative">
									<input id="password" name="password" class="locInputYellow locDefaultStrContainer input1 validate[required, custom[onlyLetterNumber], minSize[6], maxSize[20]]" type="password" />
									<div class="locDefaultStr defaultStr1 locUserNameDefaultStr">
										password
									</div>
								</div>
							</div>
							<div class="clear prepend-1">
								<div class="inline span-5">
									<button id="loginButton" class="button1" type="submit">
										Login
									</button>
								</div>
								<div class="span-10 locGeneralErrorInfo">
									<span class="error1"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['loginErrorInfo']->value)===null||$tmp==='' ? '' : $tmp);?>
</span>
								</div>
							</div>
							<div class="clear span-1">
								&nbsp;
							</div>
						</form>
					</div>
					<div class="clear">
						&nbsp;
					</div>
					<div class="clear">
						&nbsp;
					</div>
					<div class="clear">
						&nbsp;
					</div>
					<div class="clear">
						&nbsp;
					</div>
				</div>
				<div class="clear prepend-20 span-21">
					<img src="<?php echo base_url();?>
resource/img/gemcycle.png"/>
					<span>1.0Powered by Gemcycle</span>
				</div>
			</div>
		</div>
	</body>
</html>
<?php }} ?>