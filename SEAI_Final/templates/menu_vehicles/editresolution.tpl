{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">EDIT RESOLUTION</h2>
  <p class="lead text-white mb-0">Manage resolution information</p>
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
  <div class="myacc"><!--
  <form method="post" action="../actions/editresolution.php">
    <div class="text-white">
      <label class="myaccountlabel">Vel sampling:</label>
      <input type="text" name="vel_sampling" class="lead" placeholder="Enter a velocity"
            value="{if isset($form_values)}{$form_values.vel_sampling}{else}{$vel_sampling}{/if}">
      <br>
      <label class="myaccountlabel">Consumption:</label>
      <input type="text" name="consumption" class="lead" placeholder="Enter the consumption"
            value="{if isset($form_values)}{$form_values.consumption}{else}{$consumption}{/if}">
      <br>
      <label class="myaccountlabel">Swath:</label>
      <input type="text" name="swath" class="lead" placeholder="Enter swath value"
            value="{if isset($form_values)}{$form_values.swath}{else}{$swath}{/if}">
      <br>
      <label class="myaccountlabel">Cost:</label>
      <input type="text" name="cost" class="lead" placeholder="Enter the cost"
            value="{if isset($form_values)}{$form_values.cost}{else}{$cost}{/if}">
      <br>
      <label class="myaccountlabel">Comments</label>
      <input type="text" name="comments" class="lead" placeholder="Comments (optional)"
            value="{if isset($form_values)}{$form_values.comments}{else}{$comments}{/if}">
      <br><br>

      <input type="hidden" name="resolution_id"
          value="{if isset($form_values)}{$form_values.comments}{else}{$resolution_id}{/if}">
      <input type="hidden" name="vehicle_name"
          value="{if isset($form_values)}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="javascript:void(0)" class="button4 buttonsAcc button_form_cancel" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form> -->

  <form method="post" action="../actions/editresolution.php">
    <table class="text-white">
        <tr><td class="gg">
        Vel sampling: </td><td class="register"><input type="text" name="vel_sampling"
                  value="{if isset($form_values)}{$form_values.vel_sampling}{else}{$vel_sampling}{/if}">
        </tr>
        <tr><td class="gg">
        Consumption: </td><td class="register"><input type="text" name="consumption"
                  value="{if isset($form_values)}{$form_values.consumption}{else}{$consumption}{/if}">
        </tr>
        <tr><td class="gg">
        Swath: </td><td class="register"><input type="text" name="swath"
                  value="{if isset($form_values)}{$form_values.swath}{else}{$swath}{/if}">
        </tr>
        <tr><td class="gg">
        Cost: </td><td class="register"><input type="text" name="cost"
                  value="{if isset($form_values)}{$form_values.cost}{else}{$cost}{/if}">
        </tr>
        <tr><td>
        Comments: </td><td class="register"><input type="text" name="comments"
                  value="{if isset($form_values)}{$form_values.comments}{else}{$comments}{/if}">
        </tr>

        <input type="hidden" name="resolution_id"
            value="{if isset($form_values)}{$form_values.resolution_id}{else}{$resolution_id}{/if}">
        <input type="hidden" name="vehicle_name"
            value="{if isset($form_values)}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">

        <tr><td>
        {if empty($success_messages)}
          <input class="btn btn-info" type="submit" name="submit" value="Confirm">
          <a href="javascript:void(0)" class="btn btn-info button_form_cancel" style="text-decoration:none;color:white;margin-left:32em;"> Cancel </a>
        {else}
          <a href="javascript:void(0)" class="btn btn-info button_form_cancel" style="text-decoration:none;color:white;margin-left:30em;"> Back </a>
        {/if}
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
