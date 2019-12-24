<?php
/* Smarty version 3.1.30, created on 2019-12-23 18:38:01
  from "C:\xampp\htdocs\seai\test-vehicles\templates\create.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e00fb7943dda4_36760160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '053a3fcf540c7072216dc5af81da830f0f5fd028' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai\\test-vehicles\\templates\\create.tpl',
      1 => 1577105026,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/header.tpl' => 1,
    'file:common/footer.tpl' => 1,
  ),
),false)) {
function content_5e00fb7943dda4_36760160 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<section id="new">
  <!-- Creates new vehicle -->
  <article>
    <header>New vehicle</header>
    <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/newVehicle.php" method="POST">
      <p>Service Provider Username:</p>
      <datalist id="vehicle_serviceproviders">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_providers']->value, 'service_provider');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['service_provider']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['service_provider']->value['user_id'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_service_username'])) {?>
        <input  type="text"
                name="vehicle_service_username"
                placeholder="select or type here..."
                list = "vehicle_serviceproviders"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_service_username'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="vehicle_service_username"
                placeholder="select or type here..."
                list = "vehicle_serviceproviders">
      <?php }?>
      <br>

      <p>Name of vehicle:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_name'])) {?>
        <input  type="text"
                name="vehicle_name"
                placeholder="type here..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_name'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="vehicle_name"
                placeholder="type here...">
      <?php }?>
      <br>

      <p>Localization:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_localization'])) {?>
        <input  type="text"
                name="vehicle_localization"
                placeholder="41.252314 50.102957 (lon. lat.)..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_localization'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="vehicle_localization"
                placeholder="41.252314 50.102957 (lon. lat.)...">
      <?php }?>
      <br>

      <p>Comments:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_comments'])) {?>
        <textarea type="text"
                  name="vehicle_comments">
                    <?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['vehicle_comments'];?>
</textarea>
      <?php } else { ?>
        <textarea type="text"
                  name="vehicle_comments"
                  placeholder="type here..."></textarea>
      <?php }?>
      <br>

      <p>Public:</p>
      <input type="radio" name="vehicle_public" value="y"> Yes 
      <input type="radio" name="vehicle_public" value="n"> No 
      <br>
      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new specification -->
  <article>
    <header>New specification</header>
    <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/newSpec.php" method="POST">
      <p>Vehicle name:</p>
      <datalist id="spec_vehiclesnames">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vehicles_names']->value, 'vehicle_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vehicle_name']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['vehicle_name']->value['vehicle_name'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_vehiclename'])) {?>
        <input  type="text"
                name="spec_vehiclename"
                placeholder="select or type here..."
                list = "spec_vehiclesnames"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_vehiclename'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="spec_vehiclename"
                placeholder="select or type here..."
                list = "spec_vehiclesnames">
      <?php }?>
      <br>

      <p>Specification type:</p>
      <datalist id="spec_specstypes">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['specification_types']->value, 'specification_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['specification_type']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['specification_type']->value['specification_type'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_spectype'])) {?>
        <input  type="text"
                name="spec_spectype"
                placeholder="select or type here..."
                list = "spec_specstypes"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_spectype'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="spec_spectype"
                placeholder="select or type here..."
                list = "spec_specstypes">
      <?php }?>
      <br>

      <p>Minimum value:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_minvalue'])) {?>
        <input  type="text"
                name="spec_minvalue"
                placeholder="VALUE (UNITS)..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_minvalue'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="spec_minvalue"
                placeholder="VALUE (UNITS)...">
      <?php }?>
      <br>

      <p>Maximum value:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_maxvalue'])) {?>
        <input  type="text"
                name="spec_maxvalue"
                placeholder="VALUE (UNITS)..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_maxvalue'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="spec_maxvalue"
                placeholder="VALUE (UNITS)...">
      <?php }?>
      <br>

      <p>Comments:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_comments'])) {?>
        <textarea type="text"
                  name="spec_comments">
                    <?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['spec_comments'];?>
</textarea>
      <?php } else { ?>
        <textarea type="text"
                  name="spec_comments"
                  placeholder="type here..."></textarea>
      <?php }?>
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new sensor -->
  <article>
    <header>New sensor</header>
    <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/newSensor.php" method="POST">
      <p>Vehicle name:</p>
      <datalist id="sensor_vehiclesnames">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vehicles_names']->value, 'vehicle_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vehicle_name']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['vehicle_name']->value['vehicle_name'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_vehiclename'])) {?>
        <input  type="text"
                name="sensor_vehiclename"
                placeholder="select or type here..."
                list = "sensor_vehiclesnames"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_vehiclename'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="sensor_vehiclename"
                placeholder="select or type here..."
                list = "sensor_vehiclesnames">
      <?php }?>
      <br>

      <p>Sensor name:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_sensorname'])) {?>
        <input  type="text"
                name="sensor_sensorname"
                placeholder="type here..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_sensorname'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="sensor_sensorname"
                placeholder="type here...">
      <?php }?>
      <br>

      <p>Sensor type:</p>
      <datalist id="sensor_sensortypes">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensor_types']->value, 'sensor_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sensor_type']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['sensor_type']->value['sensor_type'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_sensortype'])) {?>
        <input  type="text"
                name="sensor_sensortype"
                placeholder="select or type here..."
                list = "sensor_sensortypes"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_sensortype'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="sensor_sensortype"
                placeholder="select or type here..."
                list = "sensor_sensortypes">
      <?php }?>
      <br>

      <p>Comments:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_comments'])) {?>
        <textarea type="text"
                  name="sensor_comments">
                    <?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['sensor_comments'];?>
</textarea>
      <?php } else { ?>
        <textarea type="text"
                  name="sensor_comments"
                  placeholder="type here..."></textarea>
      <?php }?>
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new resolution -->
  <article>
    <header>New resolution</header>
    <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/newResolution.php" method="POST">
      <p>Sensor Id:</p>
      <datalist id="res_sensorsids">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensors_ids']->value, 'sensor_id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sensor_id']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['sensor_id']->value['id'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_sensorid'])) {?>
        <input  type="text"
                name="res_sensorid"
                placeholder="select or type here..."
                list = "res_sensorsids"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_sensorid'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="res_sensorid"
                placeholder="select or type here..."
                list = "res_sensorsids">
      <?php }?>
      <br>

      <p>Resolution:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_resolution'])) {?>
        <input  type="text"
                name="res_resolution"
                placeholder="VALUE (UNITS)..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_resolution'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="res_resolution"
                placeholder="VALUE (UNITS)...">
      <?php }?>
      <br>

      <p>Nominal Velocity (DISTANCE / TIME):</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_velocity'])) {?>
        <input  type="text"
                name="res_velocity"
                placeholder="VALUE (UNITS)..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_velocity'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="res_velocity"
                placeholder="VALUE (UNITS)...">
      <?php }?>
      <br>

      <p>Impact on vehicle battery (ENERGY / TIME):</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_consumption'])) {?>
        <input  type="text"
                name="res_consumption"
                placeholder="VALUE (UNITS)..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_consumption'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="res_consumption"
                placeholder="VALUE (UNITS)...">
      <?php }?>
      <br>

      <p>Sensor swath range (meters):</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_swath'])) {?>
        <input  type="text"
                name="res_swath"
                placeholder="12312.41231..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_swath'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="res_swath"
                placeholder="12312.41231...">
      <?php }?>
      <br>

      <p>Cost (€/h):</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_cost'])) {?>
        <input  type="text"
                name="res_cost"
                placeholder="12341.4142..."
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_cost'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="res_cost"
                placeholder="12341.4142...">
      <?php }?>
      <br>

      <p>Comments:</p>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_comments'])) {?>
        <textarea type="text"
                  name="res_comments">
                    <?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['res_comments'];?>
</textarea>
      <?php } else { ?>
        <textarea type="text"
                  name="res_comments"
                  placeholder="type here..."></textarea>
      <?php }?>
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new resolution -->
  <article>
    <header>New communication</header>
    <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/newCommun.php" method="POST">
      <p>Type communication:</p>
      <datalist id="commun_types">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['communication_types']->value, 'communication_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['communication_type']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['communication_type']->value['communication_type'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['commun_type'])) {?>
        <input  type="text"
                name="commun_type"
                placeholder="select or type here..."
                list = "commun_types"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['commun_type'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="commun_type"
                placeholder="select or type here..."
                list = "commun_types">
      <?php }?>
      <br>

      <p>Vehicle name:</p>
      <datalist id="commun_vehiclesnames">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vehicles_names']->value, 'vehicle_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vehicle_name']->value) {
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['vehicle_name']->value['vehicle_name'];?>
">
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </datalist>
      <?php if (isset($_smarty_tpl->tpl_vars['FORM_VALUES']->value['commun_vehiclename'])) {?>
        <input  type="text"
                name="commun_vehiclename"
                placeholder="select or type here..."
                list = "commun_vehiclesnames"
                value="<?php echo $_smarty_tpl->tpl_vars['FORM_VALUES']->value['commun_vehiclename'];?>
">
      <?php } else { ?>
        <input  type="text"
                name="commun_vehiclename"
                placeholder="select or type here..."
                list = "commun_vehiclesnames">
      <?php }?>
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>
</section>


<?php $_smarty_tpl->_subTemplateRender("file:common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
