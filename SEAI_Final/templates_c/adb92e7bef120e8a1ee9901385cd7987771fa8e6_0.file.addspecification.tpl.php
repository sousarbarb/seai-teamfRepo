<?php
/* Smarty version 3.1.33, created on 2020-01-02 02:32:59
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\menu_vehicles\addspecification.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0d484bdb7b09_86916633',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'adb92e7bef120e8a1ee9901385cd7987771fa8e6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\menu_vehicles\\addspecification.tpl',
      1 => 1577928778,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/header.tpl' => 1,
    'file:common/navbar_logged_in.tpl' => 1,
    'file:common/logout.tpl' => 1,
    'file:../common/footer-short.tpl' => 1,
  ),
),false)) {
function content_5e0d484bdb7b09_86916633 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">ADD SPECIFICATION</h2>
  <div class="separator"></div>

  <?php if ((isset($_smarty_tpl->tpl_vars['success_messages']->value))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['success_messages']->value, 'success');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['success']->value) {
?>
      <div class="msg_success"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <?php }?>
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
    <form method="post" action="../actions/addspecification.php">
    <table class="text-white">
    <tr><td class="gg">
    Type: </td><td class="register"><input type="text" name="type"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['type'];
}?>">
    </tr>
    <tr><td>
    Value min: </td><td class="register"><input type="text" name="valuemin"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['valuemin'];
}?>">
    </tr>
    <tr><td>
    Value max: </td><td class="register"><input type="text" name="valuemax"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['valuemax'];
}?>">
    </tr>
    <tr><td>
    Comments: </td><td class="register"><textarea type="text" name="comments" style="width: 480px;"
              ><?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['comments'];
}?></textarea>
    </tr>

    <input type="hidden" name="vehicle_name"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['type'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_name']->value;
}?>">

    <tr><td>
    <input type="hidden" name="selectform" value="provider">
    <input class="btn btn-info" type="submit" name="submit" value="Add">
    <a href="javascript:void(0)" class="btn btn-info button_form_cancel" style="text-decoration:none;color:white;margin-left:30em;"> Cancel </a>
    </td></tr>
    </table>
    </form>
    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/vehicle_pag.php" name="form_cancel" class="form_cancel">
    <input type="hidden" class="form_post" name="vehicle_name" value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle_name'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_name']->value;
}?>">
    <input type="submit" style="display: none;">
    </form>
    </div>
<br><br>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
