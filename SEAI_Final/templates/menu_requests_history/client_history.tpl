{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Requests History</h2>
	<div class="separator"></div>
    <br>
	<p><label class="vehicle_info_label text-white" style="width:18rem; font-size:25px; text-decoration: underline; font-weight: bold;">New Data Requests</label></p>
    <table class='table_req'>
    <tr>
    <th>Request ID</th><th>Sensor Type</th><th>Resolution Type</th><th>Service Provider</th><th>Mission ID</th><th>Mission Price</th><th>Mission PDF</th><th>Data Filetype</th><th>Download Data</th>
    </tr>


    {foreach $requests_new as $request_n}
        <tr>
        <td>
		<form id="{$request_n.request_id}" method="post" action="{$BASE_URL}actions/open_req_pag.php">
                  <input type="hidden" name="request_id" value="{$request_n.request_id}">
				  <a href="#" onclick="document.getElementById('{$request_n.request_id}').submit()" style="color:white;">{$request_n.request_id}</a>
        </form>
		</td>
        <td>{$request_n.sensor_type}</td>
		<td>{$request_n.resolution_type}</td>
		<td>
		<form id="{$request_n.request_id}_{$request_n.provider_username}_seePersonnalPage_NewData" method="post" action="{$BASE_URL}pages/user_page.php">
        <input type="hidden" name="userinfo_username" value="{$request_n.provider_username}">
        <a href="#" onclick="document.getElementById('{$request_n.request_id}_{$request_n.provider_username}_seePersonnalPage_NewData').submit()" style="color:white;">{$request_n.provider_name}</a>
        </form>
	    </td>
		<td>{$request_n.mission_id}</td>
		<td>{$request_n.price}</td>
		<td>{if $request_n['mission_path']}<a href="{$BASE_URL}{$request_n['mission_path']}" class="button" download>Click Me</a>{else} No file found {/if}</td>
		<td>{$request_n.data_filetype}</td>
        <td>{if $request_n['data_path']}<a href="{$request_n['data_path']}" class="button" target="_blank">Click Me</a>{else} No file found {/if}</td>
        </tr>
    {/foreach}
    </table>
    <br>
	<p><label class="vehicle_info_label text-white"  style="width:18rem; font-size:25px; text-decoration: underline; font-weight: bold;">Old Data Requests</label></p>
    <table class='table_req'>
    <tr>
    <th>Request ID</th><th>Sensor Type</th><th>Resolution Type</th><th>Service Provider</th><th>Mission ID</th><th>Mission Price</th><th>Mission PDF</th><th>Data Filetype</th><th>Download Data</th>
    </tr>


    {foreach $requests_old as $request_o}
	{$result=getSensorTypesResolutionValues($request_o.mission_id)}
        <tr>
        <td>
		<form id="{$request_o.request_id}" method="post" action="{$BASE_URL}actions/open_req_pag.php">
                  <input type="hidden" name="request_id" value="{$request_o.request_id}">
				  <a href="#" onclick="document.getElementById('{$request_o.request_id}').submit()" style="color:white;">{$request_o.request_id}</a>
        </form>
		</td>
		<td>{$result.sensor_type}</td>
		<td>{$result.resolution_type}</td>
		<td>
		<form id="{$request_o.request_id}_{$request_o.provider_username}_seePersonnalPage_NewData" method="post" action="{$BASE_URL}pages/user_page.php">
        <input type="hidden" name="userinfo_username" value="{$request_o.provider_username}">
        <a href="#" onclick="document.getElementById('{$request_o.request_id}_{$request_o.provider_username}_seePersonnalPage_NewData').submit()" style="color:white;">{$request_o.provider_name}</a>
        </form>
		</td>
		<td>{$request_o.mission_id}</td>
		<td>{$request_o.data_price}</td>
		<td>{if $request_o['mission_path']}<a href="{$BASE_URL}{$request_o['mission_path']}" class="button" download>Click Me</a>{else} No file found {/if}</td>
		<td>{$request_o.mission_id}</td>
		<td>{if $request_o['data_path']}<a href="{$request_o['data_path']}" class="button" target="_blank">Click Me</a>{else} No file found {/if}</td>
        </td>
        </tr>
    {/foreach}

    </table>
    <br>
<br>

</div>
</div>
{include file='common/footer-short.tpl'}

