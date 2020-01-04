{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Available Requests</h2>
    <div class="separator"></div>
    {if (isset($success_messages))}
      {foreach $success_messages as $success}
        <div class="msg_success">{$success} <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
      {/foreach}
    {/if}
    {if (isset($error_messages))}
      {foreach $error_messages as $error}
        <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
      {/foreach}
    {/if}
    <table class='table_avail'>
    <tr>
    <th>Request ID</th><th>User</th><th>Sensor Type</th><th>Resolution</th><th>Comments</th>
    </tr>

    {foreach $requests as $request}
        <tr>
        <td>{$request['request_id']}</td><td>{$request['client_name']}</td><td>{$request['request_sensor_type']}</td><td>{$request['request_res_value']}</td><td>{$request['request_comments']}</td>

        {*<td><a href="???">See Details</a></td>*}

        <form id="{$request['request_id']}_accept" method="post" action="form_proposalnewmission.php">
            <input type="hidden" name="request_id" value="{$request['request_id']}">
            <input type="hidden" name="request_sensor_type" value="{$request['request_sensor_type']}">
            <input type="hidden" name="request_res_value" value="{$request['request_res_value']}">
        </form>

        <td><a href="#" onclick="document.getElementById('{$request['request_id']}_accept').submit()" class= "button4 submitAsBtn button_provider_hist" style="color:white;width: auto;">Accept</a></td>

        <form id="{$request['request_id']}_ignore" method="post" action="{$BASE_URL}actions/ignore_availablerequest.php">
            <input type="hidden" name="request_id" value="{$request['request_id']}">
        </form>

        <td><a href="#" onclick="document.getElementById('{$request['request_id']}_ignore').submit()" class= "button4 submitAsBtn button_provider_hist" style="color:white;width: auto;">Ignore</a></td>
        </tr>


    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
