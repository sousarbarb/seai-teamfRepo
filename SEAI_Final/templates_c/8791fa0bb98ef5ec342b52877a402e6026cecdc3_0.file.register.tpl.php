<?php
/* Smarty version 3.1.33, created on 2019-12-30 11:19:39
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\initial\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09cf3bb41796_82009245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8791fa0bb98ef5ec342b52877a402e6026cecdc3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\initial\\register.tpl',
      1 => 1577068319,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/footer.tpl' => 1,
  ),
),false)) {
function content_5e09cf3bb41796_82009245 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<body>
<a class="logbutton button4 submitAsBtn" href='<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/index.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
  <h2 class="display-4 text-white">REGISTRATION</h2>
  <p class="lead text-white mb-0">Select the type of user and fill the form to register on this platform</p>
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

  <div class="formulario">
    <div class="acc_type_select">
      <a href="#form_provider" onclick="return false;" class="button4left buttonsRegSelect" style="text-decoration:none;color:white"> Service Provider </a>
      <a href="#form_client" onclick="return false;" class="button4right buttonsRegSelect" style="text-decoration:none;color:white"> Service Client </a>
    </div>

    <form class="form_register" id="form_provider" method="post" action="../actions/register_action.php" enctype="multipart/form-data">
    <table class="tab">
    <tr><td class="gg">
    Entity Name: </td><td class="register"><input type="text" name="entity_name"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_name'];
}?>">
    </tr>
    <tr><td>
    Address: </td><td class="register"><input type="text" name="entity_address"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_address'];
}?>">
    </tr>
    <tr><td>
    E-mail: </td><td class="register"><input type="text" name="entity_email"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_email'];
}?>">
    </tr>
    <tr><td>
    Phone Number: </td><td class="register"><input type="text" name="entity_number"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['entity_number'];
}?>">
    </tr>
    <tr class="space_under"><td>
    Image: </td><td class="register"><input type="file" name="entity_image" id="entity_image" hidden="hidden" />
    <button type="button" id="entity_image_button" class="button4 button_provider_hist">Choose a File</button>
    <span id="entity_image_txt" class="custom-txt">No file chosen, yet</span></td>
    </tr>

    <tr><td>
    Official Representative: </td><td class="register"><input type="text" name="name"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['name'];
}?>">
    </tr>
    <tr><td>
    E-mail: </td><td class="register"><input type="text" name="email"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['email'];
}?>">
    </tr>
    <tr class="space_under"><td>
    Phone Number: </td><td class="register"><input type="text" name="number"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'provider'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['number'];
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
    Address: </td><td class="register"><input type="text" name="address"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['address'];
}?>">
    </tr>
    <tr><td>
    E-mail: </td><td class="register"><input type="text" name="email"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['email'];
}?>">
    </tr>
    <tr class="space_under"><td>
    Phone Number: </td><td class="register"><input type="text" name="number"
              value="<?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['selectform'] == 'client'))) {
echo $_smarty_tpl->tpl_vars['form_values']->value['number'];
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

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
