<?php
/* Smarty version 3.1.33, created on 2019-12-30 11:03:40
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_account/menu_my_account_change.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09d98cd521c2_94462931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c9e98346657c90bcbcbecb50626f0b24ae3f0ab' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_account/menu_my_account_change.tpl',
      1 => 1577703819,
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
function content_5e09d98cd521c2_94462931 (Smarty_Internal_Template $_smarty_tpl) {
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
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">Entity Name</label>
      <input type="text" name="entity_name" class="lead" placeholder="Enter the entity name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_name'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_name'];
}?>">
      <br>
      <label class="myaccountlabel">Entity Address</label>
      <input type="text" name="entity_address" class="lead" placeholder="Enter the entity address"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_address'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_address'];
}?>">
      <br>
      <label class="myaccountlabel">Entity E-mail</label>
      <input type="email" name="entity_email" class="lead" placeholder="Enter the entity e-mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_email'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_email'];
}?>">
      <br>
      <label class="myaccountlabel">Entity Phone Number</label>
      <input type="text" name="entity_number" class="lead" placeholder="Enter the entity phone number"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_number'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_phonenumber'];
}?>">
      <br>
      <br>

      <input type="hidden" name="logo_path" value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['logo_path'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_logopath'];
}?>">
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "client") {?>
      <label class="myaccountlabel">Name</label>
      <input type="text" name="name" class="lead" placeholder="Enter a name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['name'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['client_name'];
}?>">
      <br>
      <?php } elseif ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">Official Representative</label>
      <input type="text" name="name" class="lead" placeholder="Enter a name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['name'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['repres_name'];
}?>">
      <br>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "client") {?>
      <label class="myaccountlabel">Address</label>
      <input type="text" name="address" class="lead" placeholder="Enter an address"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['address'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['client_address'];
}?>">
      <br>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['email'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['client_email'];
}?>">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="number" class="lead" placeholder="Enter your phone number"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['number'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['client_phonenumber'];
}?>">
      <br>
      <?php } elseif ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['email'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['repres_email'];
}?>">
      <br>
      <label class="myaccountlabel">Phone Number</label>
      <input type="text" name="number" class="lead" placeholder="Enter your phone number"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['number'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['repres_phonenumber'];
}?>">
      <br>
      <?php } elseif ($_smarty_tpl->tpl_vars['acc_type']->value == "admin") {?>
      <label class="myaccountlabel">E-mail</label>
      <input type="email" name="email" class="lead" placeholder="Enter an e-mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['email'];
} else {
echo $_smarty_tpl->tpl_vars['acc_info']->value['admin_email'];
}?>">
      <br>
      <?php }?>
      <br>
      <label class="myaccountlabel">Username</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</label>
      <br>
      <br>

      <input type="hidden" name="username" value="<?php echo $_smarty_tpl->tpl_vars['login']->value;?>
">

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
