<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Incoming Spec</title>	
<!--{/block}-->
<!--{block name=style}-->
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
<!--{/block}-->
<!--{block name=script}-->
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
<!--{/block}-->
<!--{block name=body}-->
<div class="span-64 last subitems">
	<a href="{site_url()}/incomingSpec/createGet/">Add</a>
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
		{foreach from=$incomingspecArr item=incomingspec}
			<tr>
				<td>{$incomingspec['partno']}</td>
				<td>{$incomingspec['supplier']}</td>
				<td>{$incomingspec['description']}</td>
				<td>{$incomingspec['typename']}</td>
				<td>{$incomingspec['testvoltage']}</td>
				<td>{$incomingspec['testfrequency']}</th>
				<td>{$incomingspec['residualinductance']}</td>
				<td>{$incomingspec['nominalvalue']}</td>
				<td>{$incomingspec['name']}</td>
				<td>+/-{$incomingspec['tolerance']}%</td>
				<td>+/-{$incomingspec['tolerancenum']}</td>
				<td>
					<a href="{site_url()}/incomingSpec/editGet/{$incomingspec['id']}">Edit</a>
					<a class="deleteaction" href="{site_url()}/incomingSpec/delete/{$incomingspec['id']}">Delete</a>
				</td>
			</tr>
		{/foreach}
	</table>
	<input class="siteurl" type="hidden" value="{site_url()}"/>
	{$CI->pagination->create_links()}
	<div style="text-align: right;">
		<a href="#">Download Application</a>
		<a href="{site_url()}/incomingSpec/downloadTemplate">Download Templete</a>
		<input class="importConfig" type="button" value="Import"/>
		<input class="exportConfig" type="button" value="Export"/>
	</div>
</div>
<!--{/block}-->
