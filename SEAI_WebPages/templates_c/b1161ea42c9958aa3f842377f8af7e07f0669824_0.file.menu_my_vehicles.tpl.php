<?php
/* Smarty version 3.1.33, created on 2019-12-26 01:05:36
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_vehicles\menu_my_vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e03f950f09c74_16609363',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1161ea42c9958aa3f842377f8af7e07f0669824' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_vehicles\\menu_my_vehicles.tpl',
      1 => 1577318735,
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
function content_5e03f950f09c74_16609363 (Smarty_Internal_Template $_smarty_tpl) {
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
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_localization'];?>
</td>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == TRUE) {?><td>YES</td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == FALSE) {?><td>NO</td>
          <?php }?>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_approval']) == TRUE) {?><td>YES</td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_approval']) == FALSE) {?><td>NO</td>
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
        <label class="vehicle_filtro_lbl">Filter type 1</label><br>
        <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_filter_entity.php">
          <input type="radio" name="vehicles_filter1" value="all" <?php if ((!(isset($_smarty_tpl->tpl_vars['form_values']->value)) || ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter1'] == 'all'))) {?>checked="checked"<?php }?>> All</input><br>
          <input type="radio" name="vehicles_filter1" value="filter1" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter1'] == 'filter1'))) {?>checked="checked"<?php }?>> Filter1</input><br>
          <input type="radio" name="vehicles_filter1" value="filter2" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter1'] == 'filter2'))) {?>checked="checked"<?php }?>> Filter2</input><br>
          <input type="radio" name="vehicles_filter1" value="filter3" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter1'] == 'filter3'))) {?>checked="checked"<?php }?>> Filter3</input><br>
          <input type="radio" name="vehicles_filter1" value="filter4" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter1'] == 'filter4'))) {?>checked="checked"<?php }?>> Filter4</input><br>
          <input type="radio" name="vehicles_filter1" value="filter5" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter1'] == 'filter5'))) {?>checked="checked"<?php }?>> Filter5</input><br>
        <br>
        <label class="vehicle_filtro_lbl">Filter type 2</label><br>
          <input type="radio" name="vehicles_filter2" value="all" <?php if ((!(isset($_smarty_tpl->tpl_vars['form_values']->value)) || ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter2'] == 'all'))) {?>checked="checked"<?php }?>> All</input><br>
          <input type="radio" name="vehicles_filter2" value="filter1" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter2'] == 'filter1'))) {?>checked="checked"<?php }?>> Filter1</input><br>
          <input type="radio" name="vehicles_filter2" value="filter2" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter2'] == 'filter2'))) {?>checked="checked"<?php }?>> Filter2</input><br>
          <input type="radio" name="vehicles_filter2" value="filter3" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter2'] == 'filter3'))) {?>checked="checked"<?php }?>> Filter3</input><br>
          <input type="radio" name="vehicles_filter2" value="filter4" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter2'] == 'filter4'))) {?>checked="checked"<?php }?>> Filter4</input><br>
          <input type="radio" name="vehicles_filter2" value="filter5" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter2'] == 'filter5'))) {?>checked="checked"<?php }?>> Filter5</input><br>
        <br>
        <label class="vehicle_filtro_lbl">Filter type 3</label><br>
          <input type="radio" name="vehicles_filter3" value="all" <?php if ((!(isset($_smarty_tpl->tpl_vars['form_values']->value)) || ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter3'] == 'all'))) {?>checked="checked"<?php }?>> All</input><br>
          <input type="radio" name="vehicles_filter3" value="filter1" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter3'] == 'filter1'))) {?>checked="checked"<?php }?>> Filter1</input><br>
          <input type="radio" name="vehicles_filter3" value="filter2" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter3'] == 'filter2'))) {?>checked="checked"<?php }?>> Filter2</input><br>
          <input type="radio" name="vehicles_filter3" value="filter3" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter3'] == 'filter3'))) {?>checked="checked"<?php }?>> Filter3</input><br>
          <input type="radio" name="vehicles_filter3" value="filter4" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter3'] == 'filter4'))) {?>checked="checked"<?php }?>> Filter4</input><br>
          <input type="radio" name="vehicles_filter3" value="filter5" <?php if ((isset($_smarty_tpl->tpl_vars['form_values']->value) && ($_smarty_tpl->tpl_vars['form_values']->value['vehicles_filter3'] == 'filter5'))) {?>checked="checked"<?php }?>> Filter5</input><br>
          <input type="submit" name="vehicles_submit" style="display:none" value=""></input>
        </form>
      </div>
    </div>

</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
