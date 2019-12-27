<?php
/* Smarty version 3.1.33, created on 2019-12-27 12:43:31
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_requests_history\client_history.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e05ee6379af78_86843342',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d3bcad55416dbe12308bfc676e946a441fba183' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_requests_history\\client_history.tpl',
      1 => 1577446084,
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
function content_5e05ee6379af78_86843342 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <div class="separator"></div>

    <table class='table_ed'>
      <tr>
        <th style="text-align: center">Mission ID</th>
        <th style="text-align: center">Vehicles</th>
        <th style="text-align: center">Starting Time</th>
        <th style="text-align: center">Finishing Time</th>
        <th style="text-align: center">Informations</th>
      </tr>


    
    <?php $_smarty_tpl->_assignInScope('requests', array(array("area"=>"100","date"=>"13","specs"=>"x","price"=>"13","file"=>"files/teste.txt"),array("area"=>"100","date"=>"13","specs"=>"x","price"=>"13","file"=>"files/teste.txt"),array("area"=>"100","date"=>"13","specs"=>"x","price"=>"13","file"=>"files/teste.txt")));?>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['requests']->value, 'request');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request']->value) {
?>
        <tr>
          <td><?php echo $_smarty_tpl->tpl_vars['request']->value['area'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['request']->value['sp'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['request']->value['date'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['request']->value['specs'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['request']->value['price'];?>
</td>
          <td>
          <form method="POST" action="../actions/upload.php" enctype="multipart/form-data">
            <input type="file" name="real-file" id="real-file" hidden="hidden"/>
            <button type="button" id="custom-button" class="button4 button_provider_hist">Choose a File</button>
            <span id="custom-text" class="custom-txt">No file chosen, yet</span>
            <input type="submit" value="Confirmar" name="submit" class="button4 submitAsBtn button_provider_hist">
          </form>
          </td>
        </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </table>
</div>
<?php }
}
