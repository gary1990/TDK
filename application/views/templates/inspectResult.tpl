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
			var totalcount = $('.totalcount').val();
			if(totalcount > 500)
			{
				var r = confirm("More than "+totalcount+"will be exported,sure to export?");
				if (r == true)
			    {
					var site_url = $(".siteurl").val();
					var url = site_url+'/inspectResult/exportResult';
					$("#searchForm").attr('action', url);
					$("#searchForm").submit();
			    }
			  	else
			    {
					//
			    }
			}
			else
			{
				var site_url = $(".siteurl").val();
				var url = site_url+'/inspectResult/exportResult';
				$("#searchForm").attr('action', url);
				$("#searchForm").submit();
			}
		});
		
		$(".totalcheckbox").click(function(){
			var check = $(this).attr("checked");
			if(check == 'checked')
			{
				$('.recordcheckbox').attr("checked","checked");
			}
			else
			{
				$('.recordcheckbox').removeAttr("checked");
			}
		});
		
		$(".deleterecord").click(function(e){
			e.preventDefault();
			var result = confirm("You sure to DELETE selected records?");
			if(result)
			{
				$("#inspectResultForm").submit();
			}
			else
			{
				//do nothing
			}
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
					StartTime:
				</span>
				<input type="text" id="timefrom" name="timefrom" class="timefrom" value="{$smarty.post.timefrom|default:''}"/>
				<span class="span-block1">
					EndTime:
				</span>
				<input id="timeto" type="text" id="timeto" name="timeto" class="timeto" value="{$smarty.post.timeto|default:''}"/>
				<input class="searchBtn" type="submit" value="Search"/>
			</div>
		</form>
	</div>
	<div>
		<form id="inspectResultForm" action="{site_url()}/inspectResult/inspectResultPost/" method="post">
			<div style="width: 960px; overflow: auto; margin-bottom: 10px;">
				<table>
					<tr>
						{if $CI->session->userdata('rolename') eq 'Admin'}
							<th>&nbsp;</th>
						{else}
						{/if}
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
					{counter name="numcounter" start=$offset skip=1 print=FALSE}
					{foreach from=$resultArr item=value name=resultforeach}
						<tr>
							{if $CI->session->userdata('rolename') eq 'Admin'}
								<td><input class="recordcheckbox" name="checkbox{$value['id']}" type="checkbox"></td>
							{else}
							{/if}
							<td>{counter name="numcounter"}</td>
							<td>{$value['testTime']}</td>
							<td>{$value['partno']}</td>
							<td>{$value['typename']}</td>
							<td>{$value['measvlaue']}</td>
							<td>
								{if $value['result'] eq 1}
									<span style="color:green;">Pass</span>
								{else}
									<span style="color:red;">Fail</span>
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
			</div>
		</form>
		<input type='hidden' class="totalcount" value="{$totalcount|default:''}" />
		<input class="siteurl" type="hidden" value="{site_url()}"/>
		{$CI->pagination->create_links()}
		<div style="margin-top: 20px;">
			{if $CI->session->userdata('rolename') eq 'Admin'}
				<input class="totalcheckbox" type="checkbox">Select all
				<a class="deleterecord" href="#">Delete</a>
			{else}
			{/if}
		</div>
		<div style="text-align: right;margin-bottom: 30px;">
			<input class="exportBtn" type="button" value="Export"/>
		</div>
	</div>
</div>
<!--{/block}-->