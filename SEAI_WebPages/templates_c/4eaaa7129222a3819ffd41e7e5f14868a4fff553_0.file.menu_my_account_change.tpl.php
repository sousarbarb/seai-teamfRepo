<?php
/* Smarty version 3.1.33, created on 2019-12-07 03:35:56
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_account\menu_my_account_change.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5deb100c01b6b7_28232106',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4eaaa7129222a3819ffd41e7e5f14868a4fff553' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_account\\menu_my_account_change.tpl',
      1 => 1575686145,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/navbar_logged_in.tpl' => 1,
    'file:../common/logout.tpl' => 1,
    'file:../common/footer-short.tpl' => 1,
  ),
),false)) {
function content_5deb100c01b6b7_28232106 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
      
      <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Confirm Changes" />

    </div>
  </form>
  </div>
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
