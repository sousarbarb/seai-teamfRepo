<?php
/* Smarty version 3.1.33, created on 2019-12-11 19:32:23
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\inicial\inicial.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df13637c60ba0_44562117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e2f2c38701d1f3e611eb42922ad2bd2ae7c6435' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\inicial\\inicial.tpl',
      1 => 1576088851,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/login_form.tpl' => 1,
    'file:../common/footer.tpl' => 1,
  ),
),false)) {
function content_5df13637c60ba0_44562117 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/login_form.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!                                MAIN TEXT                                    >
  <div class="page-content p-5" id="content">
    <h2 class="display-4 text-white">SEAI- WEB PAGE</h2>
    <p class="lead text-white mb-0">Project conceived in the ambit of the unit course of Engineering Systems
     - Automation and Instrumentation carried out by students of the 5th year of the Integrated
     Master in Electrical and Computer Engineering of the Faculty of Engineering, University of Porto.</p>
    <div class="separator"></div>
    <?php if ((isset($_smarty_tpl->tpl_vars['success_messages']->value))) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['success_messages']->value, 'success');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['success']->value) {
?>
        <div class="msg_success"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
 <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
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
    <div class="row text-white">
      <div class="col-lg-6">
        <p class="lead">The future of maritime operations, particularly with unmanned vehicles,
          involves sophisticated web-based execution control and planning systems.
          For this reason, the system communicates with a web-based platform (Ripples) developed by the
          <a class="one"  href="https://lsts.fe.up.pt/" target="_blank"><b> Underwater Systems and Technology Laboratory
          </b></a> in order to control and monitor the existing fleet of vehicules and consists in the centralization of all
          the information acquired from this type of vehicle with a main focus on the planning of new missions of said vehicules.
          To access this information, the user must register as a Service Provider or a Service Client.
        </p>
        <p class="lead"> All the data present in the platform is managed by the users that acquired it - Service Providers.</p>
        <p class="lead">Regarding the requests for new mission plans or access to past data, these actions are preformed by the Service Client.</p>

      </div>
      <div class="col-lg-6">

        <p class="lead"> For more information on how to login in the website, check the following videos.</p>
        <p class="lead text-white mb-0"> Service Provider</p>
        <div class="bg-white p-5 rounded shadow-sm">
        <p class="lead font-italic mb-0 text-muted"> Put video on how to register and navigate through the site</p>
        </div>
        <p class= "lead my-5"></p>
        <p class="lead text-white mb-0"> Service Client</p>
        <div class="bg-white p-5 rounded shadow-sm">
        <p class="lead font-italic mb-0 text-muted"> Put video on how to register and navigate through the site</p>
        </div>
      </div>
    </div>

  </div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
