{include file='common/header.tpl'}
{include file='common/navbar_logged_in.tpl'}
{include file='common/logout.tpl'}

<body>
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">ADD RESOLUTION</h2>
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

    <div class="myacc">
    <form method="post" action="../actions/addresolution.php">
    <table class="text-white">
    <tr><td class="gg">
    Value: </td><td class="register"><input type="text" name="value"
              value="{if (isset($form_values))}{$form_values.value}{/if}">
    </tr>
    <tr><td class="gg">
    Vel sampling: </td><td class="register"><input type="text" name="vel_sampling"
              value="{if (isset($form_values))}{$form_values.vel_sampling}{/if}">
    </tr>

    <tr><td class="gg">
    Consumption: </td><td class="register"><input type="text" name="consumption"
              value="{if (isset($form_values))}{$form_values.consumption}{/if}">
    </tr>
    <tr><td class="gg">
    Swath: </td><td class="register"><input type="text" name="swath"
              value="{if (isset($form_values))}{$form_values.swath}{/if}">
    </tr>
    <tr><td class="gg">
    Cost: </td><td class="register"><input type="text" name="cost"
              value="{if (isset($form_values))}{$form_values.cost}{/if}">
    </tr>
    <tr><td>
    Comments: </td><td class="register"><input type="text" name="comments"
              value="{if (isset($form_values))}{$form_values.comments}{/if}">
    </tr>

    <input type="hidden" name="sensor_id"
        value="{if (isset($form_values))}{$form_values.sensor_id}{else}{$sensor_id}{/if}">

    <input type="hidden" name="vehicle_name"
        value="{if (isset($form_values))}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">

    <tr><td>
    <input type="hidden" name="selectform" value="provider">
    <input class="btn btn-info" type="submit" name="submit" value="Add">
    <a href="javascript:void(0)" class="btn btn-info button_form_cancel" style="text-decoration:none;color:white;margin-left:30em;"> Cancel </a>
    </td></tr>
    </table>
    </form>
    <form method="post" action="{$BASE_URL}pages/vehicle_pag.php" name="form_cancel" class="form_cancel">
    <input type="hidden" class="form_post" name="vehicle_name" value="{if isset($form_values)}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">
    <input type="submit" style="display: none;">
    </form>
    </div>
<br><br>

</div>

{include file='../common/footer-short.tpl'}
