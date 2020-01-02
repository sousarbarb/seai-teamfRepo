<?php
/* Smarty version 3.1.33, created on 2020-01-02 02:57:36
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\menu_vehicles\editsensor.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0d4e109d8128_55865605',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d93e46c362127bafe4c09f5434ff65ff35965ae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\menu_vehicles\\editsensor.tpl',
      1 => 1577930183,
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
function content_5e0d4e109d8128_55865605 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">EDIT SENSOR</h2>
  <p class="lead text-white mb-0">Manage sensor information</p>
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
  <form method="post" action="../actions/editsensor.php">
    <div class="text-white">
      <label class="myaccountlabel">Name</label>
      <input type="text" name="sensor_name" class="lead" placeholder="Enter the sensor name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['sensor_name'];
} else {
echo $_smarty_tpl->tpl_vars['sensor_name']->value;
}?>">
      <br>
      <label class="myaccountlabel">Comments</label>
      <input type="text" name="comments" class="lead" placeholder="Comments (optional)"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['comments'];
} else {
echo $_smarty_tpl->tpl_vars['comments']->value;
}?>">
      <br><br>

      <input type="hidden" name="sensor_id"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['sensor_id'];
} else {
echo $_smarty_tpl->tpl_vars['sensor_id']->value;
}?>">
      <input type="hidden" name="vehicle_name"
            value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle_name'];
} else {
echo $_smarty_tpl->tpl_vars['vehicle_name']->value;
}?>">


      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="javascript:void(0)" class="button4 buttonsAcc button_form_cancel" style="text-decoration:none;color:white"> Cancel </a>
    </div>
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
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
