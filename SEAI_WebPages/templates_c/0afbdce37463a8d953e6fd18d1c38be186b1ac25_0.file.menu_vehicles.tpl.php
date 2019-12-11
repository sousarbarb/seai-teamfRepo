<?php
/* Smarty version 3.1.33, created on 2019-12-11 04:19:51
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_vehicles\menu_vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df060573d1ca7_15317135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0afbdce37463a8d953e6fd18d1c38be186b1ac25' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_vehicles\\menu_vehicles.tpl',
      1 => 1576034390,
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
function content_5df060573d1ca7_15317135 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">VEHICLES</h2>
  <p class="lead text-white mb-0">Infomation about public vehicles</p>
  <div class="separator"></div>
    <div class="grid_vehicles">
      <div class="text-white vehicles_table">
        <div class="vehicles_row">
          <div class="vehicle">
            <div class="vehicle_frame">
               <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
               <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
        </div>
        <div class="vehicles_row">
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
        </div>
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
actions/vehicles_filter.php">
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

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
