<?php
/* Smarty version 3.1.33, created on 2019-12-12 00:37:04
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\requests\Previous_data.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df17da05c79c7_73872197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7ec9473a103d3f66cf1ba4b45c27726691eb754' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\requests\\Previous_data.tpl',
      1 => 1576088465,
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
function content_5df17da05c79c7_73872197 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request - Existent Data</h2>
	<br>
	<form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
/Actions/buy_request.php" method="post">

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

<br>
</div>
</div>


<?php }
}
