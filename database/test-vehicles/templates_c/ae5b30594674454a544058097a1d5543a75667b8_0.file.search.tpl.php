<?php
/* Smarty version 3.1.30, created on 2019-12-23 13:49:05
  from "C:\xampp\htdocs\seai\test-vehicles\templates\search.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e00b7c123e940_59022970',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae5b30594674454a544058097a1d5543a75667b8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai\\test-vehicles\\templates\\search.tpl',
      1 => 1577105340,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/header.tpl' => 1,
    'file:common/footer.tpl' => 1,
  ),
),false)) {
function content_5e00b7c123e940_59022970 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:common/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<aside>
  <header>Search Filters</header>
  <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/search.php" method="post">

    <h1>Service Providers:</h1>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service_providers']->value, 'entity_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['entity_name']->value) {
?>
      <input  type="checkbox"
              name="service_providers_array[]""
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              <?php }?>
              >
      <label for="<?php echo $_smarty_tpl->tpl_vars['entity_name']->value['entity_name'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['entity_name']->value['entity_name'];?>

      </label><br>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <h1>Specifications:</h1>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['specifications']->value, 'specification_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['specification_type']->value) {
?>
      <input  type="checkbox"
              name="specifications_array[]""
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              <?php }?>
              >
      <label for="<?php echo $_smarty_tpl->tpl_vars['specification_type']->value['specification_type'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['specification_type']->value['specification_type'];?>

      </label><br>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <h1>Communications:</h1>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['communications']->value, 'communication_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['communication_type']->value) {
?>
      <input  type="checkbox"
              name="communications_array[]""
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              <?php }?>
              >
      <label for="<?php echo $_smarty_tpl->tpl_vars['communication_type']->value['communication_type'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['communication_type']->value['communication_type'];?>

      </label><br>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <h1>Type of Sensors:</h1>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensors']->value, 'sensor_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sensor_type']->value) {
?>
      <input  type="checkbox"
              name="sensors_array[]""
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              <?php }?>
              >
      <label for="<?php echo $_smarty_tpl->tpl_vars['sensor_type']->value['sensor_type'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['sensor_type']->value['sensor_type'];?>

      </label><br>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <h1>Resolutions:</h1>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resolutions']->value, 'res_value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['res_value']->value) {
?>
      <input  type="checkbox"
              name="resolutions_array[]""
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
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              <?php }?>
              >
      <label for="<?php echo $_smarty_tpl->tpl_vars['res_value']->value['value'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['res_value']->value['value'];?>

      </label><br>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    <input type="submit" value="Submit">
  </form>
</aside>

<?php $_smarty_tpl->_subTemplateRender("file:common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
