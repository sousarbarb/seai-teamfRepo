{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">EDIT SPECIFICATION</h2>
  <p class="lead text-white mb-0">Manage specification information</p>
  <div class="separator"></div>
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}
  <div class="myacc">
  <form method="post" action="../actions/editspecification.php">
    <div class="text-white">
      <label class="myaccountlabel">Value min</label>
      <input type="text" name="valuemin" class="lead" placeholder="Enter the minimum value"
            value="{if isset($form_values)}{$form_values.valuemin}{else}{$valuemin}{/if}">
      <br>
      <label class="myaccountlabel">Value max</label>
      <input type="text" name="valuemax" class="lead" placeholder="Enter the maximum value"
            value="{if isset($form_values)}{$form_values.valuemax}{else}{$valuemax}{/if}">
      <br>
      <label class="myaccountlabel">Comments</label>
      <input type="text" name="comments" class="lead" placeholder="Comments (optional)"
            value="{if isset($form_values)}{$form_values.comments}{else}{$comments}{/if}">
      <br><br>

      <input type="hidden" name="specification_id"
            value="{if isset($form_values)}{$form_values.specification_id}{else}{$specification_id}{/if}">
      <input type="hidden" name="vehicle_name"
            value="{if isset($form_values)}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="javascript:void(0)" class="button4 buttonsAcc button_form_cancel" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  <form method="post" action="{$BASE_URL}pages/vehicle_pag.php" name="form_cancel" class="form_cancel">
  <input type="hidden" class="form_post" name="vehicle_name" value="{if isset($form_values)}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">
  <input type="submit" style="display: none;">
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
