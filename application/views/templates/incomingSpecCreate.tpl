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
		$("#locLoginForm").validationEngine('attach',
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
	<h3>Create</h3>
	<form id="locLoginForm" action="{site_url()}/incomingSpec/createPost/" method="post">
		<div class="margin-bottom10">
			<span class="span-block125">Part No.*:</span>
			<input id='partno' name="partno" type="text" class="input-long validate[required]" value="{$smarty.post.partno|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Supplier*:</span>
			<input id="supplier" name="supplier" class="input-long validate[required]" type="text" value="{$smarty.post.supplier|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Description:</span>
			<textarea class="text-area" name="description">{$smarty.post.description|default:''}</textarea>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Type*:</span>
			{html_options name=type class="type select-long" options=$typeArr selected=$smarty.post.type|default:'1'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Voltage:</span>
			<input id="testvoltage" name="testvoltage" class="input-165 validate[custom[number]]" value="{$smarty.post.testvoltage|default:''}"/>Vdc
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Test Freq:</span>
			<input id="frequencyvalue" name="frequencyvalue" class="input-short validate[custom[number]]" value="{$smarty.post.frequencyvalue|default:''}"/>
			{html_options name=frequnit class="select-short frequnit" options=$freqUnitArr selected=$smarty.post.frequnit|default:'kHz'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Residual inductance:</span>
			<input id="residualinductance" class="input-long residualinductance validate[custom[number]]" name="residualinductance" value="{$smarty.post.residualinductance|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Nomimal Value*:</span>
			<input id="nominalvalue" class="input-long nominalvalue validate[required,custom[number]]" name="nominalvalue" value="{$smarty.post.nominalvalue|default:''}"/>
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Unit*:</span>
			{html_options name=unit class="unit select-long" options=$unitArr selected=$smarty.post.unit|default:'5'}
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol %*:</span>
			+/-<input id="tolerance" class="tolerance validate[required,custom[number]]" name="tolerance" value="{$smarty.post.tolerance|default:''}"/>%
		</div>
		<div class="margin-bottom10">
			<span class="span-block125">Tol Num*:</span>
			+/-<input id="tolerancenum" class="tolerancenum validate[required,custom[number]]" name="tolerancenum" value="{$smarty.post.tolerancenum|default:''}"/>
		</div>
		<div style="margin-top: 20px;">
			<input type="submit" value="Save"/>
			<input class="cancelBtn" type="button" value="Cancel"/>
		</div>
	</form>
	<div style="color:red;">{$errmesg|default:''}</div>
</div>
<!--{/block}-->