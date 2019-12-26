<?php
/* Smarty version 3.1.33, created on 2019-12-25 20:10:43
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\requests\map.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e03b433b6fbd8_11934153',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b52386823d50d1745eab7933b08f7f87e2554fe5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\requests\\map.tpl',
      1 => 1577147081,
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
function content_5e03b433b6fbd8_11934153 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="menusLogin p-5">
   	<h2 class="display-4 text-white">New Request - Area Selection</h2>
	<div class="grid">
	<div id="mapid" style="width: 100%; height: 48em; grid-column-start: 1;  grid-column-end: 2; grid-row-start: 1; grid-row-end: 3;"></div>
	<div id="tooltip"></div>
	<!-- Debug section -->

	<?php echo '<script'; ?>
>
	  var map, tooltip, deleteShape;
	  mapConfiguration();
	  
	 getinicialdata('../actions/action_send_area.php');
	<?php echo '</script'; ?>
>
	<div class="filters"></div>
	<div class="infotext">
	<p id="info"></p>

	<div class="popup" onclick="myFunction()"> Help
	  <span class="popuptext" id="myPopup">Instruction on how to use the interactive map: <br> -Double click the end point to finnish the area edition, <br> -Double click on an already created polygon to edit it,</span>
	</div>

</div>
<?php }
}
