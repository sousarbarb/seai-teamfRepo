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
      <label class="myaccountlabel">Entity Name</label> <label class="lead">Entity that I represent</label>
      <br>
      <label class="myaccountlabel">Entity Address</label> <label class="lead">Entity address</label>
      <br>
      <label class="myaccountlabel">Entity E-mail</label> <label class="lead">entity_email@emailprovider.com</label>
      <br>
      <label class="myaccountlabel">Entity Phone Number</label> <label class="lead">+425745359078</label>
      <br>
      <br>
      {/if}
      {if $acc_type=="client" || $acc_type=="admin"}
      <label class="myaccountlabel">Name</label> <label class="lead">My name</label>
      {elseif $acc_type=="provider"}
      <label class="myaccountlabel">Official Representative</label> <label class="lead">My name</label>
      {/if}
      <br>
      {if $acc_type=="client"}
      <label class="myaccountlabel">Address</label> <label class="lead">Address</label>
      <br>
      {/if}
      <label class="myaccountlabel">E-mail</label> <label class="lead">user_email@emailprovider.com</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">+123453674980</label>
      <br>
      <br>

      <form action="{$BASE_URL}pages/menu_my_account_change.php">
          <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Change User Info" />
      </form>

    </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
