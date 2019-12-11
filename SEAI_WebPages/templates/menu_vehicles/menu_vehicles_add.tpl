{include file='../common/header.tpl'}
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
  <div class="text-white">
    <form method="get" action="{$BASE_URL}actions/vehicles_add.php">
      <label class="vehicle_filtro_lbl">Name</label><br>
      <input type="text" name="vehicles_add_name" placeholder="Enter the vehicle name"></input><br><br>
      <label class="vehicle_filtro_lbl">Filter type 1</label><br>
      <input type="radio" name="vehicles_add_spec1" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter1'))}checked="checked"{/if}> Filter1</input><br>
      <input type="radio" name="vehicles_add_spec1" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter2'))}checked="checked"{/if}> Filter2</input><br>
      <input type="radio" name="vehicles_add_spec1" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter3'))}checked="checked"{/if}> Filter3</input><br>
      <input type="radio" name="vehicles_add_spec1" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter4'))}checked="checked"{/if}> Filter4</input><br>
      <input type="radio" name="vehicles_add_spec1" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter5'))}checked="checked"{/if}> Filter5</input><br>
    <br>
    <label class="vehicle_filtro_lbl">Filter type 2</label><br>
      <input type="radio" name="vehicles_add_spec2" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter1'))}checked="checked"{/if}> Filter1</input><br>
      <input type="radio" name="vehicles_add_spec2" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter2'))}checked="checked"{/if}> Filter2</input><br>
      <input type="radio" name="vehicles_add_spec2" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter3'))}checked="checked"{/if}> Filter3</input><br>
      <input type="radio" name="vehicles_add_spec2" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter4'))}checked="checked"{/if}> Filter4</input><br>
      <input type="radio" name="vehicles_add_spec2" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter5'))}checked="checked"{/if}> Filter5</input><br>
    <br>
    <label class="vehicle_filtro_lbl">Filter type 3</label><br>
      <input type="radio" name="vehicles_add_spec3" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter1'))}checked="checked"{/if}> Filter1</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter2'))}checked="checked"{/if}> Filter2</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter3'))}checked="checked"{/if}> Filter3</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter4'))}checked="checked"{/if}> Filter4</input><br>
      <input type="radio" name="vehicles_add_spec3" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter5'))}checked="checked"{/if}> Filter5</input><br>
      <input type="submit" name="vehicles_add_submit" class="button4 submitAsBtn" value="Add Vehicle" style="width:auto;"></input>
    </form>
  </div>

</div>
{/if}

{include file='../common/footer-short.tpl'}
