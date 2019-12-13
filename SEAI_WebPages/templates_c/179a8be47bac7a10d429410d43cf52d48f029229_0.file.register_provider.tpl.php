<?php
/* Smarty version 3.1.33, created on 2019-12-12 20:56:06
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\inicial\register_provider.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df29b56c6aa27_85687176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '179a8be47bac7a10d429410d43cf52d48f029229' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\inicial\\register_provider.tpl',
      1 => 1576180565,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../inicial/register.tpl' => 1,
  ),
),false)) {
function content_5df29b56c6aa27_85687176 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../inicial/register.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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

<div class="formulario">
<form method="post" action="../actions/register_provider_action.php">
<table class="tab">
<tr><td class="gg">
Entity Name: </td><td class="register"><input type="text" name="entity"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity'];
}?>">
</tr>
<tr><td>
Address: </td><td class="register"><input type="text" name="address"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['address'];
}?>">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="mail"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['mail'];
}?>">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="phone"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity'];
}?>">
</tr>

<tr><td>
Official Representative: </td><td class="register"><input type="text" name="official"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['official'];
}?>">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="mail2"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['mail2'];
}?>">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="phone2"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['phone2'];
}?>">
</tr>

<tr><td>
Username: </td><td class="register"><input type="text" name="user"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['user'];
}?>">
</tr>
<tr><td>
Password: </td><td class="register"><input type='password' name="password">
</tr>
<tr><td>
Confirm Password: </td><td class="register"><input type='password' name="password2">
</tr>
<tr><td>
  <input class="btn btn-info" type="submit" name="submit" value="Register">
</td></tr>
</table>
</form>
</div>
<br>
<?php }
}
