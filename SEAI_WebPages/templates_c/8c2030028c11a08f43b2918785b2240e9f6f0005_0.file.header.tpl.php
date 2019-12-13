<?php
/* Smarty version 3.1.33, created on 2019-12-12 12:57:30
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\common\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df22b2ae9d514_09242721',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c2030028c11a08f43b2918785b2240e9f6f0005' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\common\\header.tpl',
      1 => 1576151632,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5df22b2ae9d514_09242721 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<!                                 HEADER                                      >
  <head>
    <title>TEAM#F | Web Platform</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/style.css"></link>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
    <?php echo '<script'; ?>
 type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet"
			href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
			integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
			crossorigin=""/>

	  <!-- Leaflet JavaScript file -->
	  <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
			  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
			  crossorigin=""><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
 src="https://npmcdn.com/leaflet.path.drag/src/Path.Drag.js"><?php echo '</script'; ?>
>

	  <!-- Leaflet Polygon Editable -->
	  <?php echo '<script'; ?>
 src="../js/Leaflet.Editable.js"><?php echo '</script'; ?>
>

	  <!-- Maps Library -->
	  <?php echo '<script'; ?>
 src="../js/mapsLib.js"><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
 type="text/javascript" src="../js/table_dropdown.js"><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
 type="text/javascript" src="../js/Popup.js"><?php echo '</script'; ?>
>

    <!-- Login Form -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/login_form.js" type="text/javascript"><?php echo '</script'; ?>
>

    <!-- Register -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/register.js" type="text/javascript"><?php echo '</script'; ?>
>

    <!-- NavBar -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/menu_dropdown.js" type="text/javascript"><?php echo '</script'; ?>
>

    <!-- Messages Close Button -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/msg_close.js" type="text/javascript"><?php echo '</script'; ?>
>

    <!-- Vehicles Filter Auto Submit -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/vehicles_filter.js" type="text/javascript"><?php echo '</script'; ?>
>

  </head>
</html>
<?php }
}
