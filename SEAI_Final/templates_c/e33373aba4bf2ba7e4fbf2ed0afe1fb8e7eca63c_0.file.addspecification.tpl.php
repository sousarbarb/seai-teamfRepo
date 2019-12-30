<?php
/* Smarty version 3.1.33, created on 2019-12-30 18:58:18
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_vehicles/addspecification.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0a48cad127c6_50844760',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e33373aba4bf2ba7e4fbf2ed0afe1fb8e7eca63c' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/menu_vehicles/addspecification.tpl',
      1 => 1577714852,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/footer.tpl' => 1,
  ),
),false)) {
function content_5e0a48cad127c6_50844760 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<a class="logbutton button4 submitAsBtn" href='<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/vehicle_pag.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
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

    <form class="formulario" id="form_provider" method="post" action="../actions/addspecification.php" enctype="multipart/form-data">
    <table class="tab">
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
    Comments: </td><td class="register"><input type="text" name="comments"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['comments'];
}?>">
    </tr>
    
    <input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['vehicle_name']->value;?>
">

    <tr><td>
    <input type="hidden" name="selectform" value="provider">
    <input class="btn btn-info" type="submit" name="submit" value="Add">
    </td></tr>
    </table>
    </form>


</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
