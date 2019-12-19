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
            value="{if isset($form_values)}{$form_values.entity_name}{else}Entity that I represent{/if}">
      <br>
      <label class="myaccountlabel">Entity Address</label>
      <input type="text" name="entity_address" class="lead" placeholder="Enter the entity address"
            value="{if isset($form_values)}{$form_values.entity_address}{else}Entity address{/if}">
      <br>
      <label class="myaccountlabel">Entity E-mail</label>
      <input type="email" name="entity_email" class="lead" placeholder="Enter the entity e-mail"
            value="{if isset($form_values)}{$form_values.entity_email}{else}entity_email@emailprovider.com{/if}">
      <br>
      <label class="myaccountlabel">Entity Phone Number</label>
      <input type="text" name="entity_number" class="lead" placeholder="Enter the entity phone number"
            value="{if isset($form_values)}{$form_values.entity_number}{else}+425745359078{/if}">
      <br>
      <br>
      {/if}
      {if $acc_type=="client" || $acc_type=="admin"}
      <label class="myaccountlabel">Name</label>
      {elseif $acc_type=="provider"}
      <label class="myaccountlabel">Official Representative</label>
      {/if}
      <input type="text" name="name" class="lead" placeholder="Enter a name"
            value="{if isset($form_values)}{$form_values.name}{else}My name{/if}">
      <br>
      {if $acc_type=="client"}
      <label class="myaccountlabel">Address</label>
      <input type="text" name="address" class="lead" placeholder="Enter an address"
            value="{if isset($form_values)}{$form_values.address}{else}Address{/if}">
      <br>
      {/if}
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="{if isset($form_values)}{$form_values.email}{else}user_email@emailprovider.com{/if}">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="number" class="lead" placeholder="Enter your phone number"
            value="{if isset($form_values)}{$form_values.number}{else}+123453674980{/if}">
      <br>
      <br>

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="{$BASE_URL}pages/index.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
