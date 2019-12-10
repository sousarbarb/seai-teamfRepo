<?php
/* Smarty version 3.1.33, created on 2019-12-10 04:05:05
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_vehicles\menu_my_vehicles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5def0b618e8e61_55147109',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1161ea42c9958aa3f842377f8af7e07f0669824' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_vehicles\\menu_my_vehicles.tpl',
      1 => 1575947100,
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
function content_5def0b618e8e61_55147109 (Smarty_Internal_Template $_smarty_tpl) {
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
        <label class="vehicle_filtro_lbl">Filter</label><br>
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/action_vehicles_filter.php">
          <input type="radio" name="vehicles_filter" value="filtro1"> Filtro1</input><br>
          <input type="radio" name="vehicles_filter" value="filtro2"> Filtro2</input><br>
          <input type="radio" name="vehicles_filter" value="filtro3"> Filtro3</input><br>
          <input type="radio" name="vehicles_filter" value="filtro4"> Filtro4</input><br>
          <input type="radio" name="vehicles_filter" value="filtro5"> Filtro5</input><br>
          <input type="radio" name="vehicles_filter" value="filtro6"> Filtro6</input><br>
          <input type="submit" name="vehicles_submit" style="display:none"></input>
        </form>
      </div>
    </div>

</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
>
$('input[type=radio][name=vehicles_filter]').change(function() {
    $('input[type=submit][name=vehicles_submit]').click();
});
<?php echo '</script'; ?>
>
<?php }
}
