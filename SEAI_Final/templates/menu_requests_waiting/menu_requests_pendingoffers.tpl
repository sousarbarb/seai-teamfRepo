{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
<div class="vehicle_text">

    <h2 class="display-4 text-white">Pending Offers</h2>
  	<p class="lead text-white mb-0">All missions waiting for clients to approve or refuse</p>
  	<div class="separator">
  	</div>
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

    <article>
    <div style="margin:0em 0em 0em 2em">
      {if count($pending_missions) <= 0}
        <p class="vehicle_res">No pending missions found</p>
      {else}
        {$numresults = count($pending_missions)}
        {if $numresults <= 0}
          <p class="vehicle_res">No results found<p>
        {else}
          <p class="vehicle_res">Numbers of results found: {$numresults}</p>
          <table class="vehicles_table" style="margin:0em 0em 2em 0em">
            <tr>
              <th>Client Name</th>
              <th>Request ID</th>
              <th>Request Sensor Type</th>
              <th>Request Resolution Value</th>
              <th>Estimated Start Time</th>
              <th>Estimated Finish Time</th>
              <th>Detailed Information</th>
            </tr>
            {foreach $pending_missions as $mission}
              <tr>
                <form id="{$mission['request_id']}" method="post" action="{$BASE_URL}actions/open_req_pag.php">
                  <input type="hidden" name="request_id" value="{$mission['request_id']}">
                </form>
                <td>
				 <form id="{$mission['request_id']}_{$mission['client_username']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
						<input type="hidden" name="userinfo_username" value="{$mission['client_username']}">
						<a href="#" onclick="document.getElementById('{$mission['request_id']}_{$mission['client_username']}_seePersonnalPage').submit()" style="color:white;">{$mission['client_name']}</a>
				</form>
				</td>
                <td><a href="#" onclick="document.getElementById('{$mission['request_id']}').submit()" style="color:white;">{$mission['request_id']}</a></td>
                <td>{$mission['request_sensor_type']}</td>
                <td>{$mission['request_res_value']}</td>
                <td>{$mission['mission_start_time']}</td>
                <td>{$mission['mission_finish_time']}</td>
                <td>{if !empty($mission['mission_path_pdf'])}<a href="{$BASE_URL}{$mission['mission_path_pdf']}" download style="text-decoration:underline;color:white;">Download PDF</a>{else}No file available{/if}</td>
              </tr>
            {/foreach}
          </table>
        {/if}
        <p>-----------------------------------------------------------------------------------------------------------------------</p>
      {/if}
    </div>
    </article>

<br>
<br>

</div>
</div>
