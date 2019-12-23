<?php
/* Smarty version 3.1.30, created on 2019-12-22 13:57:54
  from "C:\xampp\htdocs\seai\test-vehicles\templates\common\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5dff685299bf61_70716102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82b86ad68da92bfe25cf4f6f52920c89cfe86ede' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai\\test-vehicles\\templates\\common\\header.tpl',
      1 => 1577019076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dff685299bf61_70716102 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
  <title>test-vehicles</title>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Stylesheet of the website -->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/style.css">
  <!-- Addition of jquery lib to our project -->
  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-2.2.4.min.js"><?php echo '</script'; ?>
>
  <!-- Addition of our javascript main file -->
  <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
javascript/main.js"><?php echo '</script'; ?>
>
</head>

<body>

<header>
  <!-- Website title -->
  <header>SEAI TEAM F - Test of tables related with vehicles</header>
  <!-- Success and Error Mesages -->
  <section>
    <?php if (isset($_smarty_tpl->tpl_vars['ERROR_MESSAGES']->value)) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ERROR_MESSAGES']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
        <article class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
 <a class="close" href="#">&#215;</a></article>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['SUCCESS_MESSAGES']->value)) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SUCCESS_MESSAGES']->value, 'success');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['success']->value) {
?>
        <article class="success"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
 <a class="close" href="#">&#215;</a></article>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <?php }?>
  </section>
  <!-- Top Navigation Bar -->
  <nav>
    <!-- Create new vehicles, sensors, etc -->
    <?php if ($_smarty_tpl->tpl_vars['PAGE']->value == 'new') {?> <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/create.php" class="active">New</a>
    <?php } else { ?>              <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/create.php">New</a><?php }?>
    <!-- Search vehicles, sensors, etc -->
    <?php if ($_smarty_tpl->tpl_vars['PAGE']->value == 'search') {?>  <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/search.php" class="active">Search</a>
    <?php } else { ?>                  <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/search.php">Search</a><?php }?>
    <!-- Delete vehicles, sensors, etc -->
    <?php if ($_smarty_tpl->tpl_vars['PAGE']->value == 'delete') {?>  <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/delete.php" class="active">Delete</a>
    <?php } else { ?>                  <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/delete.php">Delete</a><?php }?>
  </nav>
</header><?php }
}
