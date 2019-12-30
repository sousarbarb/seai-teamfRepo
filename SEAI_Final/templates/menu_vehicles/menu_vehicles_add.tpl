form_values{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

{if ($acc_type!="provider")}
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Error</h2>
  <p class="lead text-white mb-0">You don't have permission to see this page</p>
  <br><br><br><br><br><br><br><br><br><br><br><br>
</div>
{else}
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">ADD VEHICLE</h2>
  <p class="lead text-white mb-0">Add a vehicle from my institution</p>
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
  <div class="text-white">
    <form class="vehicles_add" method="post" action="{$BASE_URL}actions/vehicles_add.php">

      <input  type="hidden"
              name="vehicle_service_username"
              value="{$login}">

      <label class="vehicles_add_lbl">Vehicle Name</label>
      <input  type="text"
              name="vehicle_name"
              placeholder="type here..."
      {if isset($form_values['vehicle_name'])}
              value="{$form_values['vehicle_name']}"
      {/if}
      >
      <br>

      <label class="vehicles_add_lbl">Localization</label>
      <input  type="text"
              name="vehicle_localization"
              placeholder="41.252314 50.102957 (lon. lat.)..."
      {if isset($form_values['vehicle_localization'])}
              value="{$form_values['vehicle_localization']}"
      {/if}
      >
      <br>

      <label class="vehicles_add_lbl" style="vertical-align: top;padding-top:5px;">Comments</label>
      <textarea type="text"
                name="vehicle_comments"
                placeholder="type here...">{if isset($form_values['vehicle_comments'])}{$form_values['vehicle_comments']}{/if}</textarea>
      <br>

      <label class="vehicles_add_lbl">Public</label>
      <input type="radio" name="vehicle_public" value="y"> Yes
      <input type="radio" name="vehicle_public" value="n"> No
      <br>
      <br>
      <input type="submit" name="vehicles_add_submit" class="button4 submitAsBtn" value="Add Vehicle" style="width:auto;"></input>
      <a href="{$BASE_URL}pages/menu_my_vehicles.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> My Vehicles List </a>

    </form>

    {* old
      <label class="vehicles_add_lbl">Name</label><br>
      <input type="text" name="vehicles_add_name" placeholder="Enter the vehicle name"></input><br><br>
    <br>
    <label class="vehicles_add_lbl">Filter type 3</label><br>
      <input type="radio" name="vehicles_add_spec3" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter1'))}checked="checked"{/if}> Filter1</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter2'))}checked="checked"{/if}> Filter2</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter3'))}checked="checked"{/if}> Filter3</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter4'))}checked="checked"{/if}> Filter4</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter5'))}checked="checked"{/if}> Filter5</input><br>
    *}
  </div>

</div>
{/if}

{include file='../common/footer-short.tpl'}
