<?php
/* Smarty version 3.1.33, created on 2019-12-29 18:29:11
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_vehicles\menu_vehicles_add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e08e267f2e103_28437518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '914e70e83c34650f8018f0d2fa4e27e59435bd81' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_vehicles\\menu_vehicles_add.tpl',
      1 => 1577640545,
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
function content_5e08e267f2e103_28437518 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if (($_smarty_tpl->tpl_vars['acc_type']->value != "provider")) {?>
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Error</h2>
  <p class="lead text-white mb-0">You don't have permission to see this page</p>
  <br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php } else { ?>
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">ADD VEHICLE</h2>
  <p class="lead text-white mb-0">Add a vehicle from my institution</p>
  <div class="separator"></div>
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
  <div class="text-white">
    <form class="vehicles_add" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_add.php">

      <input  type="hidden"
              name="vehicle_service_username"
              value="<?php echo $_smarty_tpl->tpl_vars['login']->value;?>
">

      <label class="vehicles_add_lbl">Vehicle Name</label>
      <input  type="text"
              name="vehicle_name"
              placeholder="type here..."
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_name'])) {?>
              value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_name'];?>
"
      <?php }?>
      >
      <br>

      <label class="vehicles_add_lbl">Localization</label>
      <input  type="text"
              name="vehicle_localization"
              placeholder="41.252314 50.102957 (lon. lat.)..."
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_localization'])) {?>
              value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_localization'];?>
"
      <?php }?>
      >
      <br>

      <label class="vehicles_add_lbl" style="vertical-align: top;padding-top:5px;">Comments</label>
      <textarea type="text"
                name="vehicle_comments"
                placeholder="type here..."><?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_comments'])) {
echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_comments'];
}?></textarea>
      <br>

      <label class="vehicles_add_lbl">Public</label>
      <input type="radio" name="vehicle_public" value="y"> Yes
      <input type="radio" name="vehicle_public" value="n"> No
      <br>
      <br>
      <input type="submit" name="vehicles_add_submit" class="button4 submitAsBtn" value="Add Vehicle" style="width:auto;"></input>
      <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_vehicles.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> My Vehicles List </a>

    </form>

      </div>

</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
