<?php
/* Smarty version 3.1.33, created on 2019-12-18 13:45:42
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_notifications\menu_notifications.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dfa1f76a74907_08701524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79f487c5f43525297cf0fc1de72752615bd03e75' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_notifications\\menu_notifications.tpl',
      1 => 1576673141,
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
function content_5dfa1f76a74907_08701524 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">NOTIFICATIONS</h2>
  <p class="lead text-white mb-0">Check the latest notifications received</p>
  <div class="separator"></div>

    <?php $_smarty_tpl->_assignInScope('notifications', array(array("not_read","notificação 1 aaaaaaaaaaaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa asaksln adoakldnao dkl adoakd alkd "),array("not_read","apodamdkapdmada"),array("read","notificação 2"),array("read","notificação 3")));?>

  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notifications']->value, 'notification', false, 'n');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['n']->value => $_smarty_tpl->tpl_vars['notification']->value) {
?>
    <?php if ($_smarty_tpl->tpl_vars['notification']->value[0] == 'not_read') {?>
      <div class="notification_not_read"><?php echo $_smarty_tpl->tpl_vars['notification']->value[1];?>
 <a class="notification_mark_read" href="#"  style="text-decoration:none;">Mark as read</a></div>
    <?php } else { ?>
      <div class="notification_read"><?php echo $_smarty_tpl->tpl_vars['notification']->value[1];?>
 </div>
    <?php }?>
  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
