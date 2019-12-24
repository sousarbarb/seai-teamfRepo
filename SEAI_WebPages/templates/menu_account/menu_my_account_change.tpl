{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}
  <div class="myacc">
  <form method="post" action="../actions/my_account_confirm.php">
    <div class="text-white">
      {if $acc_type=="provider"}
      <label class="myaccountlabel">Entity Name</label>
      <input type="text" name="entity_name" class="lead" placeholder="Enter the entity name"
            value="{if isset($form_values)}{$form_values.entity_name}{else}{$acc_info.entity_name}{/if}">
      <br>
      <label class="myaccountlabel">Entity Address</label>
      <input type="text" name="entity_address" class="lead" placeholder="Enter the entity address"
            value="{if isset($form_values)}{$form_values.entity_address}{else}{$acc_info.entity_address}{/if}">
      <br>
      <label class="myaccountlabel">Entity E-mail</label>
      <input type="email" name="entity_email" class="lead" placeholder="Enter the entity e-mail"
            value="{if isset($form_values)}{$form_values.entity_email}{else}{$acc_info.entity_email}{/if}">
      <br>
      <label class="myaccountlabel">Entity Phone Number</label>
      <input type="text" name="entity_number" class="lead" placeholder="Enter the entity phone number"
            value="{if isset($form_values)}{$form_values.entity_number}{else}{$acc_info.entity_phonenumber}{/if}">
      <br>
      <br>
      <input type="hidden" name="logo_path" value="{$acc_info.entity_logo_path}">
      {/if}
      {if $acc_type=="client"}
      <label class="myaccountlabel">Name</label>
      <input type="text" name="name" class="lead" placeholder="Enter a name"
            value="{if isset($form_values)}{$form_values.name}{else}{$acc_info.client_name}{/if}">
      <br>
      {elseif $acc_type=="provider"}
      <label class="myaccountlabel">Official Representative</label>
      <input type="text" name="name" class="lead" placeholder="Enter a name"
            value="{if isset($form_values)}{$form_values.name}{else}{$acc_info.repres_name}{/if}">
      <br>
      {/if}
      {if $acc_type=="client"}
      <label class="myaccountlabel">Address</label>
      <input type="text" name="address" class="lead" placeholder="Enter an address"
            value="{if isset($form_values)}{$form_values.address}{else}{$acc_info.client_address}{/if}">
      <br>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="{if isset($form_values)}{$form_values.email}{else}{$acc_info.client_email}{/if}">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="number" class="lead" placeholder="Enter your phone number"
            value="{if isset($form_values)}{$form_values.number}{else}{$acc_info.client_phonenumber}{/if}">
      <br>
      {elseif $acc_type=="provider"}
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="{if isset($form_values)}{$form_values.email}{else}{$acc_info.repres_email}{/if}">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="number" class="lead" placeholder="Enter your phone number"
            value="{if isset($form_values)}{$form_values.number}{else}{$acc_info.repres_phonenumber}{/if}">
      <br>
      {elseif $acc_type=="admin"}
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="{if isset($form_values)}{$form_values.email}{else}{$acc_info.admin_email}{/if}">
      <br>
      {/if}
      <br>
      <label class="myaccountlabel">Username</label> <label class="lead">{$login}</label>
      <br>
      <br>

      <input type="hidden" name="username" value="{$login}">

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="{$BASE_URL}pages/index.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
