{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  {if $type=="provider"}
    <h2 class="display-4 text-white">{$acc_info_see.entity_name} (@{$acc_info_see.username})</h2>
    <p class="lead text-white mb-0">Service Provider information</p>
  {elseif $type=="client"}
    <h2 class="display-4 text-white">{$acc_info_see.client_name} (@{$acc_info_see.username})</h2>
    <p class="lead text-white mb-0">Service Client Account Information</p>
  {elseif $type=="admin"}
    <h2 class="display-4 text-white">@{$acc_info_see.username}</h2>
    <p class="lead text-white mb-0">Administrator Account Information</p>
  {/if}
  <div class="separator"></div>
  {if (isset($success_messages))}
    {foreach $success_messages as $success}
      <div class="msg_success">{$success} <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
    {/foreach}
  {/if}
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error">{$error} <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a></div>
    {/foreach}
  {/if}
    <div class="text-white">
      {if $type=="provider"}
      <label class="myaccountlabel">Entity Name</label> <label class="lead">{$acc_info_see.entity_name}</label>
      <br>
      <label class="myaccountlabel">Entity Address</label> <label class="lead">{$acc_info_see.entity_address}</label>
      <br>
      <label class="myaccountlabel">Entity E-mail</label> <label class="lead">{$acc_info_see.entity_email}</label>
      <br>
      <label class="myaccountlabel">Entity Phone Number</label> <label class="lead">{$acc_info_see.entity_phonenumber}</label>
      <br>
      <br>
      {/if}
      {if $type=="client"}
      <label class="myaccountlabel">Name</label> <label class="lead">{$acc_info_see.client_name}</label>
      <br>
      {elseif $type=="provider"}
      <label class="myaccountlabel">Official Representative</label> <label class="lead">{$acc_info_see.repres_name}</label>
      <br>
      {/if}
      {if $type=="client"}
      <label class="myaccountlabel">Address</label> <label class="lead">{$acc_info_see.client_address}</label>
      <br>
      <label class="myaccountlabel">E-mail</label> <label class="lead">{$acc_info_see.client_email}</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">{$acc_info_see.client_phonenumber}</label>
      <br>
      {/if}
      {if $type=="provider"}
      <label class="myaccountlabel">E-mail</label> <label class="lead">{$acc_info_see.repres_email}</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">{$acc_info_see.repres_phonenumber}</label>
      <br>
      {elseif $type=="admin"}
      <label class="myaccountlabel">E-mail</label> <label class="lead">{$acc_info_see.admin_email}</label>
      <br>
      {/if}
      <br>
      <br>

      <a href="{$PREVIOUSPAGE}" class="button4 submitAsBtn" style="text-decoration:none;color:white"> Back </a>

    </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}