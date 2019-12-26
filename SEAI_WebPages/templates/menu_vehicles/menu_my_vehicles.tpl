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
  <h2 class="display-4 text-white">MY VEHICLES</h2>
  <p class="lead text-white mb-0">Infomation about my institution's vehicles</p>
  <div class="separator"></div>
    <div class="grid-vehicles">
      <div class="text-white">
        <table class="vehicles_table">
        {* old test
        <div class="vehicles_row">
          <div class="vehicle">
            <div class="vehicle_frame">
               <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
        *}
        <tr>
          <th>Vehicle Name</th><th>Localization</th><th>Active</th><th>Approved</th><th>Visibility</th><th>Service Provider</th>
        </tr>
        <br>
        {if (empty($search_results))}
        <tr>
          <td colspan="6">There are no vehicles to show</td>
        </tr>
        {/if}
        {foreach $search_results as $result}
        <tr>
          <td>{$result['vehicle_name']}</td>
          <td>{$result['vehicle_localization']}</td>
          {if ($result['vehicle_active'])==TRUE}<td>YES</td>
          {elseif ($result['vehicle_active'])==FALSE}<td>NO</td>
          {/if}
          {if ($result['vehicle_approval'])==TRUE}<td>YES</td>
          {elseif ($result['vehicle_approval'])==FALSE}<td>NO</td>
          {/if}
          {if ($result['vehicle_public'])==TRUE}<td>Public</td>
          {elseif ($result['vehicle_public'])==FALSE}<td>Private</td>
          {/if}
          <td>{$result['provider_entityname']}</td>
        </tr>
        {/foreach}
        </table>
      </div>
      <div class="text-white vehicles_sideText">
        {if ($acc_type=="provider")}
        &nbsp;&nbsp;
        <a href="{$BASE_URL}pages/menu_vehicles_add.php" class="button4 buttonsAcc" style="text-decoration:none;color:white;"> Add Vehicle </a>
        <br><br>
        {/if}
        <label class="vehicle_filtro_lbl">Filter type 1</label><br>
        <form method="get" action="{$BASE_URL}actions/vehicles_filter_entity.php">
          <input type="radio" name="vehicles_filter1" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter1=='all'))}checked="checked"{/if}> All</input><br>
          <input type="radio" name="vehicles_filter1" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter1'))}checked="checked"{/if}> Filter1</input><br>
          <input type="radio" name="vehicles_filter1" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter2'))}checked="checked"{/if}> Filter2</input><br>
          <input type="radio" name="vehicles_filter1" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter3'))}checked="checked"{/if}> Filter3</input><br>
          <input type="radio" name="vehicles_filter1" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter4'))}checked="checked"{/if}> Filter4</input><br>
          <input type="radio" name="vehicles_filter1" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter5'))}checked="checked"{/if}> Filter5</input><br>
        <br>
        <label class="vehicle_filtro_lbl">Filter type 2</label><br>
          <input type="radio" name="vehicles_filter2" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter2=='all'))}checked="checked"{/if}> All</input><br>
          <input type="radio" name="vehicles_filter2" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter1'))}checked="checked"{/if}> Filter1</input><br>
          <input type="radio" name="vehicles_filter2" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter2'))}checked="checked"{/if}> Filter2</input><br>
          <input type="radio" name="vehicles_filter2" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter3'))}checked="checked"{/if}> Filter3</input><br>
          <input type="radio" name="vehicles_filter2" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter4'))}checked="checked"{/if}> Filter4</input><br>
          <input type="radio" name="vehicles_filter2" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter5'))}checked="checked"{/if}> Filter5</input><br>
        <br>
        <label class="vehicle_filtro_lbl">Filter type 3</label><br>
          <input type="radio" name="vehicles_filter3" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter3=='all'))}checked="checked"{/if}> All</input><br>
          <input type="radio" name="vehicles_filter3" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter1'))}checked="checked"{/if}> Filter1</input><br>
          <input type="radio" name="vehicles_filter3" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter2'))}checked="checked"{/if}> Filter2</input><br>
          <input type="radio" name="vehicles_filter3" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter3'))}checked="checked"{/if}> Filter3</input><br>
          <input type="radio" name="vehicles_filter3" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter4'))}checked="checked"{/if}> Filter4</input><br>
          <input type="radio" name="vehicles_filter3" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter5'))}checked="checked"{/if}> Filter5</input><br>
          <input type="submit" name="vehicles_submit" style="display:none" value=""></input>
        </form>
      </div>
    </div>

</div>
{/if}

{include file='../common/footer-short.tpl'}
