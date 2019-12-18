<?php
/* Smarty version 3.1.33, created on 2019-12-18 19:17:55
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_requests_history\provider_history.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5dfa6d530cf7c9_42382252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0cf74c551bca9569930a5e2289f7f18bbdab2594' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_requests_history\\provider_history.tpl',
      1 => 1576693074,
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
function content_5dfa6d530cf7c9_42382252 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th> Mission ID</th><th>Service Client</th><th>Vehicles</th><th>Starting Time</th><th>Finishing Time</th><th>Informations</th>
    </tr>


    <?php $_smarty_tpl->_assignInScope('requests', array(array("area"=>"100","sp"=>"20","date"=>"13","specs"=>"x","price"=>"13","file"=>"files/teste.txt"),array("area"=>100,"sp"=>20,"date"=>13,"specs"=>'x',"price"=>13,"file"=>"files/teste.txt"),array("area"=>100,"sp"=>20,"date"=>13,"specs"=>'x',"price"=>13,"file"=>"files/teste.txt")));?>



    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['requests']->value, 'request');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request']->value) {
?>
        <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['request']->value['area'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['sp'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['specs'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['request']->value['price'];?>
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
    <br>

    </form>
<br>

</div>
</div>
<?php }
}
