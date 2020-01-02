<?php
/* Smarty version 3.1.33, created on 2020-01-02 17:13:59
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\menu_vehicles\editvehicle.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0e16c7cafa14_29967615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5459438e0d497b0a8e01ec7f0601f129a0bd1ec1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\menu_vehicles\\editvehicle.tpl',
      1 => 1577981535,
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
function content_5e0e16c7cafa14_29967615 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">EDIT VEHICLE</h2>
  <p class="lead text-white mb-0">Manage vehicle information</p>
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
  
  <div class="myacc"><!--
  <form method="post" action="../actions/editvehicle.php">
      <label class="myaccountlabel">Vehicle name</label>
      <input type="text" name="vehicle_name" class="lead" placeholder="<?php echo $_smarty_tpl->tpl_vars['vehicle_name']->value;?>
"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle_name'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_name']->value;
}?>">
      <br>
      <label class="myaccountlabel">Localization</label>
      <input type="text" name="localization" class="lead" placeholder="<?php echo $_smarty_tpl->tpl_vars['localization']->value;?>
"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['localization'];
} else {
echo $_smarty_tpl->tpl_vars['localization']->value;
}?>">
      <br>
      <label class="myaccountlabel">Comments</label>
      <input type="text" name="comments" class="lead" placeholder="<?php echo $_smarty_tpl->tpl_vars['comments']->value;?>
"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['comments'];
} else {
echo $_smarty_tpl->tpl_vars['comments']->value;
}?>">
      <br>
      </div>
      <label class="myaccountlabel">Public:</label>
      <input type="radio" name="vehicle_public" value="y"> Yes&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="vehicle_public" value="n"> No 
      <br>
      <br>
      <br>

      <input type="hidden" name="vehicle_id" value="<?php echo $_smarty_tpl->tpl_vars['vehicle_id']->value;?>
">
      <input type="hidden" name="public" value="<?php echo $_smarty_tpl->tpl_vars['public']->value;?>
">

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/vehicle_pag.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    
  </form>-->
  <form method="post" action="../actions/editvehicle.php">
    <table class="text-white">
      <tr><td>
      Name: </td><td class="register"><input type="text" name="vehicle_name"
                value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle_name'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_name']->value;
}?>">
      </tr>
      <tr><td>
      Localization: </td><td class="register"><input type="text" name="localization"
                value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['localization'];
} else {
echo $_smarty_tpl->tpl_vars['localization']->value;
}?>">
      </tr>
      <tr><td>
      Comments: </td><td class="register"><input type="text" name="comments"
                value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['comments'];
} else {
echo $_smarty_tpl->tpl_vars['comments']->value;
}?>">
      </tr>
      <tr>
        <td>Public: </td>
        <td class="register">
          <input type="radio" name="vehicle_public" value="y"
                <?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {?>
                  <?php if ($_smarty_tpl->tpl_vars['form_values']->value['vehicle_public'] == 'y') {?> checked <?php }?>
                <?php } else { ?>
                  <?php if (isset($_smarty_tpl->tpl_vars['vehicle_public']->value) && !empty($_smarty_tpl->tpl_vars['vehicle_public']->value)) {?>
                    <?php if ($_smarty_tpl->tpl_vars['vehicle_public']->value == 'y') {?> checked <?php }?>
                  <?php }?>
                <?php }?>
                style ="width: auto;transform: scale(1);"> Yes 
          <input type="radio" name="vehicle_public" value="n"
                <?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {?>
                  <?php if ($_smarty_tpl->tpl_vars['form_values']->value['vehicle_public'] == 'n') {?> checked <?php }?>
                <?php } else { ?>
                  <?php if (isset($_smarty_tpl->tpl_vars['vehicle_public']->value) && !empty($_smarty_tpl->tpl_vars['vehicle_public']->value)) {?>
                    <?php if ($_smarty_tpl->tpl_vars['vehicle_public']->value == 'n') {?> checked <?php }?>
                  <?php }?>
                <?php }?>
                style ="width: auto;transform: scale(1);"> No
      </tr>

      <input type="hidden" name="vehicle_id"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle_id'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_id']->value;
}?>">
      <input type="hidden" name="vehicle_name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle_name'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_name']->value;
}?>">

      <tr><td>
      <?php if (empty($_smarty_tpl->tpl_vars['success_messages']->value)) {?>
        <input class="btn btn-info" type="submit" name="submit" value="Confirm">
        <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/vehicle_pag.php" class="btn btn-info button_form_cancel" style="text-decoration:none;color:white;margin-left:32em;"> Cancel </a>
      <?php } else { ?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/vehicle_pag.php" class="btn btn-info button_form_cancel" style="text-decoration:none;color:white;margin-left:30em;"> Back </a>
      <?php }?>
      </td></tr>

    </table>
  </form>
  </div>
<br><br>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
