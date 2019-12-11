<?php
/* Smarty version 3.1.33, created on 2019-12-11 13:06:37
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\common\logout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df0dbcd4ee2e2_83857077',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '291cfcc63a5931c48210eb47080bfd672b36f435' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\common\\logout.tpl',
      1 => 1576065996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5df0dbcd4ee2e2_83857077 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/logout.php">
    <input type="submit" class= "logbutton button4 submitAsBtn" style="width:auto;" value="Logout" />
</form>
<?php }
}
