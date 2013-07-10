<?php /* Smarty version Smarty-3.1.8, created on 2013-07-10 14:45:26
         compiled from "application/views/templates\reportCenter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:744951d465de459ae6-26358603%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69bf5d58343c558d9d9f83b489d47615c4b069a8' => 
    array (
      0 => 'application/views/templates\\reportCenter.tpl',
      1 => 1373438726,
      2 => 'file',
    ),
    '0a09857ede85b02bbc4dd7a34cfdea24f1afa9f0' => 
    array (
      0 => 'application/views/templates\\default.tpl',
      1 => 1373253266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '744951d465de459ae6-26358603',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d465de532545_03403577',
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
<?php if ($_valid && !is_callable('content_51d465de532545_03403577')) {function content_51d465de532545_03403577($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'E:\\wwwRoot\\TDK\\system\\libraries\\Smarty\\libs\\plugins\\function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $_smarty_tpl->tpl_vars['commonHead']->value;?>

		
		<?php echo $_smarty_tpl->tpl_vars['jqueryHead']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['validationEngineHead']->value;?>

		
		
<title>Report Center</title>	

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
</style>

		
<script src="<?php echo base_url();?>
resource/js/highCharts/highcharts.js"></script>
<script src="<?php echo base_url();?>
resource/js/highCharts/modules/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>
resource/js/calendar/ui.datepicker.js"></script>
<script type="text/javascript">
	function setReportForm()
	{
		var options =
		{
			chart :
			{
				renderTo : 'reportform',
				type : 'spline',
				marginTop: 50
			},
			title :
			{
				text : ''
			},
			xAxis :
			{
				categories : [],
				enabled: false,
				labels: {
                    rotation: -90
                }
			},
			yAxis :
			{
				title: {
					text : ''
				},
				 plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
			},
			legend :
			{
				layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
			},
			tooltip :
			{
				valueSuffix: ['<?php echo (($tmp = @$_smarty_tpl->tpl_vars['unitname']->value)===null||$tmp==='' ? '' : $tmp);?>
']
			},
			series : []
		};
		var series =
		{
			name : 'value',
			data : [],
			pointWidth : 14,
			dataLabels :
			{
				enabled : false,
				rotation : -90,
				color : '#FFFFFF',
				formatter : function()
				{
					return this.y;
				},
				style :
				{
					fontSize : '11px',
					fontFamily : 'Verdana, sans-serif'
				}
			}
		};
		var series2 =
		{
			name : 'Max',
			data : [],
			pointWidth : 14
		};
		var series1 =
		{
			name : 'Min',
			data : [],
			pointWidth : 14,
			dataLabels :
			{
				enabled : false,
				color : '#FFFFFF',
				formatter : function()
				{
					return this.y;
				},
				style :
				{
					fontSize : '11px',
					fontFamily : 'Verdana, sans-serif'
				}
			}
		};
		<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['resultList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
		options.xAxis.categories.push('<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
');
		series.data.push(<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
);
		<?php } ?>
		<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['limitLine2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
		series2.data.push(<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
);
		<?php } ?>
		<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['limitLine1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
		series1.data.push(<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
);
		<?php } ?>
		options.series.push(series);
		options.series.push(series2);
		options.series.push(series1);
		chart = new Highcharts.Chart(options);
	}
	
	$(document).ready(function(){
		setReportForm();
		$("#searchForm").validationEngine('attach',
		{
			promptPosition : "centerRight",
			autoPositionUpdate : "true"
		});
	});

	jQuery(function($)
	{
		$('#starttime').datepicker({
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
		$('#endtime').datepicker({
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
/reportCenter" method="post">
			<span class="span-block1">
				Part NO.:
			</span>
			<?php echo smarty_function_html_options(array('name'=>'partno','class'=>'partno','options'=>$_smarty_tpl->tpl_vars['partnoArr']->value,'selected'=>(($tmp = @$_POST['partno'])===null||$tmp==='' ? '' : $tmp)),$_smarty_tpl);?>

			<span class="span-block1">
				Start time:
			</span>
			<input type="text" id="starttime" name="starttime" class="starttime" value="<?php echo (($tmp = @$_POST['starttime'])===null||$tmp==='' ? '' : $tmp);?>
"/>
			<span class="span-block1">
				End time:
			</span>
			<input type="text" id="endtime" name="endtime" class="endtime" value="<?php echo (($tmp = @$_POST['endtime'])===null||$tmp==='' ? '' : $tmp);?>
"/>
			<input type="submit" value="Search"/>
		</form>
	</div>
	<div>
		<div id="reportform" class="reportform"><div>
	</div>
</div>

				</div>
			</div>
		</div>
	</body>
</html><?php }} ?>