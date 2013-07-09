<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Incoming Spec Import</title>	
<!--{/block}-->
<!--{block name=style}-->
<style>
	.span-block125
	{
		display:inline-block;
		width:125px;
	}
	.margin-bottom10
	{
		margin-bottom:10px;
	}
</style>
<!--{/block}-->
<!--{block name=script}-->
<script type="text/javascript">
</script>
<!--{/block}-->
<!--{block name=body}-->
<div class="span-64 last subitems">
	<h3>Import</h3>
	<form action="{site_url()}/incomingSpec/importConfigPost/" method="post" enctype="multipart/form-data">
		<div class="margin-bottom10">
			<span class="span-block125">Select A File:</span>
			<input type="file" name="file" value="" />
		</div>
		<div>
			<input type="submit" value="Import"/>
			<a href="{site_url()}/incomingSpec/index">Cancel</a>
		</div>
	</form>
	<div style="color:red;">{$errmesg|default:''}</div>
</div>
<!--{/block}-->