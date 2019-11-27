<?php
/* Smarty version 3.1.33, created on 2019-11-27 17:59:15
  from '/usr/users2/2015/up201503070/public_html/SEAI_WebPages/templates/navbar_logged_in.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ddeb9737edcb4_39340089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ed404562616c568b64b742abb436fc3015e2f23' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_WebPages/templates/navbar_logged_in.tpl',
      1 => 1574877551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ddeb9737edcb4_39340089 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<body>
<!                               NAVIGATION                                    >
  <div class="vertical-nav bg-white" id="sidebar">
      <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center"><img src="https://paginas.fe.up.pt/~cesg/images/logo_feup.png"  width="150" >
        </div>
      </div>

      <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>

      <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
          <a href="#" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    My Account
                </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                    Vehicles
                </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Requests
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">History</a>
            <a class="dropdown-item" href="#">In Progess</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">New</a>
          </div>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                    Notifications
                </a>
        </li>
      </ul>
    </div>
</body>
</html>
<?php }
}
