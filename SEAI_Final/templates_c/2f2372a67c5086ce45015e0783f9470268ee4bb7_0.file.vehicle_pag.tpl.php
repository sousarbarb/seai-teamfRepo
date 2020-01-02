<?php
/* Smarty version 3.1.33, created on 2020-01-02 03:47:19
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\menu_vehicles\vehicle_pag.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0d59b77451f5_61153206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f2372a67c5086ce45015e0783f9470268ee4bb7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\menu_vehicles\\vehicle_pag.tpl',
      1 => 1577933234,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/header.tpl' => 1,
    'file:common/navbar_logged_in.tpl' => 1,
    'file:common/logout.tpl' => 1,
    'file:common/footer-short.tpl' => 1,
  ),
),false)) {
function content_5e0d59b77451f5_61153206 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
<div class="vehicle_text">


	<h2 class="display-4 text-white"><?php if (!($_smarty_tpl->tpl_vars['extinct']->value)) {
echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];
}?></h2>
	<p class="lead text-white mb-0">Information about vehicle</p>
	<div class="separator">
	</div>
	<?php if ((isset($_smarty_tpl->tpl_vars['success_messages']->value))) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['success_messages']->value, 'success');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['success']->value) {
?>
      <div class="msg_success"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</div>
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

	<?php if ($_smarty_tpl->tpl_vars['extinct']->value) {?>
    <p>This vehicle doesn't exist.</p>
  <?php } else { ?>
  <?php if ($_smarty_tpl->tpl_vars['notpublic']->value) {?>
    <p>Vehicle information not publicly available.</p>
  <?php } else { ?>

	<article>
		<p><label class="vehicle_info_label">Entity Name</label><?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['provider_username'];?>
</p>
		<p><label class="vehicle_info_label">Localization</label><?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_localization'];?>
</p>
		<p><label class="vehicle_info_label">Comments</label> <?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_comments'];?>
</p>
		<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
			<p><label class="vehicle_info_label">Approval</label> <?php if ($_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_approval']) {?>Yes<?php } else { ?>No<?php }?></p>
		  <p><label class="vehicle_info_label">Public</label> <?php if ($_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_public']) {?>Yes<?php } else { ?>No<?php }?></p>
    <?php }?>
	</article>

	<article>
		<table class="vehicle_titulo_table">
		<tr>
			<td class="vehicle_titulo">Specifications</td>
			<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
			<td>
			<form id="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
_addspecification" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/addspecification.php">
				<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
			</form>
			<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
_addspecification').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Specification</a>
	  	</td>
			<?php }?>
		</tr>
		</table>

		<?php if (count($_smarty_tpl->tpl_vars['specifications']->value) <= 0) {?>
			<p class="vehicle_res">No results found</p>
		<?php } else { ?>
			<p class="vehicle_res">Numbers of results found: <?php echo count($_smarty_tpl->tpl_vars['specifications']->value);?>
</p>
			<table class="vehicles_table" style="margin:0em 0em 2em 0em">
				<tr>
					<th>Type</th>
					<th>Value min</th>
					<th>Value max</th>
					<th>Comments</th>
					<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
					<th>Actions</th>
					<?php }?>
				</tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['specifications']->value, 'specification');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['specification']->value) {
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_type'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_valuemin'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_valuemax'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_comments'];?>
</td>
					<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
					<td>
						<form id="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
_editSpecification" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/editspecification.php">
							<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
							<input type="hidden" name="spec_id" value="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
">
							<input type="hidden" name="spec_valuemin" value="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_valuemin'];?>
">
							<input type="hidden" name="spec_valuemax" value="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_valuemax'];?>
">
							<input type="hidden" name="spec_comments" value="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_comments'];?>
">
	          </form>
						<form id="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
_deleteSpecification" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/deletespecification.php">
	            <input type="hidden" name="spec_id" value="<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
">
	          </form>
						<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
_editSpecification').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Edit Specification</a>
						<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['specification']->value['spec_id'];?>
_deleteSpecification').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Specification</a>
					</td>
					<?php }?>
				</tr>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
		<?php }?>
	</article>

	<article>
		<table class="vehicle_titulo_table">
		<tr>
			<td class="vehicle_titulo">Communications</td>
			<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
			<td>
				<form id="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
_addcommunication" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/addcommunication.php">
					<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
				</form>
				<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
_addcommunication').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Communication</a>
	  	</td>
			<?php }?>
		</tr>
		</table>
		<?php if (count($_smarty_tpl->tpl_vars['communications']->value) <= 0) {?>
			<p class="vehicle_res">No results found</p>
		<?php } else { ?>
			<p class="vehicle_res">Numbers of results found: <?php echo count($_smarty_tpl->tpl_vars['communications']->value);?>
</p>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['communications']->value, 'communication');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['communication']->value) {
?>
			<table>
				<tr>
					<td><label class="vehicle_info_label">Type: </label><?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_type'];?>
</td>
					<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
					<td>
						<form id="<?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_id'];?>
_deleteCommunication" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/deletecommunication.php">
							<input type="hidden" name="communication_id" value="<?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_id'];?>
">
						</form>
						<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_id'];?>
_deleteCommunication').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Communication</a>
					</td>
					<?php }?>
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Type: </label><?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_type'];?>
</td>
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Comments: </label><?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_comments'];?>
</td>
				</tr>
			</table>



				<ul>
					<li><?php echo $_smarty_tpl->tpl_vars['communication']->value['communication_type'];?>
</li>
				</ul>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php }?>
	</article>

	<article>
		<table class="vehicle_titulo_table">
		<tr>
			<td class="vehicle_titulo">Sensors</td>
			<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
			<td>
				<form id="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
_addsensor" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/addsensor.php">
					<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
				</form>
				<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
_addsensor').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Sensor</a>
	  	</td>
			<?php }?>
		</tr>
		</table>
		<?php if (count($_smarty_tpl->tpl_vars['sensors']->value) <= 0) {?>
			<p class="vehicle_res">No results found</p>
		<?php } else { ?>
			<p class="vehicle_res">Numbers of results found: <?php echo count($_smarty_tpl->tpl_vars['sensors']->value);?>
</p>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sensors']->value, 'sensor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sensor']->value) {
?>
			<table>
				<tr>
					<td><label class="vehicle_info_label">Name: </label><?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_name'];?>
</td>
					<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
					<td>
						<form id="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
_editSensor" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/editsensor.php">
							<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
							<input type="hidden" name="sensor_id" value="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
">
							<input type="hidden" name="sensor_type" value="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_type'];?>
">
							<input type="hidden" name="sensor_name" value="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_name'];?>
">
							<input type="hidden" name="sensor_comments" value="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_comments'];?>
">
						</form>
						<form id="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
_deleteSensor" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/deletesensor.php">
							<input type="hidden" name="sensor_id" value="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
">
						</form>
						<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
_editSensor').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Edit Sensor</a>
						<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
_deleteSensor').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Sensor</a>
					</td>
					<?php }?>
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Type: </label><?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_type'];?>
</td>
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Comments: </label><?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_comments'];?>
</td>
				</tr>
			</table>

			<?php $_smarty_tpl->_assignInScope('numresults', 0);?>

			<div style="margin:0em 0em 0em 2em">
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
						<?php $_smarty_tpl->_assignInScope('numresults', $_smarty_tpl->tpl_vars['numresults']->value+1);?>
					<?php }?>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<table class="vehicle_titulo_table">
			<tr>
				<td class="vehicle_titulo">Resolutions</td>
				<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
				<td>
					<form id="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
_addresolution" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/addresolution.php">
						<input type="hidden" name="sensor_id" value="<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
">
						<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
					</form>
					<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['sensor']->value['sensor_id'];?>
_addresolution').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Resolution</a>
		  	</td>
				<?php }?>
			</tr>
			</table>
			<?php if ($_smarty_tpl->tpl_vars['numresults']->value <= 0) {?>
				<p class="vehicle_res">No results found<p>
			<?php } else { ?>
				<p class="vehicle_res">Numbers of results found: <?php echo $_smarty_tpl->tpl_vars['numresults']->value;?>
</p>
				<table class="vehicles_table" style="margin:0em 0em 2em 0em">
					<tr>
						<th>Value</th>
						<th>Consumption</th>
						<th>Velocity</th>
						<th>Cost</th>
						<th>Swath</th>
						<th>Comments</th>
						<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
						<th>Actions</th>
						<?php }?>
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
									<td><?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_comments'];?>
</td>
									<?php if ($_smarty_tpl->tpl_vars['sameprovider']->value) {?>
									<td>
										<form id="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
_editResolution" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/editresolution.php">
											<input type="hidden" name="vehicle_name" value="<?php echo $_smarty_tpl->tpl_vars['generalInfo']->value['vehicle_name'];?>
">
											<input type="hidden" name="res_id" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
">
											<input type="hidden" name="res_value" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_value'];?>
">
											<input type="hidden" name="res_consumption" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_consumption'];?>
">
											<input type="hidden" name="res_velocity" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_velocity'];?>
">
											<input type="hidden" name="res_cost" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_cost'];?>
">
											<input type="hidden" name="res_swath" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_swath'];?>
">
											<input type="hidden" name="res_comments" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_comments'];?>
">
					          </form>
										<form id="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
_deleteResolution" method="post" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/deleteresolution.php">
					            <input type="hidden" name="res_id" value="<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
">
					          </form>
										<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
_editResolution').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Edit Resolution</a>
										<a href="#" onclick="document.getElementById('<?php echo $_smarty_tpl->tpl_vars['resolution']->value['res_id'];?>
_deleteResolution').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Resolution</a>
									</td>
									<?php }?>
								</tr>
							<?php }?>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</table>
			<?php }?>
		</div>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>
</article>
<?php }
}?>
<br><br><br>
</div>
</div>

<?php $_smarty_tpl->_subTemplateRender('file:common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
