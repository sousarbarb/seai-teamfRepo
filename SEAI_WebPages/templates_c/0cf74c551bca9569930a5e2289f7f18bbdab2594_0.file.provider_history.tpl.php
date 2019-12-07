<?php
/* Smarty version 3.1.33, created on 2019-12-07 13:41:58
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_requests_history\provider_history.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5deb9e1695f5d9_61311320',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0cf74c551bca9569930a5e2289f7f18bbdab2594' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_requests_history\\provider_history.tpl',
      1 => 1575719517,
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
function content_5deb9e1695f5d9_61311320 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Mission ID</th><th>Service Client</th><th>Vehicles</th><th>Starting Time</th><th>Finishing Time</th><th>Informations</th>
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
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['specs'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['price'];?>
</td><td><a href="pdf.pdf" download><img src ="images/pdf.png" widht=20px height=20px></td>

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
</div><?php }
}
