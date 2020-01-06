{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
<div class="vehicle_text">

    <h2 class="display-4 text-white">Waiting Proposals</h2>
  	<p class="lead text-white mb-0">All requests with waiting proposals</p>
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
      {if count($requests) <= 0}
        <p class="vehicle_res">No requests found</p>
      {else}
        {*<p class="vehicle_res">Numbers of requests found: {count($requests)}</p>*}
        {foreach $requests as $request}
          {if (verifyIfRequestIsNotWaitingProposals($request['request_id'])==FALSE)}
          <table>
            <form id="{$request['request_id']}" method="post" action="{$BASE_URL}actions/open_req_pag.php">
              <input type="hidden" name="request_id" value="{$request['request_id']}">
            </form>
            <tr>
              <td><label class="proposals_info_label">Request ID </label><a href="#" onclick="document.getElementById('{$request['request_id']}').submit()" style="color:white;">{$request['request_id']}</a>
              </td>
            </tr>
            <tr>
              <td><label class="proposals_info_label">Request Deadline </label>{if !empty($request['request_deadline'])}{$request['request_deadline']}{else}No deadline{/if}
              </td>
            </tr>
            <tr>
              <td><label class="proposals_info_label">Sensor Type </label>{$request['request_sensor_type']}</td>
            </tr>
            <tr>
              <td><label class="proposals_info_label">Resolution Value </label>{$request['request_res_value']}</td>
            </tr>
            <tr>
              <td><label class="proposals_info_label">Restriction </label>{$request['request_restricted']}</td>
            </tr>
          </table>

          <div style="margin:0em 0em 0em 2em">
          {$missions = getAllMissionsProposal($request['request_id'])}
          {$numresults = count($missions)}
          <table class="vehicle_titulo_table">
          <tr>
            <td class="vehicle_titulo">Missions</td>
          </tr>
          </table>
          {if $numresults <= 0}
            <p class="vehicle_res">No results found<p>
          {else}
            <p class="vehicle_res">Numbers of results found: {$numresults}</p>
            <table class="vehicles_table" style="margin:0em 0em 2em 0em">
              <tr>
                <th>Estimated Start Time</th>
                <th>Estimated Finish Time</th>
                <th>Estimated Price</th>
                <th>Provider Name</th>
                <th>Detailed Information</th>
              </tr>
              {foreach $missions as $mission}
                <tr>
                  <td>{$mission['mission_estimated_start']}</td>
                  <td>{$mission['mission_estimated_finish']}</td>
                  <td>{$mission['mission_price']}</td>
                  <td><form id="{$mission['mission_id']}_{$mission['provider_username']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
						<input type="hidden" name="userinfo_username" value="{$mission['provider_username']}">
						<a href="#" onclick="document.getElementById('{$mission['mission_id']}_{$mission['provider_username']}_seePersonnalPage').submit()" style="color:white;">{$mission['provider_name']}</a>
				    </form>
				</td>
                  <td>{if !empty($mission['mission_path_pdf'])}<a href="{$BASE_URL}{$mission['mission_path_pdf']}" download style="text-decoration:underline;color:white;">Download PDF</a>{else}No file available{/if}</td>
                  <form id="{$mission['mission_id']}_accept" method="post" action="{$BASE_URL}actions/accept_waitingrequest.php">
                      <input type="hidden" name="mission_id" value="{$mission['mission_id']}">
                      <input type="hidden" name="request_id" value="{$request['request_id']}">
                      <input type="hidden" name="provider_id" value="{$mission['provider_id']}">
                  </form>

                  <td><a href="#" onclick="document.getElementById('{$mission['mission_id']}_accept').submit()" class= "button4 submitAsBtn button_provider_hist" style="color:white;width: auto;">Accept</a></td>

                  <form id="{$mission['mission_id']}_ignore" method="post" action="{$BASE_URL}actions/ignore_waitingrequest.php">
                    <input type="hidden" name="mission_id" value="{$mission['mission_id']}">
                    <input type="hidden" name="request_id" value="{$request['request_id']}">
                    <input type="hidden" name="provider_id" value="{$mission['provider_id']}">
                  </form>

                  <td><a href="#" onclick="document.getElementById('{$mission['mission_id']}_ignore').submit()" class= "button4 submitAsBtn button_provider_hist" style="color:white;width: auto;">Ignore</a></td>
                </tr>
              {/foreach}
            </table>
          {/if}
        </div>
        <p>-----------------------------------------------------------------------------------------------------------------------</p>
        {/if}
      {/foreach}
    {/if}
    </article>

<br>
<br>

</div>
</div>
