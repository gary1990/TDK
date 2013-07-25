<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Incoming Spec</title>	
<!--{/block}-->
<!--{block name=style}-->
<link rel="stylesheet" type="text/css" href="{base_url()}resource/css/chosen.css" />
<style>
	tr th
	{
		background-color:#CC9900;
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
	th a{
		color:white;
	}

	.addhref{
		margin-bottom: 5px;
		clear:both;
	}
	.span-block1{
		display: inline-block;
		margin-right: 10px;
	}
	.search-div{
		margin-bottom: 30px;
	}
	.serchCondition{
		margin-right:30px;
		float:left;
		height:30px;
	}
	.serchConditionpadding5{
		margin-right:30px;
		float:left;
		height:30px;
		padding-top:5px;
	}
	.searchSelect{
		width:140px;
	}
</style>
<!--{/block}-->
<!--{block name=script}-->
<script type="text/javascript" src="{base_url()}resource/js/chosen.jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//具有搜索功能的下拉列表
		$(".partno").chosen();
		//分页事件
		$(".locPage > a").click(function(e) {
			e.preventDefault();
			var page = $(this).attr('href');
			if(page == '/')
			{
				page = '/0';
			}
			var curorder = $(".curorder").val();
			if(curorder.indexOf('desc') > 0)
			{
				curorder = curorder.substring(0,curorder.indexOf('desc'));
			}
			var url = $("#searchForm").attr('action')+page+'/'+curorder;
			$("#searchForm").attr('action', url);
			$("#searchForm").submit();
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
		
		$(".deleterecord").click(function(e){
			e.preventDefault();
			var result = confirm("You sure to DELETE selected records?");
			if(result)
			{
				$("#incomingSpecForm").submit();
			}
			else
			{
				//do nothing
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
		
		$(".orderhref").click(function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			$("#searchForm").attr('action', url);
			$("#searchForm").submit();
		});
	});

</script>
<!--{/block}-->
<!--{block name=body}-->
<div class="span-64 last subitems">
	<div class="search-div">
		<form id="searchForm" action="{site_url()}/incomingSpec/index" method="POST">
			<div class="condition">
				<div class="serchCondition">
					<span class="span-block1">
						Part No:
					</span>
					{html_options name=partno class="partno searchSelect" options=$partNoArr selected=$smarty.post.partno|default:''}
				</div>
				<div class="serchConditionpadding5">
					<span class="span-block1">
						Supplier:
					</span>
					{html_options name=supplier class="supplier searchSelect" options=$supplierArr selected=$smarty.post.supplier|default:''}
				</div>
				<div class="serchConditionpadding5">
					<span class="span-block1">
						Type:
					</span>
					{html_options name=type class="type searchSelect" options=$typeArrWithAll selected=$smarty.post.type|default:''}
				</div>
				<input class="searchBtn" type="submit" value="Search"/>
			</div>
		</form>
	</div>
	<div class="addhref">
		<a href="{site_url()}/incomingSpec/createGet/">Add</a>
	</div>
	<form id="incomingSpecForm" action="{site_url()}/incomingSpec/incomingSpecPost/" method="post">
		<div style="width: 960px; overflow: auto; margin-bottom: 10px;">
			<table>
				<tr>
					<th>&nbsp;</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'partnodesc'}partnodesc{else}partno{/if}">Part NO.</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'supplierdesc'}supplierdesc{else}supplier{/if}">Supplier</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'descriptiondesc'}descriptiondesc{else}description{/if}">Description</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'typedesc'}typedesc{else}type{/if}">Type</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'testvoltagedesc'}testvoltagedesc{else}testvoltage{/if}">Test Voltage</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'testfrequencydesc'}testfrequencydesc{else}testfrequency{/if}">Test Freq</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'residualinductancedesc'}residualinductancedesc{else}residualinductance{/if}">Residual inductance</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'nominalvaluedesc'}nominalvaluedesc{else}nominalvalue{/if}">Nominal Value</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'unitdesc'}unitdesc{else}unit{/if}">Unit</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'tolerancedesc'}tolerancedesc{else}tolerance{/if}">Tol %</a>
					</th>
					<th>
						<a class="orderhref" href="{site_url()}/incomingSpec/index/0/{if $assignorderby eq 'tolerancenumdesc'}tolerancenumdesc{else}tolerancenum{/if}">Tol Num</a>
					</th>
					<th>&nbsp;</th>
				</tr>
				{foreach from=$incomingspecArr item=incomingspec}
					<tr>
						<td><input class="recordcheckbox" name="checkbox{$incomingspec['id']}" type="checkbox"></td>
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
		</div>
	</form>
	<input class="siteurl" type="hidden" value="{site_url()}"/>
	<input class="curorder" type="hidden" value="{$assignorderby}"/>
	{$CI->pagination->create_links()}
	<div style="margin-top: 20px;">
		<input class="totalcheckbox" type="checkbox">Select all
		<a class="deleterecord" href="#">Delete</a>
	</div>
	<div style="text-align: right;margin-bottom: 30px;">
		<a href="#">Download Application</a>
		<a href="{site_url()}/incomingSpec/downloadTemplete">Download Templete</a>
		<input class="importConfig" type="button" value="Import"/>
		<input class="exportConfig" type="button" value="Export"/>
	</div>
</div>
<!--{/block}-->
