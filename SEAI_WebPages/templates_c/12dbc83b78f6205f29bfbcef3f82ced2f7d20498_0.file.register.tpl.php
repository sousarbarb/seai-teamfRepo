<?php
/* Smarty version 3.1.33, created on 2019-12-13 05:07:46
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\inicial\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df30e9278bc14_22299878',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12dbc83b78f6205f29bfbcef3f82ced2f7d20498' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\inicial\\register.tpl',
      1 => 1576210065,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/footer.tpl' => 1,
  ),
),false)) {
function content_5df30e9278bc14_22299878 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<a class="logbutton button4 submitAsBtn" href='<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/index.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
  <h2 class="display-4 text-white">REGISTRATION</h2>
  <p class="lead text-white mb-0">Select the type of user and fill the form to register on this platform</p>
  <div class="separator"></div>
<div class="service">
  <a href="#form_provider" onclick="return false;" class="button4left buttonsRegSelect" style="text-decoration:none;color:white"> Service Provider </a>
  <a href="#form_client" onclick="return false;" class="button4right buttonsRegSelect" style="text-decoration:none;color:white"> Service Client </a>
</div>

<div class="formulario">
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
<form class="form_register" id="form_provider" method="post" action="../actions/register_action.php">
<table class="tab">
<tr><td class="gg">
Entity Name: </td><td class="register"><input type="text" name="entity"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity'];
}?>">
</tr>
<tr><td>
Address: </td><td class="register"><input type="text" name="address"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['address'];
}?>">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="mail1"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['mail1'];
}?>">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="phone"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['phone'];
}?>">
</tr>

<tr><td>
Official Representative: </td><td class="register"><input type="text" name="official"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['official'];
}?>">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="mail2"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['mail2'];
}?>">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="phone2"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['phone2'];
}?>">
</tr>

<tr><td>
Username: </td><td class="register"><input type="text" name="user"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
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
<input type="hidden" name="selectform" value="provider">
<input class="btn btn-info" type="submit" name="submit" value="Register">
</td></tr>
</table>
</form>


<form class="form_register" id="form_client" method="post" action="../actions/register_action.php">
<table class="tab">
<tr><td class="gg">
Name: </td><td class="register"><input type="text" name="name"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['name'];
}?>">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="mail"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['mail'];
}?>">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="phone"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['phone'];
}?>">
</tr>

<tr><td>
Username: </td><td class="register"><input type="text" name="user"
          value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
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
<input type="hidden" name="selectform" value="client">
<input class="btn btn-info" type="submit" name="submit" value="Register">
</td></tr>
</table>
</form>



</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
