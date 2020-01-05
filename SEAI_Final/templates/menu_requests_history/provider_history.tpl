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
        <td>{$request_n.request_id}</td>
		<td>{$request_n.client_name}</td>
		<td>{$request_n.mission_id}</td>
		<td>{$request_n.starting_time}</td>
		<td>{$request_n.finished_time}</td>
		<td>{if $request_n['mission_path']}<a href="{$BASE_URL}{$request_n['mission_path']}" class="button">Click Me</a>{else} No file found {/if}</td>
		<td>{if $request_n['data_path']}<a href="{$request_n['data_path']}" class="button">Click Me</a>{else} No file found {/if}</td>
		<td>{if $request_n['sensor_type'] and $request_n['resolution_value']}{$request_n.mission_price}{else}{$request_n.data_price}{/if}</td>
        </td>
        </tr>
    {/foreach}

    </table>
    <br>

</div>
</div>
{include file='common/footer-short.tpl'}
