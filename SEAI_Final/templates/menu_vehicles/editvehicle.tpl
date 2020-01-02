{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">EDIT VEHICLE</h2>
  <p class="lead text-white mb-0">Manage vehicle information</p>
  <div class="separator"></div>
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}
  <div class="text-white">
  <div class="myacc">
  <form method="post" action="../actions/editvehicle.php">
      <label class="myaccountlabel">Vehicle name</label>
      <input type="text" name="vehicle_name" class="lead" placeholder="{$vehicle_name}"
            value="{if isset($form_values)}{$form_values.vehicle_name}{else}{$vehicle_name}{/if}">
      <br>
      <label class="myaccountlabel">Localization</label>
      <input type="text" name="localization" class="lead" placeholder="{$localization}"
            value="{if isset($form_values)}{$form_values.localization}{else}{$localization}{/if}">
      <br>
      <label class="myaccountlabel">Comments</label>
      <input type="text" name="comments" class="lead" placeholder="{$comments}"
            value="{if isset($form_values)}{$form_values.comments}{else}{$comments}{/if}">
      <br>
      </div>
      <label class="myaccountlabel">Public:</label>
      <input type="radio" name="vehicle_public" value="y"> Yes&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="vehicle_public" value="n"> No 
      <br>
      <br>
      <br>

      <input type="hidden" name="vehicle_id" value="{$vehicle_id}">
      <input type="hidden" name="public" value="{$public}">

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="{$BASE_URL}pages/vehicle_pag.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    
  </form>
  </div>

</div>

{include file='../common/footer-short.tpl'}
