{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Requests History</h2>
	<div class="separator"></div>
    <br>
    <table class='table_req' id="t_new">
    <tr>
    <th>Request ID</th><th>Client</th><th>Mission ID</th><th>Start Time</th><th>Finished Time</th><th>Mission PDF</th><th>Data Download</th><th>Price</th>
    </tr>


{foreach $requests_new as $request_n}
        <tr>
		{if $request_n.starting_time and $request_n.finished_time}
        <td style="background-color: green;">
		{else}
		<td style="background-color: red;">
		{/if}
		<form id="{$request_n.request_id}" method="post" action="{$BASE_URL}actions/open_req_pag.php">
                  <input type="hidden" name="request_id" value="{$request_n.request_id}">
				  <a href="#" onclick="document.getElementById('{$request_n.request_id}').submit()" style="color:white;">{$request_n.request_id}</a>
        </form>
		</td>
		<td>
		<form id="{$request_n.request_id}_{$request_n.client_username}_seePersonnalPage_NewData" method="post" action="{$BASE_URL}pages/user_page.php">
        <input type="hidden" name="userinfo_username" value="{$request_n.client_username}">
        <a href="#" onclick="document.getElementById('{$request_n.request_id}_{$request_n.client_username}_seePersonnalPage_NewData').submit()" style="color:white;">{$request_n.client_name}</a>
        </form>
	    </td>
		<td>{$request_n.mission_id}</td>
		<td>{$request_n.starting_time}</td>
		<td>{$request_n.finished_time}</td>
		<td>{if $request_n['mission_path']}<a href="{$BASE_URL}{$request_n['mission_path']}" download class="button">Click Me</a>{else} No file found {/if}</td>
		{if $request_n.starting_time and $request_n.finished_time}
		<td>{if $request_n['data_path']}<a href="{$request_n['data_path']}" target="_blank" class="button">Click Me</a>{else} No file found {/if}</td>
		{else}
		<td>Refused</td>
		{/if}
		<td>{if $request_n['sensor_type'] and $request_n['resolution_value']}{$request_n.mission_price}{else}{$request_n.data_price}{/if}</td>
        </td>
        </tr>
    {/foreach}

    </table>
    <br>

</div>
</div>
{include file='common/footer-short.tpl'}
