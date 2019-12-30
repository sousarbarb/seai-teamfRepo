<?php
/* Smarty version 3.1.33, created on 2019-12-30 13:52:43
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_notifications/menu_notifications.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0a012b7d0329_40667808',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abd895f754b1dd755395be8d4de8d298cd3e8267' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_notifications/menu_notifications.tpl',
      1 => 1577713944,
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
function content_5e0a012b7d0329_40667808 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">NOTIFICATIONS</h2>
  <p class="lead text-white mb-0">Check the latest notifications received</p>
  <div class="separator"></div>

    
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notifications']->value, 'notification');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['notification']->value) {
?>
    <div class="notification_not_read"><?php echo $_smarty_tpl->tpl_vars['notification']->value['notification_info'];?>

      <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/notification_mark_read.php">
        <input type="hidden" name="notification_id" value="<?php echo $_smarty_tpl->tpl_vars['notification']->value['notification_id'];?>
">
        <input type="submit" class="button4 submitAsBtn notification_mark_read" value="Mark as read" style="width:auto;">
      </form>
      <label class="notification_date"><?php echo $_smarty_tpl->tpl_vars['notification']->value['notification_date'];?>
</label>
      <br>
    </div>
  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}