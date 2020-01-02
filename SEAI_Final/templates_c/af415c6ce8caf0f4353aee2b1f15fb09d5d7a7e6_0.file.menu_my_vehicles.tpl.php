<?php
/* Smarty version 3.1.33, created on 2020-01-02 00:43:30
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\menu_vehicles\menu_my_vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0d2ea2946d40_38026330',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af415c6ce8caf0f4353aee2b1f15fb09d5d7a7e6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\menu_vehicles\\menu_my_vehicles.tpl',
      1 => 1577720760,
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
function content_5e0d2ea2946d40_38026330 (Smarty_Internal_Template $_smarty_tpl) {
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
  <h2 class="display-4 text-white">MY VEHICLES</h2>
  <p class="lead text-white mb-0">Infomation about my institution's vehicles</p>
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
    <div class="grid-vehicles">
      <div class="text-white">
        <table class="vehicles_table">
                <tr>
          <th>Vehicle Name</th><th>Localization</th><th>Active</th><th>Approved</th><th>Visibility</th><th>Service Provider</th>
        </tr>
        <br>
        <?php if ((empty($_smarty_tpl->tpl_vars['search_results']->value))) {?>
        <tr>
          <td colspan="6">There are no vehicles to show</td>
        </tr>
        <?php }?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['search_results']->value, 'result');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['result']->value) {
?>
        <tr>
          <td><form id="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/vehicle_pag.php">
            <input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_name'];?>
">
            <a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
').submit()" style="color:white;"><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_name'];?>
</a>
          </form></td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_localization'];?>
</td>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == TRUE) {?><td>Yes</td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == FALSE) {?><td>No</td>
          <?php }?>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_approval']) == TRUE) {?><td>Yes</td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_approval']) == FALSE) {?><td>No</td>
          <?php }?>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_public']) == TRUE) {?><td>Public</td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_public']) == FALSE) {?><td>Private</td>
          <?php }?>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['provider_entityname'];?>
</td>
        </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
      </div>
      <div class="text-white vehicles_sideText">
        <?php if (($_smarty_tpl->tpl_vars['acc_type']->value == "provider")) {?>
        &nbsp;&nbsp;
        <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_vehicles_add.php" class="button4 buttonsAcc" style="text-decoration:none;color:white;"> Add Vehicle </a>
        <br><br>
        <?php }?>

        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_vehicles.php">

        <label class="vehicle_filtro_lbl">Approval Status</label><br>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['approvals']->value, 'approval_status');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['approval_status']->value) {
?>
            <input type="checkbox"
                    name="approvals_array[]"
                    id="approvals_filter"
                    value="<?php echo $_smarty_tpl->tpl_vars['approval_status']->value;?>
"
                    <?php if (!empty($_smarty_tpl->tpl_vars['approvals_selected']->value)) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['approvals_selected']->value, 'selected');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selected']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['approval_status']->value == $_smarty_tpl->tpl_vars['selected']->value) {?>
                          checked
                        <?php }?>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    >
            <?php echo $_smarty_tpl->tpl_vars['approval_status']->value;?>
<br>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <br>

        <label class="vehicle_filtro_lbl">Specifications</label><br>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['specifications']->value, 'specification_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['specification_type']->value) {
?>
            <input  type="checkbox"
                    name="specifications_array[]"
                    id="specifications_filter"
                    value="<?php echo $_smarty_tpl->tpl_vars['specification_type']->value['specification_type'];?>
"
                    <?php if (!empty($_smarty_tpl->tpl_vars['specifications_selected']->value)) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['specifications_selected']->value, 'selected');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selected']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['specification_type']->value['specification_type'] == $_smarty_tpl->tpl_vars['selected']->value) {?>
                          checked
                        <?php }?>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    >
            <?php echo $_smarty_tpl->tpl_vars['specification_type']->value['specification_type'];?>
<br>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <br>

        <label class="vehicle_filtro_lbl">Communications</label><br>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['communications']->value, 'communication_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['communication_type']->value) {
?>
            <input  type="checkbox"
                    name="communications_array[]"
                    id="communications_filter"
                    value="<?php echo $_smarty_tpl->tpl_vars['communication_type']->value['communication_type'];?>
"
                    <?php if (!empty($_smarty_tpl->tpl_vars['communications_selected']->value)) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['communications_selected']->value, 'selected');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selected']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['communication_type']->value['communication_type'] == $_smarty_tpl->tpl_vars['selected']->value) {?>
                          checked
                        <?php }?>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    >
            <?php echo $_smarty_tpl->tpl_vars['communication_type']->value['communication_type'];?>
<br>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <br>

        <label class="vehicle_filtro_lbl">Sensors</label><br>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensors']->value, 'sensor_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sensor_type']->value) {
?>
            <input  type="checkbox"
                    name="sensors_array[]"
                    id="sensors_filter"
                    value="<?php echo $_smarty_tpl->tpl_vars['sensor_type']->value['sensor_type'];?>
"
                    <?php if (!empty($_smarty_tpl->tpl_vars['sensors_selected']->value)) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensors_selected']->value, 'selected');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selected']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['sensor_type']->value['sensor_type'] == $_smarty_tpl->tpl_vars['selected']->value) {?>
                          checked
                        <?php }?>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    >
            <?php echo $_smarty_tpl->tpl_vars['sensor_type']->value['sensor_type'];?>
<br>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <br>

        <label class="vehicle_filtro_lbl">Resolutions</label><br>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions']->value, 'res_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['res_value']->value) {
?>
            <input  type="checkbox"
                    name="resolutions_array[]"
                    id="resolutions_filter"
                    value="<?php echo $_smarty_tpl->tpl_vars['res_value']->value['value'];?>
"
                    <?php if (!empty($_smarty_tpl->tpl_vars['resolutions_selected']->value)) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions_selected']->value, 'selected');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selected']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['res_value']->value['value'] == $_smarty_tpl->tpl_vars['selected']->value) {?>
                          checked
                        <?php }?>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    >
            <?php echo $_smarty_tpl->tpl_vars['res_value']->value['value'];?>
<br>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <br>

        
          <input type="submit" name="vehicles_submit" style="display:none" value=""></input>
        </form>
      </div>
    </div>

</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
