{include file='common/header.tpl'}
{include file='common/navbar_logged_in.tpl'}
{include file='common/logout.tpl'}

<div class="menusLogin p-5">
<div class="vehicle_text">


	<h2 class="display-4 text-white">Survey Data</h2>
	<p class="lead text-white mb-0">Information about the selected Survey</p>
	<div class="separator"></div>
	{if (isset($success_messages))}
    {foreach $success_messages as $success}
      <div class="msg_success"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$success}</div>
    {/foreach}
  {/if}
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}
  {if $notpublic}
    <p>Survey information not publicly available.</p>
  {else}
	<article>
		<p><label class="vehicle_info_label">Survey Id:</label>{$rid}</p>
		<p><label class="vehicle_info_label">Entity Name:</label>{if $info['mission_status']=='Finish'} {$info['provider_name']} ({$info['provider_username']}){else} Request waiting Service Provider submition {/if}</p>
		<p><label class="vehicle_info_label">Client Name:</label>{$info['client_name']} ({$info['client_username']})</p>
		<p><label class="vehicle_info_label">Upload Date:</label>{if $info['mission_status']=='Finish'} {$info['data_date']}{else} Request waiting Service Provider submition {/if}</p>
		<p><label class="vehicle_info_label">Comments:</label>{$info['request_comments']}</p>
	</article>
	<article>
		<div class="grid">
		<div id="mapid" style="width: 90%; height: 25em; grid-column-start: 1;  grid-column-end: 2; grid-row-start: 1; grid-row-end: 3;"></div>
		<div id="tooltip"></div>
		<script>
			 var map, tooltip, deleteShape;
			 mapConfiguration();
			 getsurveydata('../actions/action_send_area_request.php');
	 	</script>
		<div class="filters">
			<p><label class="vehicle_info_label" style="margin-left:15px">Sensor Type:</label>{$info['request_sensor_type']}</p>
			<p><label class="vehicle_info_label" style="margin-left:15px">Resolution:</label>{$info['request_res_value']}</p>
			<p><label class="vehicle_info_label" style="margin-left:15px">File Type:</label>{if $info['mission_status']=='Finish'} {$info['data_file_type']}{else} Request waiting Service Provider submition {/if}</p>
		</div>
	</article>
	<article>
			<p><label class="vehicle_info_label" style="margin-top:8px">Price:</label>{if $info['mission_status']=='Finish'} {$info['data_price']}€{else} Request waiting Service Provider submition {/if}</p>
			{if $info['mission_status']=='Finish' and $info['mission_details']}
			<p><a href="{$BASE_URL}{$info['mission_details']}" class="button"><label class="vehicle_info_label" style="width: 18rem;">Download Mission Details</label></a></p>
			{/if}
	</article> 
	 <a href="{$PREVIOUSPAGE}" class="button"><button type="button" class ="confirm" style="padding:8px;">Go back</button></a>
</div>
{/if}
</div>
</div>
{include file='common/footer-short.tpl'}
