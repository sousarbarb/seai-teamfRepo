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
  <h2 class="display-4 text-white">USERS</h2>
  <p class="lead text-white mb-0">Select the users you want to validate or remove</p>
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
        <th>Username</th>
        <th>Account Type</th>
        <th>Active</th>
        <th>Approved</th>
      </tr>

      {foreach $not_inactive_users as $result}
        {if isset($result['entity_name'])} {* entity *}
        <tr>
          <td>
            <form id="{$result['user_username']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
              <input type="hidden" name="userinfo_username" value="{$result['user_username']}">
              <a href="#" onclick="document.getElementById('{$result['user_username']}_seePersonnalPage').submit()" style="color:white;">{$result['user_username']}</a>
            </form>
          </td>
          <td>Provider</td>
          <td class="manage_green">Yes
          <form action="{$BASE_URL}actions/users_manage_activation_status.php" method="post">
            <input type="hidden" name="user_username_deactivate" value="{$result['user_username']}">
            <input type="hidden" name="user_type" value="provider">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Deactivate" />
          </form></td>
          {if ($result['admin_approval'])==TRUE}<td class="manage_green">Yes
          <form action="{$BASE_URL}actions/users_manage_approval_status.php" method="post">
            <input type="hidden" name="user_username_disapprove" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Disapprove" />
          </form></td>
          {elseif ($result['admin_approval'])==FALSE}<td class="manage_red">No
          <form action="{$BASE_URL}actions/users_manage_approval_status.php" method="post">
            <input type="hidden" name="user_username_approve" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Approve" />
          </form></td>
          {/if}
        </tr>
        {else} {* client *}
        <tr>
          <td>
            <form id="{$result['user_username']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
              <input type="hidden" name="userinfo_username" value="{$result['user_username']}">
              <a href="#" onclick="document.getElementById('{$result['user_username']}_seePersonnalPage').submit()" style="color:white;">{$result['user_username']}</a>
            </form>
          </td>
          <td>Client</td>
          <td class="manage_green">Yes
          <form action="{$BASE_URL}actions/users_manage_activation_status.php" method="post">
            <input type="hidden" name="user_username_deactivate" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Deactivate" />
          </form></td>
          <td>X</td>
        </tr>
        {/if}
      {/foreach}

      {foreach $inactive_users as $result}
        {if isset($result['entity_name'])} {* entity *}
        <tr>
          <td>
            <form id="{$result['user_username']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
              <input type="hidden" name="userinfo_username" value="{$result['user_username']}">
              <a href="#" onclick="document.getElementById('{$result['user_username']}_seePersonnalPage').submit()" style="color:white;">{$result['user_username']}</a>
            </form>
          </td>
          <td>Provider</td>
          <td class="manage_red">No
          <form action="{$BASE_URL}actions/users_manage_activation_status.php" method="post">
            <input type="hidden" name="user_username_activate" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Activate" />
          </form></td>
          {if ($result['admin_approval'])==TRUE}<td class="manage_green">Yes
          <form action="{$BASE_URL}actions/users_manage_approval_status.php" method="post">
            <input type="hidden" name="user_username_disapprove" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Disapprove" />
          </form></td>
          {elseif ($result['admin_approval'])==FALSE}<td class="manage_red">No
          <form action="{$BASE_URL}actions/users_manage_approval_status.php" method="post">
            <input type="hidden" name="user_username_approve" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Approve" />
          </form></td>
          {/if}
        </tr>
        {else} {* client *}
        <tr>
          <td>
            <form id="{$result['user_username']}_seePersonnalPage" method="post" action="{$BASE_URL}pages/user_page.php">
              <input type="hidden" name="userinfo_username" value="{$result['user_username']}">
              <a href="#" onclick="document.getElementById('{$result['user_username']}_seePersonnalPage').submit()" style="color:white;">{$result['user_username']}</a>
            </form>
          </td>
          <td>Client</td>
          <td class="manage_red">No
          <form action="{$BASE_URL}actions/users_manage_activation_status.php" method="post">
            <input type="hidden" name="user_username_activate" value="{$result['user_username']}">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Activate" />
          </form></td>
          <td>X</td>
        </tr>
        {/if}
      {/foreach}
    </table>

  </div>
  </div>

<br>
<br>

</div>

{/if}
{include file='common/footer-short.tpl'}
