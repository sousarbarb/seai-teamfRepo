<?php
/* Smarty version 3.1.33, created on 2019-12-27 11:30:38
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\requests\Previous_data.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e05dd4e5c8194_07791705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7ec9473a103d3f66cf1ba4b45c27726691eb754' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\requests\\Previous_data.tpl',
      1 => 1577442632,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/navbar_logged_in.tpl' => 1,
    'file:../common/logout.tpl' => 1,
  ),
),false)) {
function content_5e05dd4e5c8194_07791705 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request - Existent Data</h2>
	<br>
	<form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/buy_request.php" method="post">
	<table class='pd_filt' id="fil">
		<td>
			<table class='table_pd' id="foo">
			<tr>
			<th>Area covered</th><th>Service Provider</th><th>Date</th><th>Price</th><th></th>
			</tr>
			<!-- <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['requests']->value, 'request');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request']->value) {
?>{
				<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['request']->value['area'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['sp'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['price'];?>
</td><td><input type="checkbox" name="check" value="<?php echo $_smarty_tpl->tpl_vars['request']->value['id'];?>
"></td>
				</tr>
				<tr>
				<td div class="info" colspan="6" ></td>
				</tr>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			 -->
			 <tr>
			 <td>90%</td><td>lsts</td><td>4/12</td><td>100$</td><td><input type="checkbox" name="check" value="3"></td>
			 </tr>
			 <tr>
			 <td div class="info" colspan="6" >555.555.555</td>
			 </tr>
			 <tr>
			 <td>70%</td><td>seai</td><td>4/12</td><td>100$</td><td><input type="checkbox" name="check" value="3"></td>
			 </tr>
			 <tr>
			 <td div class="info" colspan="6" >radddwadqwqdq</td>
			 </tr>
			</table>
			<br>
			<input type="submit" name="back" class="comfirm" value="Go back to Map" >
			<input type="submit" name="Confirm" class="comfirm" value="Confirm Selection" >
			<input type="submit" name="Plan" class="comfirm" value="Plan new Mission" >
			</form>
		</td>
		<td>
			<div class="text-white vehicles_sideText">
				<?php if (($_smarty_tpl->tpl_vars['acc_type']->value == "provider")) {?>
				&nbsp;&nbsp;
				<a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_vehicles_add.php" class="button4 buttonsAcc" style="text-decoration:none;color:white;"> Add Vehicle </a>
				<br><br>
				<?php }?>
				<label class="vehicle_filtro_lbl">Filter type 1</label><br>
				<form method="get" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_filter_public.php">
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
		</td>
		
	</table>

<br>
</div>
</div>
<?php }
}
