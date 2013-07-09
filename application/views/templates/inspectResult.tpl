<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Inspect Result</title>	
<!--{/block}-->
<!--{block name=style}-->
<link rel="stylesheet" type="text/css" href="{base_url()}resource/css/ui.datepicker.css" />
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
<!--{/block}-->
<!--{block name=script}-->
<script type="text/javascript" src="{base_url()}resource/js/calendar/ui.datepicker.js"></script>
<script type="text/javascript" src="{base_url()}resource/js/jquery.form.js"></script>
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
			buttonImage: '{base_url()}resource/img/calendar.gif',
			buttonImageOnly: true,
			showButtonPanel: true
		});
	});
	jQuery(function($)
	{
		$('#timeto').datepicker({
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
		<form id="searchForm" action="{site_url()}/inspectResult" method="POST">
			<div class="serchCondition">
				<span class="span-block1">
					Supplier:
				</span>
				{html_options name=supplier class=supplier options=$supplier selected=$smarty.post.supplier|default:''}
				<span class="span-block1">
					Type:
				</span>
				{html_options name=type class=type options=$type selected=$smarty.post.type|default:''}
				<span class="span-block1">
					Batch No.:
				</span>
				<input type="text" name="batchno" class="batchno" value="{$smarty.post.batchno|default:''}"/>
				<span class="span-block1">
					Result:
				</span>
				{html_options name=testresult class=testresult options=$testresult selected=$smarty.post.testresult|default:''}
			</div>
			<div class="serchCondition">
				<span class="span-block1">
					TimeFrom:
				</span>
				<input type="text" id="timefrom" name="timefrom" class="timefrom" value="{$smarty.post.timefrom|default:''}"/>
				<span class="span-block1">
					TimeTo:
				</span>
				<input id="timeto" type="text" id="timeto" name="timeto" class="timeto" value="{$smarty.post.timeto|default:''}"/>
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
			{foreach from=$resultArr item=value name=resultforeach}
				<tr>
					<td>{$smarty.foreach.resultforeach.index+1}</td>
					<td>{$value['testTime']}</td>
					<td>{$value['partno']}</td>
					<td>{$value['typename']}</td>
					<td>{$value['measvlaue']}</td>
					<td>
						{if $value['result'] eq 1}
							<span style="color:green;">合格</span>
						{else}
							<span style="color:red;">不合格</span>
						{/if}
					</td>
					<td>{$value['betchno']}</td>
					<td>{$value['supplier']}</td>
					<td>{$value['inspector']}</td>
					<td>
						{$value['nominalvalue']}+/-{$value['tolerancenum']}{$value['unitname']}
					</th>
				</tr>
			{/foreach}
		</table>
		<input class="siteurl" type="hidden" value="{site_url()}"/>
		{$CI->pagination->create_links()}
		<div style="text-align: right;">
			<input class="exportBtn" type="button" value="Export"/>
		</div>
	</div>
</div>
<!--{/block}-->