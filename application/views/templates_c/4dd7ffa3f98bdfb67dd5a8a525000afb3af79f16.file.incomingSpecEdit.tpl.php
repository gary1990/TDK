<?php /* Smarty version Smarty-3.1.8, created on 2013-07-10 11:57:38
         compiled from "application/views/templates\incomingSpecEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2522751d45947e79595-97312990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4dd7ffa3f98bdfb67dd5a8a525000afb3af79f16' => 
    array (
      0 => 'application/views/templates\\incomingSpecEdit.tpl',
      1 => 1373428648,
      2 => 'file',
    ),
    '0a09857ede85b02bbc4dd7a34cfdea24f1afa9f0' => 
    array (
      0 => 'application/views/templates\\default.tpl',
      1 => 1373253266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2522751d45947e79595-97312990',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d459480c9f25_83493821',
  'variables' => 
  array (
    'commonHead' => 0,
    'jqueryHead' => 0,
    'validationEngineHead' => 0,
    'CI' => 0,
    'currenmenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d459480c9f25_83493821')) {function content_51d459480c9f25_83493821($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'E:\\wwwRoot\\TDK\\system\\libraries\\Smarty\\libs\\plugins\\function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $_smarty_tpl->tpl_vars['commonHead']->value;?>

		
		<?php echo $_smarty_tpl->tpl_vars['jqueryHead']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['validationEngineHead']->value;?>

		
		
<title>Incoming Spec Edit</title>	

		<style>
			#logoimg
			{
				height:30px;
				width:150px;
			}
			.span-10,.span-20
			{
				margin-top:8px;			
			}
			.span-64
			{
				float:none;
			}
			.inlineblock{
				display:inline-block;
				float:none;
			}
			.middletitle
			{
				text-align:center;
				font-size:large;
			}
			#tabs {
				float:left;
				width:100%;
				font-size:93%;
				line-height:normal;
				border-bottom:1px solid #666;
				margin-bottom:1em; /*margin between menu and rest of page*/
				overflow:hidden;
			}
			#tabs ul 
			{
				margin:0;
				padding:10px 10px 0 0px;
				list-style:none;
			}
			#tabs li 
			{
				display:inline;
				margin:0;
				padding:0;
			}
			#tabs a 
			{
				float:left;
				margin:0;
				padding:0 0 0 6px;
				text-decoration:none;
			}
			#tabs a.clicked
			{
				background:url("<?php echo base_url();?>
resource/img/left.png") no-repeat left top;
			}
			#tabs a.clicked span
			{
				background:url("<?php echo base_url();?>
resource/img/right.png") no-repeat right top;
			}
			
			#tabs a:hover 
			{
				float:left;
				background:url("<?php echo base_url();?>
resource/img/left.png") no-repeat left top;
				margin:0;
				padding:0 0 0 6px;
				text-decoration:none;
			}
			#tabs a span 
			{
				float:left;
				display:block;
				padding:6px 15px 4px 6px;
				margin-right:2px;
				color:black;
			}
			#tabs a span:hover 
			{
				float:left;
				display:block;
				background:url("<?php echo base_url();?>
resource/img/right.png") no-repeat right top;
				padding:6px 15px 4px 6px;
				margin-right:2px;
				color:black;
				cursor: pointer;
			}
		</style>
		
<style>
	tr th
	{
		background-color:#CC9900;
		color:white;
		border: 0.1px solid #DDDDDD;
	}
	.span-block125
	{
		display:inline-block;
		width:160px;
	}
	.margin-bottom10
	{
		margin-bottom:10px;
	}
	.input-long{
		width:190px;
	}
	.input-short{
		width:100px;
	}
	.input-165{
		width:165px;
	}
	.text-area{
		width:190px;
	}
	.select-long{
		width:194px;
	}
	.select-short{
		width:87px;
	}
</style>

		
<script type="text/javascript">
	$(document).ready(function(){
		$(".type").change(function(){
			var type = $(this).val();
			$(".unit").load('<?php echo site_url();?>
/incomingSpec/getUnit/'+type);
			if(type != 1)
			{
				$(".residualinductance").attr("value","");
				$(".residualinductance").attr('disabled','disabled');
			}
			else
			{
				$(".residualinductance").removeAttr('disabled');
			}
		});
		
		$(".tolerance").keyup(function(){
			var nominalvalue = $(".nominalvalue").val();
			var tolerancenum = nominalvalue*$(this).val()/100;
			$(".tolerancenum").attr("value",tolerancenum);
		});
		
		$(".tolerancenum").keyup(function(){
			var nominalvalue = $(".nominalvalue").val();
			var tolerance = $(this).val()/nominalvalue*100;
			$(".tolerance").attr("value",tolerance);
		});
		$("#incomingEditForm").validationEngine('attach',
		{
			promptPosition : "centerRight",
			autoPositionUpdate : "true"
		});
		$(".cancelBtn").click(function(){
			var url = '<?php echo site_url();?>
/incomingSpec/';
			window.location.replace(url);
		});
	});
</script>

	</head>
	<body class="cldn">
		<div class="container">
			<div class="span-64 last defaulttitle">
				<img id="logoimg" src="<?php echo base_url();?>
resource/img/tdkEpcosLogo.gif"/>
				<span class="span-45 inlineblock middletitle">Incoming Inspection and Quality Control</span>
				<span class="inlineblock"><?php echo $_smarty_tpl->tpl_vars['CI']->value->session->userdata('username');?>
</span>
				<span class="inlineblock"><a href="<?php echo site_url('login/logout');?>
">Logout</a></span>
				<hr/>
			</div>
			<div>
				<div id="tabs">
				  <ul>
				    <li>
				    	<a class="<?php if ($_smarty_tpl->tpl_vars['currenmenu']->value=='incomingspect'){?>clicked<?php }else{ ?><?php }?>" href="<?php echo base_url();?>
index.php/incomingSpec">
				    		<span>Incoming Spec</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="<?php if ($_smarty_tpl->tpl_vars['currenmenu']->value=='inspectresult'){?>clicked<?php }else{ ?><?php }?>" href="<?php echo base_url();?>
index.php/inspectResult">
				    		<span>Inspect Result</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="<?php if ($_smarty_tpl->tpl_vars['currenmenu']->value=='reportcenter'){?>clicked<?php }else{ ?><?php }?>" href="<?php echo base_url();?>
index.php/reportCenter">
				    		<span>Report Center</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="<?php if ($_smarty_tpl->tpl_vars['currenmenu']->value=='user'){?>clicked<?php }else{ ?><?php }?>" href="<?php echo base_url();?>
index.php/user">
				    		<span>User</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="<?php if ($_smarty_tpl->tpl_vars['currenmenu']->value=='inspector'){?>clicked<?php }else{ ?><?php }?>" href="<?php echo base_url();?>
index.php/inspector">
				    		<span>Inspector</span>
				    	</a>
				    </li>
				  </ul>
				</div>
				<div>&nbsp;</div>
				<div>
					
<div class="span-64 last subitems">
	<h3>Edit</h3>
	<form id="incomingEditForm" action="<?php echo site_url();?>
/incomingSpec/editPost/" method="post">
		<input name="incomingSpecId" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['id'])===null||$tmp==='' ? $_POST['incomingSpecId'] : $tmp);?>
"/>
		<div class="margin-bottom10">
			<span class="span-block125">Part No.*:</span>
			<input id='partno' name="partno" type="text" class="input-long validate[required]" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['partno'])===null||$tmp==='' ? $_POST['partno'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Supplier*:</span>
			<input id="supplier" name="supplier" class="input-long validate[required]" type="text" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['supplier'])===null||$tmp==='' ? $_POST['supplier'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Description:</span>
			<textarea class="text-area" name="description"><?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['description'])===null||$tmp==='' ? $_POST['description'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
</textarea>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Type*:</span>
			<?php echo smarty_function_html_options(array('name'=>'type','class'=>"select-long type",'options'=>$_smarty_tpl->tpl_vars['typeArr']->value,'selected'=>(($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['type'])===null||$tmp==='' ? $_POST['type'] : $tmp))===null||$tmp==='' ? '1' : $tmp)),$_smarty_tpl);?>

		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Voltage:</span>
			<input id="testvoltage" name="testvoltage" class="input-165 validate[custom[number]]" value="<?php if (strlen($_smarty_tpl->tpl_vars['incomingRecord']->value['testvoltage'])==0){?><?php }else{ ?><?php echo substr($_smarty_tpl->tpl_vars['incomingRecord']->value['testvoltage'],0,-(($tmp = @3)===null||$tmp==='' ? '' : $tmp));?>
<?php }?>"/>Vdc
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Freq:</span>
			<input id="frequencyvalue" name="frequencyvalue" class="input-short validate[custom[number]]" value="<?php echo substr($_smarty_tpl->tpl_vars['incomingRecord']->value['testfrequency'],0,-(($tmp = @(($tmp = @3)===null||$tmp==='' ? $_POST['frequencyvalue'] : $tmp))===null||$tmp==='' ? '' : $tmp));?>
"/>
			<?php echo smarty_function_html_options(array('name'=>'frequnit','class'=>"select-short frequnit",'options'=>$_smarty_tpl->tpl_vars['freqUnitArr']->value,'selected'=>substr($_smarty_tpl->tpl_vars['incomingRecord']->value['testfrequency'],-(($tmp = @(($tmp = @3)===null||$tmp==='' ? $_POST['frequnit'] : $tmp))===null||$tmp==='' ? 'kHz' : $tmp))),$_smarty_tpl);?>

		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Residual inductance:</span>
			<?php if ($_smarty_tpl->tpl_vars['incomingRecord']->value['type']==1){?>
			<input id="residualinductance" class="input-long residualinductance validate[custom[number]]" name="residualinductance" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['residualinductance'])===null||$tmp==='' ? $_POST['residualinductance'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>
			<?php }else{ ?>
			<input id="residualinductance" disabled="disabled" class="input-long residualinductance validate[custom[number]]" name="residualinductance" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['residualinductance'])===null||$tmp==='' ? $_POST['residualinductance'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>
			<?php }?>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Nomimal Value*:</span>
			<input id="nominalvalue" class="input-long nominalvalue validate[required,custom[number]]" name="nominalvalue" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['nominalvalue'])===null||$tmp==='' ? $_POST['nominalvalue'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Unit:</span>
			<?php echo smarty_function_html_options(array('name'=>'unit','class'=>"select-long unit",'options'=>$_smarty_tpl->tpl_vars['unitArr']->value,'selected'=>(($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['unit'])===null||$tmp==='' ? $_POST['unit'] : $tmp))===null||$tmp==='' ? '5' : $tmp)),$_smarty_tpl);?>

		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol %*:</span>
			+/-<input id="tolerance" class="tolerance validate[required,custom[number]]" name="tolerance" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['tolerance'])===null||$tmp==='' ? $_POST['tolerance'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>%
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol Num*:</span>
			+/-<input id="tolerancenum" class="tolerancenum validate[required,custom[number]]" name="tolerancenum" value="<?php echo (($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['incomingRecord']->value['tolerancenum'])===null||$tmp==='' ? $_POST['tolerancenum'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div style="margin-top: 20px;">
			<input type="submit" value="Save"/>
			<input class="cancelBtn" type="button" value="Cancel"/>
		</div>
	</form>
	<div style="color:red;"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['errmesg']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>
</div>

				</div>
			</div>
		</div>
	</body>
</html><?php }} ?>