{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  <div class="myacc">
  <form action="../actions/menu_my_account_confirmar.php">
    <div class="text-white">
      <label class="myaccountlabel">Name</label>
      <input type="text" class="lead" placeholder="Enter a name" value="My name">
      <br>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" class="lead" placeholder="Enter an e-mail" value="user_email@emailprovider.com">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" class="lead" placeholder="Enter your phone number" value="+123453674980">
      <br>
      <br>
      {*{if ...type="provider"}*}
      <label class="myaccountlabel">Entity Name</label>
      <input type="text" class="lead" placeholder="Enter the entity name" value="Entity that I represent">
      <br>
      <label class="myaccountlabel">Address</label>
      <input type="text" class="lead" placeholder="Enter the entity address" value="Entity address">
      <br>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" class="lead" placeholder="Enter the entity e-mail" value="entity_email@emailprovider.com">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" class="lead" placeholder="Enter the entity phone number" value="+425745359078">
      <br>
      <br>
      {*{/if}*}

      <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Confirm Changes" />

    </div>
  </form>
  </div>
  </div>

</div>
