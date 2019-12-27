<?php
/* Smarty version 3.1.33, created on 2019-12-27 13:30:41
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\requests\Plan_new_mission.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e05f971b1e294_49906639',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5fadef051936d9e4f7894e6bcd92cd835b9fdf03' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\requests\\Plan_new_mission.tpl',
      1 => 1577449835,
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
function content_5e05f971b1e294_49906639 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request</h2>
	<p class="lead text-white mb-0">Request New Mission Plan</p>
	<div class="separator"></div>
	<form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/plan_new_mission.php" method="post">
		<table class="table table-light table-bordered table_plan_new_mission" >
		  <thead>
		    <tr>
		      <th style="text-align: center"> Mission Restrictions</th>
		      <th style="text-align: center"> Intended Value</th>
		    </tr>
		  </thead>
		  <tbody>
			<tr>
				<td> Sensor Type </td> 
				<td>
					<input list="sensor">
					  <?php echo $_smarty_tpl->tpl_vars['sensors']->value;?>

				</td>
			</tr><tr>
				<td> Resolution </td>
				<td>
					<input list="resolution">
					  <?php echo $_smarty_tpl->tpl_vars['resolutions']->value;?>

				</td>
			</tr>
			<tr >
				<td> Deadline</td>
				<td>
					<input type="date" name="bday">
				</td>
			</tr>
			<tr >
				<td> Comment </td>
				<td>
					<textarea rows="4" cols="50">Comment</textarea>
				</td>
			</tr>
		 </tbody>
		</table>

		<input type="submit" name="back" class="confirm" value="Go back" >
		<input type="submit" name="Confirm" class="confirm" value="Confirm Request" >
	</form>
</div>
<?php }
}
