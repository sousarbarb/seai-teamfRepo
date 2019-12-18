<?php
/* Smarty version 3.1.33, created on 2019-12-18 01:24:16
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\common\navbar_logged_in.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df971b0d34214_35860455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a5f412744aef8d44f6670bcad960004efd0eeeb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\common\\navbar_logged_in.tpl',
      1 => 1576628649,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5df971b0d34214_35860455 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<body>
<!                               NAVIGATION                                    >
  <div class="vertical-nav bg-white" id="sidebar">
      <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/logo/feup.png"  width="150" >
        </div>
      </div>

      <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

      <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
          <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/index.php" class="nav-link text-dark font-italic menu-highlight <?php if ($_smarty_tpl->tpl_vars['menu']->value == "1") {?> menu-highlight-active <?php }?>">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    My Account
                </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle menu-highlight <?php if ($_smarty_tpl->tpl_vars['menu']->value == "2") {?> menu-highlight-active <?php }?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
            Data
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_data.php">My Data</a>
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_data.php">Full List</a>
          </div>
        </li>
                <?php if ($_smarty_tpl->tpl_vars['acc_type']->value == "client") {?>
        <li class="nav-item">
          <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_vehicles.php" class="nav-link text-dark font-italic menu-highlight <?php if ($_smarty_tpl->tpl_vars['menu']->value == "3") {?> menu-highlight-active <?php }?>">
                    <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-submarine.png"></i>
                    Vehicles
                </a>
        </li>
                <?php } else {
$_prefixVariable1 = "provider";
$_smarty_tpl->_assignInScope('acc_type', $_prefixVariable1);
if ($_prefixVariable1) {?>
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle menu-highlight <?php if ($_smarty_tpl->tpl_vars['menu']->value == "3") {?> menu-highlight-active <?php }?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-submarine.png"></i>
            Vehicles
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_vehicles.php">My Vehicles</a>
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_vehicles.php">Full List</a>
          </div>
        </li>
        <?php }}?>
        <li class="nav-item dropdown">
          <a class="nav-link text-dark font-italic dropdown-toggle menu-highlight <?php if ($_smarty_tpl->tpl_vars['menu']->value == "4") {?> menu-highlight-active <?php }?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
            Requests
          </a>
          <div class="dropdown-container" aria-labelledby="navbarDropdown">
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_requests_history.php">History</a>
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_requests_progress.php">In Progess</a>
            <!--<div class="dropdown-divider"></div>-->
            <a class="dropdown-in" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/map.php">New</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_notifications.php" class="nav-link text-dark font-italic menu-highlight <?php if ($_smarty_tpl->tpl_vars['menu']->value == "5") {?> menu-highlight-active <?php }?>">
                    <i class="fa mr-3 text-primary fa-fw"><image class="icon-side" src="../icon/icon-notification.png"></i>
                    Notifications
                </a>
        </li>
      </ul>
    </div>

</body>
</html>
<?php }
}
