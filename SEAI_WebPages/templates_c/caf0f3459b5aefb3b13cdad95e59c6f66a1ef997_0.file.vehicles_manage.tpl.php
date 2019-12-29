<?php
/* Smarty version 3.1.33, created on 2019-12-29 14:48:58
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_admin\vehicles_manage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e08aecaccf1c4_20692129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caf0f3459b5aefb3b13cdad95e59c6f66a1ef997' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_admin\\vehicles_manage.tpl',
      1 => 1577627336,
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
function content_5e08aecaccf1c4_20692129 (Smarty_Internal_Template $_smarty_tpl) {
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['search_results']->value, 'result');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['result']->value) {
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_name'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['provider_entityname'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_active'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['result']->value['vehicle_approval'];?>
</td>
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
