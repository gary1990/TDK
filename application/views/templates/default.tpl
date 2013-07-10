<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!--{$commonHead}-->
		<!--{block name=include}-->
		<!--{$jqueryHead}-->
		<!--{$validationEngineHead}-->
		<!--{/block}-->
		<!--{block name=title}-->
		<!--{/block}-->
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
				background:url("{base_url()}resource/img/left.png") no-repeat left top;
			}
			#tabs a.clicked span
			{
				background:url("{base_url()}resource/img/right.png") no-repeat right top;
			}
			
			#tabs a:hover 
			{
				float:left;
				background:url("{base_url()}resource/img/left.png") no-repeat left top;
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
				background:url("{base_url()}resource/img/right.png") no-repeat right top;
				padding:6px 15px 4px 6px;
				margin-right:2px;
				color:black;
				cursor: pointer;
			}
		</style>
		<!--{block name=style}-->
		<!--{/block}-->
		<!--{block name=script}-->
		<!--{/block}-->
	</head>
	<body class="cldn">
		<div class="container">
			<div class="span-64 last defaulttitle">
				<img id="logoimg" src="{base_url()}resource/img/tdkEpcosLogo.gif"/>
				<span class="span-45 inlineblock middletitle">Incoming Inspection and Quality Control</span>
				<span class="inlineblock">{$CI->session->userdata('username')}</span>
				<span class="inlineblock"><a href="{site_url('login/logout')}">Logout</a></span>
				<hr/>
			</div>
			<div>
				<div id="tabs">
				  <ul>
				    <li>
				    	<a class="{if $currenmenu == 'incomingspect'}clicked{else}{/if}" href="{base_url()}index.php/incomingSpec">
				    		<span>Incoming Spec</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="{if $currenmenu == 'inspectresult'}clicked{else}{/if}" href="{base_url()}index.php/inspectResult">
				    		<span>Inspect Result</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="{if $currenmenu == 'reportcenter'}clicked{else}{/if}" href="{base_url()}index.php/reportCenter">
				    		<span>Report Center</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="{if $currenmenu == 'user'}clicked{else}{/if}" href="{base_url()}index.php/user">
				    		<span>User</span>
				    	</a>
				    </li>
				    <li>
				    	<a class="{if $currenmenu == 'inspector'}clicked{else}{/if}" href="{base_url()}index.php/inspector">
				    		<span>Inspector</span>
				    	</a>
				    </li>
				  </ul>
				</div>
				<div>&nbsp;</div>
				<!--{block name=body}-->
				<!--{/block}-->
			</div>
		</div>
	</body>
</html>