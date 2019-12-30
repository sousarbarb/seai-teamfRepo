<?php
/* Smarty version 3.1.33, created on 2019-12-30 11:17:36
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\common\logout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09cec0e977a4_89258445',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8c7103db640dbb81c8d708c803c6d060521f341' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\common\\logout.tpl',
      1 => 1576065996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e09cec0e977a4_89258445 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/logout.php">
    <input type="submit" class= "logbutton button4 submitAsBtn" style="width:auto;" value="Logout" />
</form>
<?php }
}
