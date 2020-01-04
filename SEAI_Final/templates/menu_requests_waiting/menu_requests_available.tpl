{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Available Requests</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Request ID</th><th>User</th><th>Sensor Type</th><th>Resolution</th><th>Comments</th>
    </tr>

    {foreach $requests as $request}
        <tr>
        <td>{$request['request_id']}</td><td>{$request['client_name']}</td><td>{$request['request_sensor_type']}</td><td>{$request['request_res_value']}</td><td>{$request['request_comments']}</td>

        {*<td><a href="???">See Details</a></td>*}

        <form id="{$request['request_id']}" method="post" action="form_proposalnewmission.php">
            <input type="hidden" name="request_id" value="{$request['request_id']}">
            <input type="hidden" name="request_sensor_type" value="{$request['request_sensor_type']}">
            <input type="hidden" name="request_res_value" value="{$request['request_res_value']}">
        </form>
        
        <td><a href="#" onclick="document.getElementById('{$request['request_id']}').submit()" class= "button4 submitAsBtn button_provider_hist" style="color:white;width: auto;">Accept</a></td>

        <td><a href="{$BASE_URL}actions/delete_request.php?id_request=".{$request['request_id']}."">Ignorar</a></td>
        </tr>
        

    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
