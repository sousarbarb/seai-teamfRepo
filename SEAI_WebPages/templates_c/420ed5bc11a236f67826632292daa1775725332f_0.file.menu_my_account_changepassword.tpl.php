<?php
/* Smarty version 3.1.33, created on 2019-12-25 05:52:31
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_account\menu_my_account_changepassword.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e02eb0fa01832_27712272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '420ed5bc11a236f67826632292daa1775725332f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_account\\menu_my_account_changepassword.tpl',
      1 => 1577249546,
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
function content_5e02eb0fa01832_27712272 (Smarty_Internal_Template $_smarty_tpl) {
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
  <form method="post" action="../actions/my_account_changepassword.php">
    <div class="text-white">
      <label class="myaccountlabel">Username</label> <label class="lead"><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</label>
      <br>
      <label class="myaccountlabel">Old Password</label>
      <input type="password" name="old_password" class="lead"
            placeholder="Enter the old password" value="">
      <br>
      <label class="myaccountlabel">New Password</label>
      <input type="password" name="new_password" class="lead"
            placeholder="Enter the new password" value="">
      <br>
      <label class="myaccountlabel">Confirm New Password</label>
      <input type="password" name="confirm_password" class="lead"
            placeholder="Confirm the new password" value="">
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
