<?php
/* Smarty version 3.1.33, created on 2019-12-08 19:14:34
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_requests_history\client_progress.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ded3d8a6d83f5_15686759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00e1e1f557185f0f6d14481dd19d1fba3a5a85a8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_requests_history\\client_progress.tpl',
      1 => 1575828847,
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
function content_5ded3d8a6d83f5_15686759 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Mission ID</th><th>Mission Specifications</th><th>Plan Selection</th><th>Payment Confirmation</th><th>Status</th>
    </tr>


    <!-- <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['requests']->value, 'request');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request']->value) {
?>{
        <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['request']->value['area'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['request']->value['sp'];?>
</td>

        <td><?php if ($_smarty_tpl->tpl_vars['plan']->value == false) {?>
        <a href="client_progress.tpl">Select Available Plans</a>
        <?php } else { ?>
        <input type="checkbox" checked="true" onclick="return false;"/>
        <?php }?>
        </td>

        <td>
        <input type="checkbox">
        </td>


        <td><a href="client_progress.tpl">See Status</a></td>
        </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
     -->

    </table>
    <br>

    </form>
<br>

</div>
</div>
<?php }
}
