{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Pending Offers</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Request ID</th><th>User</th><th>Sensor Type</th><th>Resolution</th><th>Area</th><th>Comments</th>
    </tr>

    {$requests = getAllRequests( $id )}



    {foreach $requests as $request}
        <tr>
        <td>{$request['request_id']}</td><td>{$request['client_name']}</td><td>{$request['request_sensor_type']}</td><td>{$request['request_res_value']}</td><td>{$request['polygon']}</td><td>{$request['request._comments']}</td>

        <td><a href="form_proposalnewmission.php">Aceitar</a></td>
        <td><a href="{$BASE_URL}actions/delete_request.php?id_request=".{$request['request_id']}."">Ignorar</a></td>
        </tr>
    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
