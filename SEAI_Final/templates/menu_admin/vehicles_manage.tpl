{include file='common/header.tpl'}
{include file='common/navbar_logged_in.tpl'}
{include file='common/logout.tpl'}

{if ($acc_type!="admin")}
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Error</h2>
  <p class="lead text-white mb-0">You don't have permission to see this page</p>
  <br><br><br><br><br><br><br><br><br><br><br><br>
</div>
{else}
<div class ="menusLogin p-5">
  <h2 class="display-4 text-white">VEHICLES</h2>
  <p class="lead text-white mb-0">Select the vehicles you want to validate or remove</p>
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
  <div class="grid-vehicles">
  <div class="vehicles_table">
    <table width=600 border=1 id='tabela'>
      <tr>
        <th>Name</th>
        <th>Institution</th>
        <th>Active</th>
        <th>Approved</th>
      </tr>

      {foreach $search_results_unapproved as $result}
        <tr>
          <td>
            <form id="{$result['vehicle_name']}_seePage" method="post" action="{$BASE_URL}pages/vehicle_pag.php">
              <input type="hidden" name="vehicle_name" value="{$result['vehicle_name']}">
              <a href="#" onclick="document.getElementById('{$result['vehicle_name']}_seePage').submit()" style="color:white;">{$result['vehicle_name']}</a>
            </form>
          </td>
          <td>
            <form id="{$result['provider_username']}_{$result['vehicle_name']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
              <input type="hidden" name="userinfo_username" value="{$result['provider_username']}">
              <a href="#" onclick="document.getElementById('{$result['provider_username']}_{$result['vehicle_name']}_seePersonnalPage').submit()" style="color:white;">{$result['provider_entityname']}</a>
            </form>
          </td>
          {if ($result['vehicle_active'])==TRUE}<td class="manage_green">Yes
          <form action="{$BASE_URL}actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_deactivate" value="{$result['vehicle_id']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Deactivate" />
          </form></td>
          {elseif ($result['vehicle_active'])==FALSE}<td class="manage_red">No
          <form action="{$BASE_URL}actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_activate" value="{$result['vehicle_id']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Activate" />
          </form></td>
          {/if}
          <td class="manage_red">No
          <form action="{$BASE_URL}actions/vehicles_manage_approval_status.php" method="post">
            <input type="hidden" name="vehicle_id_approve" value="{$result['vehicle_id']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Approve" />
          </form></td>
        </tr>
      {/foreach}
      {foreach $search_results_approved as $result}
        <tr>
          <td>
            <form id="{$result['vehicle_name']}_seePage" method="post" action="{$BASE_URL}pages/vehicle_pag.php">
              <input type="hidden" name="vehicle_name" value="{$result['vehicle_name']}">
              <a href="#" onclick="document.getElementById('{$result['vehicle_name']}_seePage').submit()" style="color:white;">{$result['vehicle_name']}</a>
            </form>
          </td>
          <td>{$result['provider_entityname']}</td>
          {if ($result['vehicle_active'])==TRUE}<td class="manage_green">Yes
          <form action="{$BASE_URL}actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_deactivate" value="{$result['vehicle_id']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Deactivate" />
          </form></td>
          {elseif ($result['vehicle_active'])==FALSE}<td class="manage_red">No
          <form action="{$BASE_URL}actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_activate" value="{$result['vehicle_id']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Activate" />
          </form></td>
          {/if}
          <td class="manage_green">Yes
          <form action="{$BASE_URL}actions/vehicles_manage_approval_status.php" method="post">
            <input type="hidden" name="vehicle_id_disapprove" value="{$result['vehicle_id']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Disapprove" />
          </form></td>
        </tr>
      {/foreach}

    </table>



  </div>
  </div>


<br>
<br>

</div>
</div>
{/if}

{include file='common/footer-short.tpl'}
