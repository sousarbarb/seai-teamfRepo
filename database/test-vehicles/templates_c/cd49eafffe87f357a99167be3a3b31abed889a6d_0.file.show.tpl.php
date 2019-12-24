<?php
/* Smarty version 3.1.30, created on 2019-12-24 01:04:37
  from "C:\xampp\htdocs\seai\test-vehicles\templates\show.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e015615b335b2_87426010',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd49eafffe87f357a99167be3a3b31abed889a6d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai\\test-vehicles\\templates\\show.tpl',
      1 => 1577145854,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/header.tpl' => 1,
    'file:common/footer.tpl' => 1,
  ),
),false)) {
function content_5e015615b335b2_87426010 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div id="show">

<section id="vehicle_selection">
  <header>Select vehicle name to show details:</header>
  <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/show.php" method="POST">
    <!-- This is only here to simulate a vehicle selected in vehicles search results -->
    <datalist id="vehiclesnames">
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
    <input  type="text"
            name="vehicle_name"
            placeholder="select here..."
            list = "vehiclesnames"
          <?php if (isset($_smarty_tpl->tpl_vars['vehicle_name_selected']->value)) {?>
            value="<?php echo $_smarty_tpl->tpl_vars['vehicle_name_selected']->value;?>
"
          <?php }?>>
    <input type="submit" value="Submit">
  </form>
</section>



<?php if (isset($_smarty_tpl->tpl_vars['vehicle_name_selected']->value)) {?>

<section id="vehicle_info">
  <article>
    <header>General information:</header>
    <p>Vehicle ID: <?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_id'];?>
</p>
    <p>Name: <?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
</p>
    <p>Service Provider ID: <?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['provider_id'];?>
</p>
    <p>Localization: <?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_localization'];?>
</p>
    <p>Comments: <?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_comments'];?>
</p>
    <p>Active: <?php if ($_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_active']) {?>YES<?php } else { ?>NO<?php }?></p>
    <p>Approval: <?php if ($_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_approval']) {?>YES<?php } else { ?>NO<?php }?></p>
    <p>Public: <?php if ($_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_public']) {?>YES<?php } else { ?>NO<?php }?></p>
  </article>

  <article>
    <header>Specifications</header>
    <?php if (count($_smarty_tpl->tpl_vars['specifications']->value) <= 0) {?>
      <p>No results founded<p>
    <?php } else { ?>
      <p>Numbers of results founded: <?php echo count($_smarty_tpl->tpl_vars['specifications']->value);?>
</p>
      <table>
        <tr>
          <th>spec_id</th>
          <th>spec_type</th>
          <th>spec_valuemin</th>
          <th>spec_valuemax</th>
          <th>spec_active</th>
          <th>spec_comments</th>
        </tr>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['specifications']->value, 'specification');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['specification']->value) {
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_type'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_valuemin'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_valuemax'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_active'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_comments'];?>
</td>
        </tr>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </table>
    <?php }?>
  </article>

  <article>
    <header>Communications</header>
    <?php if (count($_smarty_tpl->tpl_vars['communications']->value) <= 0) {?>
      <p>No results founded<p>
    <?php } else { ?>
      <p>Numbers of results founded: <?php echo count($_smarty_tpl->tpl_vars['communications']->value);?>
</p>
      <table>
        <tr>
          <th>communication_id</th>
          <th>communication_type</th>
        </tr>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['communications']->value, 'communication');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['communication']->value) {
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_id'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_type'];?>
</td>
        </tr>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </table>
    <?php }?>
  </article>

  <article>
    <header>Sensors</header>
    <?php if (count($_smarty_tpl->tpl_vars['sensors']->value) <= 0) {?>
      <p>No results founded<p>
    <?php } else { ?>
      <p>Numbers of results founded: <?php echo count($_smarty_tpl->tpl_vars['sensors']->value);?>
</p>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensors']->value, 'sensor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sensor']->value) {
?>
      <div>
        <p>ID: <?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
</p>
        <p>Type: <?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_type'];?>
</p>
        <p>Name: <?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_name'];?>
</p>
        <p>Active: <?php if ($_smarty_tpl->tpl_vars['sensor']->value['sensor_active']) {?>YES<?php } else { ?>NO<?php }?></p>
        <p>Comments: <?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_comments'];?>
</p>

        <?php $_smarty_tpl->_assignInScope('numresults', 0);
?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions_array']->value, 'resolutions');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['resolutions']->value) {
?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions']->value, 'resolution');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['resolution']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['resolution']->value['res_sensorid'] == $_smarty_tpl->tpl_vars['sensor']->value['sensor_id']) {?>
              <?php $_smarty_tpl->_assignInScope('numresults', $_smarty_tpl->tpl_vars['numresults']->value+1);
?>
            <?php }?>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


        <?php if ($_smarty_tpl->tpl_vars['numresults']->value <= 0) {?>
          <p>No results founded<p>
        <?php } else { ?>
          <p>Numbers of results founded: <?php echo $_smarty_tpl->tpl_vars['numresults']->value;?>
</p>
          <table>
            <tr>
              <th>res_id</th>
              <th>res_value</th>
              <th>res_consumption</th>
              <th>res_velocity</th>
              <th>res_cost</th>
              <th>res_swath</th>
              <th>res_active</th>
              <th>res_comments</th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions_array']->value, 'resolutions');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['resolutions']->value) {
?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions']->value, 'resolution');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['resolution']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['resolution']->value['res_sensorid'] == $_smarty_tpl->tpl_vars['sensor']->value['sensor_id']) {?>
            <tr>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_value'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_consumption'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_velocity'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_cost'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_swath'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_active'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_comments'];?>
</td>
            </tr>
            <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

          </table>
        <?php }?>
      </div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <?php }?>
  </article>

</section>

</div>

<?php }?>

<?php $_smarty_tpl->_subTemplateRender("file:common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
