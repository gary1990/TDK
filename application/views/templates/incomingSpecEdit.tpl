<!--{extends file='default.tpl'}-->
<!--{block name=title}-->
<title>Incoming Spec Edit</title>	
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
	.input-long{
		width:190px;
	}
	.input-short{
		width:100px;
	}
	.input-165{
		width:165px;
	}
	.text-area{
		width:190px;
	}
	.select-long{
		width:194px;
	}
	.select-short{
		width:87px;
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
		$("#incomingEditForm").validationEngine('attach',
		{
			promptPosition : "centerRight",
			autoPositionUpdate : "true"
		});
		$(".cancelBtn").click(function(){
			var url = '{site_url()}/incomingSpec/';
			window.location.replace(url);
		});
	});
</script>
<!--{/block}-->
<!--{block name=body}-->
<div class="span-64 last subitems">
	<h3>Edit</h3>
	<form id="incomingEditForm" action="{site_url()}/incomingSpec/editPost/" method="post">
		<input name="incomingSpecId" type="hidden" value="{$incomingRecord['id']|default:$smarty.post.incomingSpecId}"/>
		<div class="margin-bottom10">
			<span class="span-block125">Part No.*:</span>
			<input id='partno' name="partno" type="text" class="input-long validate[required]" value="{$incomingRecord['partno']|default:$smarty.post.partno|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Supplier*:</span>
			<input id="supplier" name="supplier" class="input-long validate[required]" type="text" value="{$incomingRecord['supplier']|default:$smarty.post.supplier|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Description:</span>
			<textarea class="text-area" name="description">{$incomingRecord['description']|default:$smarty.post.description|default:''}</textarea>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Type*:</span>
			{html_options name=type class="select-long type" options=$typeArr selected=$incomingRecord['type']|default:$smarty.post.type|default:'1'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Voltage:</span>
			<input id="testvoltage" name="testvoltage" class="input-165 validate[custom[number]]" value="{if strlen($incomingRecord['testvoltage']) eq 0}{else}{$incomingRecord['testvoltage']|substr:0:-3|default:''}{/if}"/>Vdc
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Freq:</span>
			<input id="frequencyvalue" name="frequencyvalue" class="input-short validate[custom[number]]" value="{$incomingRecord['testfrequency']|substr:0:-3|default:$smarty.post.frequencyvalue|default:''}"/>
			{html_options name=frequnit class="select-short frequnit" options=$freqUnitArr selected=$incomingRecord['testfrequency']|substr:-3|default:$smarty.post.frequnit|default:'kHz'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Residual inductance:</span>
			{if $incomingRecord['type'] eq 1}
			<input id="residualinductance" class="input-long residualinductance validate[custom[number]]" name="residualinductance" value="{$incomingRecord['residualinductance']|default:$smarty.post.residualinductance|default:''}"/>
			{else}
			<input id="residualinductance" disabled="disabled" class="input-long residualinductance validate[custom[number]]" name="residualinductance" value="{$incomingRecord['residualinductance']|default:$smarty.post.residualinductance|default:''}"/>
			{/if}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Nomimal Value*:</span>
			<input id="nominalvalue" class="input-long nominalvalue validate[required,custom[number]]" name="nominalvalue" value="{$incomingRecord['nominalvalue']|default:$smarty.post.nominalvalue|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Unit:</span>
			{html_options name=unit class="select-long unit" options=$unitArr selected=$incomingRecord['unit']|default:$smarty.post.unit|default:'5'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol %*:</span>
			+/-<input id="tolerance" class="tolerance validate[required,custom[number]]" name="tolerance" value="{$incomingRecord['tolerance']|default:$smarty.post.tolerance|default:''}"/>%
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol Num*:</span>
			+/-<input id="tolerancenum" class="tolerancenum validate[required,custom[number]]" name="tolerancenum" value="{$incomingRecord['tolerancenum']|default:$smarty.post.tolerancenum|default:''}"/>
		</div>
		<div style="margin-top: 20px;">
			<input type="submit" value="Save"/>
			<input class="cancelBtn" type="button" value="Cancel"/>
		</div>
	</form>
	<div style="color:red;">{$errmesg|default:''}</div>
</div>
<!--{/block}-->
