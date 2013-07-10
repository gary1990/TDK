<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Report Center</title>	
<!--{/block}-->
<!--{block name=style}-->
<link rel="stylesheet" type="text/css" href="{base_url()}resource/css/ui.datepicker.css" />
<style>
</style>
<!--{/block}-->
<!--{block name=script}-->
<script src="{base_url()}resource/js/highCharts/highcharts.js"></script>
<script src="{base_url()}resource/js/highCharts/modules/exporting.js"></script>
<script type="text/javascript" src="{base_url()}resource/js/calendar/ui.datepicker.js"></script>
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
				valueSuffix: ['{$unitname|default:''}']
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
		/*{foreach from=$resultList key=k item=value}*/
		options.xAxis.categories.push('{$k}');
		series.data.push(/*{$value}*/);
		/*{/foreach}*/
		/*{foreach from=$limitLine2 key=k item=value}*/
		series2.data.push(/*{$value}*/);
		/*{/foreach}*/
		/*{foreach from=$limitLine1 key=k item=value}*/
		series1.data.push(/*{$value}*/);
		/*{/foreach}*/
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
			buttonImage: '{base_url()}resource/img/calendar.gif',
			buttonImageOnly: true,
			showButtonPanel: true
		});
	});
	jQuery(function($)
	{
		$('#endtime').datepicker({
			yearRange: '1900:2999',
			showOn: 'both',
			buttonImage: '{base_url()}resource/img/calendar.gif',
			buttonImageOnly: true,
			showButtonPanel: true
		});
	});
</script>
<!--{/block}-->
<!--{block name=body}-->
<div class="span-64 last subitems">
	<div>
		<form id="searchForm" action="{site_url()}/reportCenter" method="post">
			<span class="span-block1">
				Part NO.:
			</span>
			{html_options name=partno class=partno options=$partnoArr selected=$smarty.post.partno|default:''}
			<span class="span-block1">
				Start time:
			</span>
			<input type="text" id="starttime" name="starttime" class="starttime" value="{$smarty.post.starttime|default:''}"/>
			<span class="span-block1">
				End time:
			</span>
			<input type="text" id="endtime" name="endtime" class="endtime" value="{$smarty.post.endtime|default:''}"/>
			<input type="submit" value="Search"/>
		</form>
	</div>
	<div>
		<div id="reportform" class="reportform"><div>
	</div>
</div>
<!--{/block}-->