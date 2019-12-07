<?php
/* Smarty version 3.1.33, created on 2019-12-07 12:50:57
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_vehicles\menu_vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5deb922124d594_66638161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0afbdce37463a8d953e6fd18d1c38be186b1ac25' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_vehicles\\menu_vehicles.tpl',
      1 => 1575719456,
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
function content_5deb922124d594_66638161 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">VEHICLES</h2>
  <p class="lead text-white mb-0">Infomation about public vehicles</p>
  <div class="separator"></div>
  <div class="grid_vehicles">
    <div class="text-white">
      <div class="vehicles_table">
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
    </div>
    <div class="vehicles_sideText">
      adjaodjn
    </div>
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
