<?php
/* Smarty version 3.1.33, created on 2019-12-30 10:41:13
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_account/menu_my_account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09d44962adc3_20281603',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ded11289f3bd0ec5345781960c2d4388cb9cf5d' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_account/menu_my_account.tpl',
      1 => 1577119072,
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
function content_5e09d44962adc3_20281603 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  <?php if ((isset($_smarty_tpl->tpl_vars['success_messages']->value))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['success_messages']->value, 'success');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['success']->value) {
?>
      <div class="msg_success"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
 <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php }?>
    <div class="text-white">
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">Entity Name</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_name'];?>
</label>
      <br>
      <label class="myaccountlabel">Entity Address</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_address'];?>
</label>
      <br>
      <label class="myaccountlabel">Entity E-mail</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_email'];?>
</label>
      <br>
      <label class="myaccountlabel">Entity Phone Number</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['entity_phonenumber'];?>
</label>
      <br>
      <br>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "client") {?>
      <label class="myaccountlabel">Name</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['client_name'];?>
</label>
      <br>
      <?php } elseif ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">Official Representative</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['repres_name'];?>
</label>
      <br>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "client") {?>
      <label class="myaccountlabel">Address</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['client_address'];?>
</label>
      <br>
      <label class="myaccountlabel">E-mail</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['client_email'];?>
</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['client_phonenumber'];?>
</label>
      <br>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "provider") {?>
      <label class="myaccountlabel">E-mail</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['repres_email'];?>
</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['repres_phonenumber'];?>
</label>
      <br>
      <?php } elseif ($_smarty_tpl->tpl_vars['acc_type']->value == "admin") {?>
      <label class="myaccountlabel">E-mail</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['acc_info']->value['admin_email'];?>
</label>
      <br>
      <?php }?>
      <br>
      <label class="myaccountlabel">Username</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</label>
      <br>
      <br>

      <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_account_change.php">
          <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Change User Info" />
          <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_account_changepassword.php" class="button4 submitAsBtn" style="text-decoration:none;color:white"> Change Password </a>
      </form>

    </div>
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
