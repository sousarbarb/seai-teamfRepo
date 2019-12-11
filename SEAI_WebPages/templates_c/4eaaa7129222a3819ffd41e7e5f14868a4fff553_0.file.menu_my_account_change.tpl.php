<?php
/* Smarty version 3.1.33, created on 2019-12-11 01:18:51
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_account\menu_my_account_change.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df035eba4ed57_41979682',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4eaaa7129222a3819ffd41e7e5f14868a4fff553' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_account\\menu_my_account_change.tpl',
      1 => 1576023530,
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
function content_5df035eba4ed57_41979682 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  <?php if ((isset($_smarty_tpl->tpl_vars['error_messages']->value))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['error_messages']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php }?>
  <div class="myacc">
  <form method="post" action="../actions/my_account_confirm.php">
    <div class="text-white">
      <label class="myaccountlabel">Name</label>
      <input type="text" name="name" class="lead" placeholder="Enter a name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['name'];
} else { ?>My name<?php }?>">
      <br>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['email'];
} else { ?>user_email@emailprovider.com<?php }?>">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="number" class="lead" placeholder="Enter your phone number"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['number'];
} else { ?>+123453674980<?php }?>">
      <br>
      <br>
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">Entity Name</label>
      <input type="text" name="entity_name" class="lead" placeholder="Enter the entity name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_name'];
} else { ?>Entity that I represent<?php }?>">
      <br>
      <label class="myaccountlabel">Address</label>
      <input type="text" name="entity_address" class="lead" placeholder="Enter the entity address"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_address'];
} else { ?>Entity address<?php }?>">
      <br>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="entity_email" class="lead" placeholder="Enter the entity e-mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_email'];
} else { ?>entity_email@emailprovider.com<?php }?>">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="entity_number" class="lead" placeholder="Enter the entity phone number"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_number'];
} else { ?>+425745359078<?php }?>">
      <br>
      <br>
      <?php }?>

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/index.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
