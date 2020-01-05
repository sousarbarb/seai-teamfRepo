{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Requests in Progress</h2>
	<div class="separator"></div>
    <br>
	<p><label class="vehicle_info_label text-white" style="width:18rem; font-size:25px; text-decoration: underline; font-weight: bold;">New Data Requests</label></p>
    <table class='table_req' id="t_new">
    <tr>
    <th>Request ID</th><th>Sensor Type</th><th>Resolution Type</th><th>Client</th><th>Mission ID</th><th>Mission Status</th><th>Start Time</th><th>Estimated Finished Time</th><th>Mission PDF</th><th>Client Agreement</th><th>Service Provider Agreement</th><th>Finish Request</th>
    </tr>


{foreach $requests_new as $request_n}
        <tr>
        <td>{$request_n.request_id}</td>
        <td>{$request_n.sensor_type}</td>
		<td>{$request_n.resolution_type}</td>
		<td>{$request_n.client_name}</td>
		<td>{$request_n.mission_id}</td>
		<td>{$request_n.mission_status}</td>
		<td>{$request_n.starting_time}</td>
		<td>{$request_n.estimated_finished_time}</td>
		<td>{if $request_n['mission_pdf']}<a href="{$BASE_URL}{$request_n['mission_pdf']}" class="button">Click Me</a>{else} No file found {/if}</td>
        {if $request_n.request_agreement_client==true}
		<td style="background-color: green;">
        Client Agreed
        {else}
		<td style="background-color: red;">
        No Agreement yet
        {/if}
        </td>
		{if $request_n.request_agreement_provider==true}
		<td style="background-color: green;">
        Comfirmed
        {else}
		<td style="background-color: red;">
        <form id="{$request_n.request_id}" method="post" action="{$BASE_URL}actions/request_p_new.php">
		<input type="hidden" name="mid" value="{$request_n.mission_id}">
		<input type="hidden" name="rid" value="{$request_n.request_id}">
		<input type="hidden" name="c_name" value="{$request_n.client_name}">
        <button type="button" class ="clickMe button4 submitAsBtn button_provider_hist" onclick="document.getElementById('{$request_n.request_id}').submit();">Comfirm Agreement</button>
		</form>
        {/if}
        </td>
		{if $request_n.request_agreement_client==true and  $request_n.request_agreement_provider==true }
		<td>
		<button type="button" class ="clickMe button4 submitAsBtn button_provider_hist" onclick="">Finish</button>
        {else}
		<td>
        {/if}
        </td>
        </tr>
    {/foreach}

    </table>
    <br>
	<p><label class="vehicle_info_label text-white"  style="width:18rem; font-size:25px; text-decoration: underline; font-weight: bold;">Old Data Requests</label></p>
    <table class='table_req' id="t_old">
    <tr>
    <th>Request ID</th><th>Sensor Type</th><th>Resolution Type</th><th>Client</th><th>Mission ID</th><th>Mission PDF</th><th>Client Agreement</th><th>Service Provider Agreement</th><th>Finish Request</th>
    </tr>


{foreach $requests_old as $request_o}
        <tr>
        <td>{$request_o.request_id}</td>
        <td>{$request_o.sensor_type}</td>
		<td>{$request_o.resolution_type}</td>
		<td>{$request_o.client_name}</td>
		<td>{$request_o.mission_id}</td>
		<td>{if $request_o['mission_pdf']}<a href="{$BASE_URL}{$request_o['mission_pdf']}" class="button">Click Me</a>{else} No file found {/if}</td>
     {if $request_o.request_agreement_client==true}
		<td style="background-color: green;">
        Client Agreed
        {else}
		<td style="background-color: red;">
        No Agreement yet
        {/if}
        </td>
		{if $request_o.request_agreement_provider==true}
		<td style="background-color: green;">
        Comfirmed
        {else}
		<td style="background-color: red;">
		<form id="{$request_o.request_id}" method="post" action="{$BASE_URL}actions/request_p_old.php">
		<input type="hidden" name="mid" value="{$request_o.mission_id}">
		<input type="hidden" name="rid" value="{$request_o.request_id}">
		<input type="hidden" name="c_name" value="{$request_o.client_name}">
        <button type="button" class ="clickMe button4 submitAsBtn button_provider_hist" onclick="document.getElementById('{$request_o.request_id}').submit();">Comfirm Agreement</button>
		</form>
        {/if}
        </td>
		{if $request_o.request_agreement_client==true and request_agreement_provider==true }
		<td>
		<button type="button" class ="clickMe button4 submitAsBtn button_provider_hist" onclick="">Finish</button>
        {else}
		<td>
        {/if}
        </td>
        </tr>
 {/foreach}
    </table>
    <br>
 
<br>

</div>
</div>
{include file='common/footer-short.tpl'}
