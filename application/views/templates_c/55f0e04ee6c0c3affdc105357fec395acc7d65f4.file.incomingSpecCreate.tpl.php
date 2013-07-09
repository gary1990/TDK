<?php /* Smarty version Smarty-3.1.8, created on 2013-07-09 11:21:09
         compiled from "application/views/templates\incomingSpecCreate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1127051d4edfdcb9d35-66434839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55f0e04ee6c0c3affdc105357fec395acc7d65f4' => 
    array (
      0 => 'application/views/templates\\incomingSpecCreate.tpl',
      1 => 1373048918,
      2 => 'file',
    ),
    '0a09857ede85b02bbc4dd7a34cfdea24f1afa9f0' => 
    array (
      0 => 'application/views/templates\\default.tpl',
      1 => 1373253266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1127051d4edfdcb9d35-66434839',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d4edfddbcab0_71134552',
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
<?php if ($_valid && !is_callable('content_51d4edfddbcab0_71134552')) {function content_51d4edfddbcab0_71134552($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'E:\\wwwRoot\\TDK\\system\\libraries\\Smarty\\libs\\plugins\\function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $_smarty_tpl->tpl_vars['commonHead']->value;?>

		
		<?php echo $_smarty_tpl->tpl_vars['jqueryHead']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['validationEngineHead']->value;?>

		
		
<title>Incoming Spec Create</title>	

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
		$("#locLoginForm").validationEngine('attach',
		{
			promptPosition : "centerRight",
			autoPositionUpdate : "true"
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
	<h3>Create</h3>
	<form id="locLoginForm" action="<?php echo site_url();?>
/incomingSpec/createPost/" method="post">
		<div class="margin-bottom10">
			<span class="span-block125">Part No.:</span>
			<input id='partno' name="partno" type="text" class="validate[required]" value="<?php echo (($tmp = @$_POST['partno'])===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Supplier:</span>
			<input id="supplier" name="supplier" class="validate[required]" type="text" value="<?php echo (($tmp = @$_POST['supplier'])===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Description:</span>
			<textarea name="description"><?php echo (($tmp = @$_POST['description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Type:</span>
			<?php echo smarty_function_html_options(array('name'=>'type','class'=>'type','options'=>$_smarty_tpl->tpl_vars['typeArr']->value,'selected'=>(($tmp = @$_POST['type'])===null||$tmp==='' ? '1' : $tmp)),$_smarty_tpl);?>

		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Voltage:</span>
			<input id="testvoltage" name="testvoltage" class="validate[custom[testVoltageFormart]]" value="<?php echo (($tmp = @$_POST['testvoltage'])===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Freq:</span>
			<input id="frequencyvalue" name="frequencyvalue" class="validate[custom[number]]" value="<?php echo (($tmp = @$_POST['frequencyvalue'])===null||$tmp==='' ? '' : $tmp);?>
"/>
			<?php echo smarty_function_html_options(array('name'=>'frequnit','class'=>'frequnit','options'=>$_smarty_tpl->tpl_vars['freqUnitArr']->value,'selected'=>(($tmp = @$_POST['frequnit'])===null||$tmp==='' ? 'kHz' : $tmp)),$_smarty_tpl);?>

		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Residual inductance:</span>
			<input id="residualinductance" class="residualinductance validate[custom[number]]" name="residualinductance" value="<?php echo (($tmp = @$_POST['residualinductance'])===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Nomimal Value:</span>
			<input id="nominalvalue" class="nominalvalue validate[required,custom[number]]" name="nominalvalue" value="<?php echo (($tmp = @$_POST['nominalvalue'])===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Unit:</span>
			<?php echo smarty_function_html_options(array('name'=>'unit','class'=>'unit','options'=>$_smarty_tpl->tpl_vars['unitArr']->value,'selected'=>(($tmp = @$_POST['unit'])===null||$tmp==='' ? '5' : $tmp)),$_smarty_tpl);?>

		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol %:</span>
			+/-<input id="tolerance" class="tolerance validate[custom[number]]" name="tolerance" value="<?php echo (($tmp = @$_POST['tolerance'])===null||$tmp==='' ? '' : $tmp);?>
"/>%
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol Num:</span>
			+/-<input id="tolerancenum" class="tolerancenum validate[custom[number]]" name="tolerancenum" value="<?php echo (($tmp = @$_POST['tolerancenum'])===null||$tmp==='' ? '' : $tmp);?>
"/>
		</div>
		<div>
			<input type="submit" value="save"/>
			<a href="<?php echo site_url();?>
/incomingSpec/">Back To List</a>
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