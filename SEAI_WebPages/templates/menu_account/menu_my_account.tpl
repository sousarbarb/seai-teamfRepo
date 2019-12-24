{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  {if (isset($success_messages))}
    {foreach $success_messages as $success}
      <div class="msg_success">{$success} <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
    {/foreach}
  {/if}
    <div class="text-white">
      {if $acc_type=="provider"}
      <label class="myaccountlabel">Entity Name</label> <label class="lead">{$acc_info.entity_name}</label>
      <br>
      <label class="myaccountlabel">Entity Address</label> <label class="lead">{$acc_info.entity_address}</label>
      <br>
      <label class="myaccountlabel">Entity E-mail</label> <label class="lead">{$acc_info.entity_email}</label>
      <br>
      <label class="myaccountlabel">Entity Phone Number</label> <label class="lead">{$acc_info.entity_phonenumber}</label>
      <br>
      <br>
      {/if}
      {if $acc_type=="client"}
      <label class="myaccountlabel">Name</label> <label class="lead">{$acc_info.client_name}</label>
      <br>
      {elseif $acc_type=="provider"}
      <label class="myaccountlabel">Official Representative</label> <label class="lead">{$acc_info.repres_name}</label>
      <br>
      {/if}
      {if $acc_type=="client"}
      <label class="myaccountlabel">Address</label> <label class="lead">{$acc_info.client_address}</label>
      <br>
      <label class="myaccountlabel">E-mail</label> <label class="lead">{$acc_info.client_email}</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">{$acc_info.client_phonenumber}</label>
      <br>
      {/if}
      {if $acc_type=="provider"}
      <label class="myaccountlabel">E-mail</label> <label class="lead">{$acc_info.repres_email}</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">{$acc_info.repres_phonenumber}</label>
      <br>
      {elseif $acc_type=="admin"}
      <label class="myaccountlabel">E-mail</label> <label class="lead">{$acc_info.admin_email}</label>
      <br>
      {/if}
      <br>
      <label class="myaccountlabel">Username</label> <label class="lead">{$login}</label>
      <br>
      <br>

      <form action="{$BASE_URL}pages/menu_my_account_change.php">
          <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Change User Info" />
          <a href="{$BASE_URL}pages/menu_my_account_changepassword.php" class="button4 submitAsBtn" style="text-decoration:none;color:white"> Change Password </a>
      </form>

    </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
