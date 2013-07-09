<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Incoming Spec Create</title>	
<!--{/block}-->
<!--{block name=style}-->
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
<!--{/block}-->
<!--{block name=script}-->
<script type="text/javascript">
	$(document).ready(function(){
		$(".type").change(function(){
			var type = $(this).val();
			$(".unit").load('{site_url()}/incomingSpec/getUnit/'+type);
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
<!--{/block}-->
<!--{block name=body}-->
<div class="span-64 last subitems">
	<h3>Create</h3>
	<form id="locLoginForm" action="{site_url()}/incomingSpec/createPost/" method="post">
		<div class="margin-bottom10">
			<span class="span-block125">Part No.:</span>
			<input id='partno' name="partno" type="text" class="validate[required]" value="{$smarty.post.partno|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Supplier:</span>
			<input id="supplier" name="supplier" class="validate[required]" type="text" value="{$smarty.post.supplier|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Description:</span>
			<textarea name="description">{$smarty.post.description|default:''}</textarea>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Type:</span>
			{html_options name=type class=type options=$typeArr selected=$smarty.post.type|default:'1'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Voltage:</span>
			<input id="testvoltage" name="testvoltage" class="validate[custom[testVoltageFormart]]" value="{$smarty.post.testvoltage|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Freq:</span>
			<input id="frequencyvalue" name="frequencyvalue" class="validate[custom[number]]" value="{$smarty.post.frequencyvalue|default:''}"/>
			{html_options name=frequnit class=frequnit options=$freqUnitArr selected=$smarty.post.frequnit|default:'kHz'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Residual inductance:</span>
			<input id="residualinductance" class="residualinductance validate[custom[number]]" name="residualinductance" value="{$smarty.post.residualinductance|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Nomimal Value:</span>
			<input id="nominalvalue" class="nominalvalue validate[required,custom[number]]" name="nominalvalue" value="{$smarty.post.nominalvalue|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Unit:</span>
			{html_options name=unit class=unit options=$unitArr selected=$smarty.post.unit|default:'5'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol %:</span>
			+/-<input id="tolerance" class="tolerance validate[custom[number]]" name="tolerance" value="{$smarty.post.tolerance|default:''}"/>%
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol Num:</span>
			+/-<input id="tolerancenum" class="tolerancenum validate[custom[number]]" name="tolerancenum" value="{$smarty.post.tolerancenum|default:''}"/>
		</div>
		<div>
			<input type="submit" value="save"/>
			<a href="{site_url()}/incomingSpec/">Back To List</a>
		</div>
	</form>
	<div style="color:red;">{$errmesg|default:''}</div>
</div>
<!--{/block}-->