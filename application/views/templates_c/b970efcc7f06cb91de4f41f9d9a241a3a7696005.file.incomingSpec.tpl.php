<?php /* Smarty version Smarty-3.1.8, created on 2013-07-10 14:42:39
         compiled from "application/views/templates\incomingSpec.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114751d45a32bec288-17794882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b970efcc7f06cb91de4f41f9d9a241a3a7696005' => 
    array (
      0 => 'application/views/templates\\incomingSpec.tpl',
      1 => 1373437806,
      2 => 'file',
    ),
    '0a09857ede85b02bbc4dd7a34cfdea24f1afa9f0' => 
    array (
      0 => 'application/views/templates\\default.tpl',
      1 => 1373253266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114751d45a32bec288-17794882',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d45a32d2a772_87529676',
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
<?php if ($_valid && !is_callable('content_51d45a32d2a772_87529676')) {function content_51d45a32d2a772_87529676($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $_smarty_tpl->tpl_vars['commonHead']->value;?>

		
		<?php echo $_smarty_tpl->tpl_vars['jqueryHead']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['validationEngineHead']->value;?>

		
		
<title>Incoming Spec</title>	

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
</style>

		
<script type="text/javascript">
	$(document).ready(function(){
		//分页事件
		$(".locPage > a").click(function(e) {
			e.preventDefault();
			var site_url = $(".siteurl").val();
			var url = site_url+'/incomingSpec/index'+ $(this).attr('href');
			window.location.replace(url);
		});
		
		$(".deleteaction").click(function(e){
			e.preventDefault();
			var result = confirm("You sure to DELETE this record?");
			if(result)
			{
				var url = $(this).attr('href');
				window.location.replace(url);
			}
			else
			{
				//do nothing
			}
		});
		
		$(".importConfig").click(function(){
			var site_url = $(".siteurl").val();
			var url = site_url+'/incomingSpec/importConfigGet';
			window.location.replace(url);
		});
		
		$(".exportConfig").click(function(){
			var site_url = $(".siteurl").val();
			var url = site_url+'/incomingSpec/exportConfig';
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
	<a href="<?php echo site_url();?>
/incomingSpec/createGet/">Add</a>
	<table>
		<tr>
			<th>Part NO.</th>
			<th>Supplier</th>
			<th>Description</th>
			<th>Type</th>
			<th>Test Voltage</th>
			<th>Test Freq</th>
			<th>Residual inductance</th>
			<th>Nominal Value</th>
			<th>Unit</th>
			<th>Tol %</th>
			<th>Tol Num</th>
			<th>&nbsp;</th>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['incomingspec'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['incomingspec']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['incomingspecArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['incomingspec']->key => $_smarty_tpl->tpl_vars['incomingspec']->value){
$_smarty_tpl->tpl_vars['incomingspec']->_loop = true;
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['partno'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['supplier'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['description'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['typename'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['testvoltage'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['testfrequency'];?>
</th>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['residualinductance'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['nominalvalue'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['name'];?>
</td>
				<td>+/-<?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['tolerance'];?>
%</td>
				<td>+/-<?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['tolerancenum'];?>
</td>
				<td>
					<a href="<?php echo site_url();?>
/incomingSpec/editGet/<?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['id'];?>
">Edit</a>
					<a class="deleteaction" href="<?php echo site_url();?>
/incomingSpec/delete/<?php echo $_smarty_tpl->tpl_vars['incomingspec']->value['id'];?>
">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
	<input class="siteurl" type="hidden" value="<?php echo site_url();?>
"/>
	<?php echo $_smarty_tpl->tpl_vars['CI']->value->pagination->create_links();?>

	<div style="text-align: right;">
		<a href="#">Download Application</a>
		<a href="<?php echo site_url();?>
/incomingSpec/downloadTemplete">Download Templete</a>
		<input class="importConfig" type="button" value="Import"/>
		<input class="exportConfig" type="button" value="Export"/>
	</div>
</div>

				</div>
			</div>
		</div>
	</body>
</html><?php }} ?>