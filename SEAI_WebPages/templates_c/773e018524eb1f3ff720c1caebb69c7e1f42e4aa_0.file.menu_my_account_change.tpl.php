<?php
/* Smarty version 3.1.33, created on 2019-12-03 18:22:45
  from '/usr/users2/2015/up201503070/public_html/SEAI_WebPages/templates/menu_my_account_change.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5de6a7f5e35fc2_62620861',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '773e018524eb1f3ff720c1caebb69c7e1f42e4aa' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_WebPages/templates/menu_my_account_change.tpl',
      1 => 1575397352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5de6a7f5e35fc2_62620861 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  <div class="myacc">
  <form action="../actions/menu_my_account_confirmar.php">
    <div class="text-white">
      <label class="myaccountlabel">Name</label>
      <input type="text" class="lead" placeholder="Enter a name" value="My name">
      <br>
      <label class="myaccountlabel">E-mail</label> <input type="email" class="lead" placeholder="Enter an e-mail" value="user_email@emailprovider.com">
      <br>
      <label class="myaccountlabel">Phone Number</label> <input type="text" class="lead" placeholder="Enter your phone number" value="+123453674980">
      <br>
      <br>
            <label class="myaccountlabel">Entity Name</label> <input type="text" class="lead" placeholder="Enter the entity name" value="Entity that I represent">
      <br>
      <label class="myaccountlabel">Address</label> <input type="text" class="lead" placeholder="Enter the entity address" value="Entity address">
      <br>
      <label class="myaccountlabel">E-mail</label> <input type="email" class="lead" placeholder="Enter the entity e-mail" value="entity_email@emailprovider.com">
      <br>
      <label class="myaccountlabel">Phone Number</label> <input type="text" class="lead" placeholder="Enter the entity phone number" value="+425745359078">
      <br>
      <br>
      
      <form action="#">
          <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Confirm Changes" />
      </form>

    </div>
  </form>
  </div>
  </div>

</div>
<?php }
}
