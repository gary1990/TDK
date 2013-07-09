<?php /* Smarty version Smarty-3.1.8, created on 2013-07-08 12:52:44
         compiled from "application/views/templates\inspectResult.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1335451d50ea7cc9c60-60232018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8888f668acf2352a73c934820deb8bff4775a7cc' => 
    array (
      0 => 'application/views/templates\\inspectResult.tpl',
      1 => 1373259128,
      2 => 'file',
    ),
    '0a09857ede85b02bbc4dd7a34cfdea24f1afa9f0' => 
    array (
      0 => 'application/views/templates\\default.tpl',
      1 => 1373253266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1335451d50ea7cc9c60-60232018',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d50ea804cb91_68938554',
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
<?php if ($_valid && !is_callable('content_51d50ea804cb91_68938554')) {function content_51d50ea804cb91_68938554($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'E:\\wwwRoot\\TDK\\system\\libraries\\Smarty\\libs\\plugins\\function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $_smarty_tpl->tpl_vars['commonHead']->value;?>

		
		<?php echo $_smarty_tpl->tpl_vars['jqueryHead']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['validationEngineHead']->value;?>

		
		
<title>Inspect Result</title>	

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
		
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>
resource/css/ui.datepicker.css" />
<style>
	tr th
	{
		background-color:#CC9900;
		color:white;
	}
	table
	{
		border-collapse: collapse;
	}
	th,td
	{
		border:1px solid #DDDDDD;
	}
	td
	{
		background-color:white;
	}
	.span-block1{
		width:80px;
		display:inline-block;
	}
	.serchCondition{
		margin-bottom:10px;
	}
</style>

		
<script type="text/javascript" src="<?php echo base_url();?>
resource/js/calendar/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>
resource/js/jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//分页事件
		$(".locPage > a").click(function(e) 
		{
			e.preventDefault();
			var site_url = $(".siteurl").val();
			var url = site_url+'/inspectResult/index'+ $(this).attr('href');
			$("#searchForm").attr('action', url);
			$("#searchForm").submit();
		});
		
		$(".searchBtn").click(function(e){
			e.preventDefault();
			var site_url = $(".siteurl").val();
			var url = site_url+'/inspectResult';
			$("#searchForm").attr('action', url);
			$("#searchForm").submit();
		});
		
		$(".exportBtn").click(function(e){
			e.preventDefault();
			var site_url = $(".siteurl").val();
			var url = site_url+'/inspectResult/exportResult';
			$("#searchForm").attr('action', url);
			$("#searchForm").submit();
		});
	});
	
	jQuery(function($)
	{
		$('#timefrom').datepicker({
			yearRange: '1900:2999',
			showOn: 'both',
			buttonImage: '<?php echo base_url();?>
resource/img/calendar.gif',
			buttonImageOnly: true,
			showButtonPanel: true
		});
	});
	jQuery(function($)
	{
		$('#timeto').datepicker({
			yearRange: '1900:2999',
			showOn: 'both',
			buttonImage: '<?php echo base_url();?>
resource/img/calendar.gif',
			buttonImageOnly: true,
			showButtonPanel: true
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
	<div>
		<form id="searchForm" action="<?php echo site_url();?>
/inspectResult" method="POST">
			<div class="serchCondition">
				<span class="span-block1">
					Supplier:
				</span>
				<?php echo smarty_function_html_options(array('name'=>'supplier','class'=>'supplier','options'=>$_smarty_tpl->tpl_vars['supplier']->value,'selected'=>(($tmp = @$_POST['supplier'])===null||$tmp==='' ? '' : $tmp)),$_smarty_tpl);?>

				<span class="span-block1">
					Type:
				</span>
				<?php echo smarty_function_html_options(array('name'=>'type','class'=>'type','options'=>$_smarty_tpl->tpl_vars['type']->value,'selected'=>(($tmp = @$_POST['type'])===null||$tmp==='' ? '' : $tmp)),$_smarty_tpl);?>

				<span class="span-block1">
					Batch No.:
				</span>
				<input type="text" name="batchno" class="batchno" value="<?php echo (($tmp = @$_POST['batchno'])===null||$tmp==='' ? '' : $tmp);?>
"/>
				<span class="span-block1">
					Result:
				</span>
				<?php echo smarty_function_html_options(array('name'=>'testresult','class'=>'testresult','options'=>$_smarty_tpl->tpl_vars['testresult']->value,'selected'=>(($tmp = @$_POST['testresult'])===null||$tmp==='' ? '' : $tmp)),$_smarty_tpl);?>

			</div>
			<div class="serchCondition">
				<span class="span-block1">
					TimeFrom:
				</span>
				<input type="text" id="timefrom" name="timefrom" class="timefrom" value="<?php echo (($tmp = @$_POST['timefrom'])===null||$tmp==='' ? '' : $tmp);?>
"/>
				<span class="span-block1">
					TimeTo:
				</span>
				<input id="timeto" type="text" id="timeto" name="timeto" class="timeto" value="<?php echo (($tmp = @$_POST['timeto'])===null||$tmp==='' ? '' : $tmp);?>
"/>
			</div>
			<input class="searchBtn" type="submit" value="Go"/>
		</form>
	</div>
	<div>
		<table>
			<tr>
				<th>No</th>
				<th>Time</th>
				<th>Part No.</th>
				<th>Type</th>
				<th>Meas. Value</th>
				<th>Result</th>
				<th>Batch No.</th>
				<th>Supplier</th>
				<th>Inspector</th>
				<th>Nominal/Tol</th>
			</tr>
			<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resultArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['resultforeach']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['resultforeach']['index']++;
?>
				<tr>
					<td><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['resultforeach']['index']+1;?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['testTime'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['partno'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['typename'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['measvlaue'];?>
</td>
					<td>
						<?php if ($_smarty_tpl->tpl_vars['value']->value['result']==1){?>
							<span style="color:green;">合格</span>
						<?php }else{ ?>
							<span style="color:red;">不合格</span>
						<?php }?>
					</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['betchno'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['supplier'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['value']->value['inspector'];?>
</td>
					<td>
						<?php echo $_smarty_tpl->tpl_vars['value']->value['nominalvalue'];?>
+/-<?php echo $_smarty_tpl->tpl_vars['value']->value['tolerancenum'];?>
<?php echo $_smarty_tpl->tpl_vars['value']->value['unitname'];?>

					</th>
				</tr>
			<?php } ?>
		</table>
		<input class="siteurl" type="hidden" value="<?php echo site_url();?>
"/>
		<?php echo $_smarty_tpl->tpl_vars['CI']->value->pagination->create_links();?>

		<div style="text-align: right;">
			<input class="exportBtn" type="button" value="Export"/>
		</div>
	</div>
</div>

				</div>
			</div>
		</div>
	</body>
</html><?php }} ?>