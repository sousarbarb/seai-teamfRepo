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
          {if ($result['vehicle_active'])==TRUE}<td>Yes</td>
          {elseif ($result['vehicle_active'])==FALSE}<td>No</td>
          {/if}
          {if ($result['vehicle_approval'])==TRUE}<td>Yes</td>
          {elseif ($result['vehicle_approval'])==FALSE}<td>No</td>
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

        <form method="post" action="{$BASE_URL}pages/menu_my_vehicles.php">

        <label class="vehicle_filtro_lbl">Approval Status</label><br>
          {foreach $approvals as $approval_status}
            <input type="checkbox"
                    name="approvals_array[]"
                    id="approvals_filter"
                    value="{$approval_status}"
                    {if !empty($approvals_selected)}
                      {foreach $approvals_selected as $selected}
                        {if $approval_status == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$approval_status}<br>
          {/foreach}
        <br>

        <label class="vehicle_filtro_lbl">Specifications</label><br>
          {foreach $specifications as $specification_type}
            <input  type="checkbox"
                    name="specifications_array[]"
                    id="specifications_filter"
                    value="{$specifications_type['specifications_type']}"
                    {if !empty($specifications_selected)}
                      {foreach $specifications_selected as $selected}
                        {if $specification_type['specification_type'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$specification_type['specification_type']}<br>
          {/foreach}
        <br>

        <label class="vehicle_filtro_lbl">Communications</label><br>
          {foreach $communications as $communication_type}
            <input  type="checkbox"
                    name="communications_array[]"
                    id="communications_filter"
                    value="{$communication_type['communication_type']}"
                    {if !empty($communications_selected)}
                      {foreach $communications_selected as $selected}
                        {if $communication_type['communication_type'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$communication_type['communication_type']}<br>
          {/foreach}
        <br>

        <label class="vehicle_filtro_lbl">Sensors</label><br>
          {foreach $sensors as $sensor_type}
            <input  type="checkbox"
                    name="sensors_array[]"
                    id="sensors_filter"
                    value="{$sensor_type['sensor_type']}"
                    {if !empty($sensors_selected)}
                      {foreach $sensors_selected as $selected}
                        {if $sensor_type['sensor_type'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$sensor_type['sensor_type']}<br>
          {/foreach}
        <br>

        <label class="vehicle_filtro_lbl">Resolutions</label><br>
          {foreach $resolutions as $res_value}
            <input  type="checkbox"
                    name="resolutions_array[]"
                    id="resolutions_filter"
                    value="{$res_value['value']}"
                    {if !empty($resolutions_selected)}
                      {foreach $resolutions_selected as $selected}
                        {if $res_value['value'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$res_value['value']}<br>
          {/foreach}
        <br>

        {* old code
        <br>
        <label class="vehicle_filtro_lbl">Filter type 3</label><br>
          <input type="radio" name="vehicles_filter3" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter3=='all'))}checked="checked"{/if}> All</input><br>
          <input type="radio" name="vehicles_filter3" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter1'))}checked="checked"{/if}> Filter1</input><br>
          <input type="radio" name="vehicles_filter3" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter2'))}checked="checked"{/if}> Filter2</input><br>
          <input type="radio" name="vehicles_filter3" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter3'))}checked="checked"{/if}> Filter3</input><br>
          <input type="radio" name="vehicles_filter3" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter4'))}checked="checked"{/if}> Filter4</input><br>
          <input type="radio" name="vehicles_filter3" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter5'))}checked="checked"{/if}> Filter5</input><br>
        *}

          <input type="submit" name="vehicles_submit" style="display:none" value=""></input>
        </form>
      </div>
    </div>

</div>
{/if}

{include file='../common/footer-short.tpl'}
