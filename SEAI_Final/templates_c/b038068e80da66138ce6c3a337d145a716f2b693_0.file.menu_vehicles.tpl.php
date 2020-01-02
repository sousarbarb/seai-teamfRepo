<?php
/* Smarty version 3.1.33, created on 2020-01-02 17:15:27
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\menu_vehicles\menu_vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0e171f608ce8_42519296',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b038068e80da66138ce6c3a337d145a716f2b693' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\menu_vehicles\\menu_vehicles.tpl',
      1 => 1577721300,
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
function content_5e0e171f608ce8_42519296 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">VEHICLES</h2>
  <p class="lead text-white mb-0">Infomation about public vehicles</p>
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
          <th>Vehicle Name</th><th>Localization</th><th>Service Provider</th>
        </tr>
        <br>
        <?php if ((empty($_smarty_tpl->tpl_vars['search_results']->value))) {?>
        <tr>
          <td colspan="3">There are no vehicles to show</td>
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
pages/menu_vehicles.php">

        <label class="vehicle_filtro_lbl">Service Provider</label><br>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_providers']->value, 'entity_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['entity_name']->value) {
?>
            <input type="checkbox"
                    name="service_providers_array[]"
                    id="service_providers_filter"
                    value="<?php echo $_smarty_tpl->tpl_vars['entity_name']->value['entity_name'];?>
"
                    <?php if (!empty($_smarty_tpl->tpl_vars['service_providers_selected']->value)) {?>
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_providers_selected']->value, 'selected');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['selected']->value) {
?>
                        <?php if ($_smarty_tpl->tpl_vars['entity_name']->value['entity_name'] == $_smarty_tpl->tpl_vars['selected']->value) {?>
                          checked
                        <?php }?>
                      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    >
            <?php echo $_smarty_tpl->tpl_vars['entity_name']->value['entity_name'];?>
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

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
