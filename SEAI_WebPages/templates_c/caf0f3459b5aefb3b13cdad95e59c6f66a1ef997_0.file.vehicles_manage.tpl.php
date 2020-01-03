<?php
/* Smarty version 3.1.33, created on 2020-01-03 12:34:47
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_admin\vehicles_manage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0f26d745f7b8_08026158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caf0f3459b5aefb3b13cdad95e59c6f66a1ef997' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_admin\\vehicles_manage.tpl',
      1 => 1578050562,
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
function content_5e0f26d745f7b8_08026158 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if (($_smarty_tpl->tpl_vars['acc_type']->value != "admin")) {?>
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Error</h2>
  <p class="lead text-white mb-0">You don't have permission to see this page</p>
  <br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php } else { ?>
<div class ="menusLogin p-5">
  <h2 class="display-4 text-white">VEHICLES</h2>
  <p class="lead text-white mb-0">Select the vehicles you want to validate or remove</p>
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
  <div class="grid-vehicles">
  <div class="vehicles_table">
    <table width=600 border=1 id='tabela'>
      <tr>
        <th>Name</th>
        <th>Institution</th>
        <th>Active</th>
        <th>Approved</th>
      </tr>

      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['search_results_unapproved']->value, 'result');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['result']->value) {
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['provider_entityname'];?>
</td>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == TRUE) {?><td class="manage_green">Yes
          <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_deactivate" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Deactivate" />
          </form></td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == FALSE) {?><td class="manage_red">No
          <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_activate" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Activate" />
          </form></td>
          <?php }?>
          <td class="manage_red">No
          <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_manage_approval_status.php" method="post">
            <input type="hidden" name="vehicle_id_approve" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Approve" />
          </form></td>
        </tr>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['search_results_approved']->value, 'result');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['result']->value) {
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['provider_entityname'];?>
</td>
          <?php if (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == TRUE) {?><td class="manage_green">Yes
          <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_deactivate" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Deactivate" />
          </form></td>
          <?php } elseif (($_smarty_tpl->tpl_vars['result']->value['vehicle_active']) == FALSE) {?><td class="manage_red">No
          <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_manage_activation_status.php" method="post">
            <input type="hidden" name="vehicle_id_activate" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Activate" />
          </form></td>
          <?php }?>
          <td class="manage_green">Yes
          <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/vehicles_manage_approval_status.php" method="post">
            <input type="hidden" name="vehicle_id_disapprove" value="<?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_id'];?>
">
            <input type="submit" class="button4 submitAsBtn button_provider_hist" value="Disapprove" />
          </form></td>
        </tr>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </table>



  </div>
  </div>


<br>
<br>

</div>
</div>
<?php }?>

<?php $_smarty_tpl->_subTemplateRender('file:common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
