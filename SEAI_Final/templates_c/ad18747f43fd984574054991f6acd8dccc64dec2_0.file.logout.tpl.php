<?php
/* Smarty version 3.1.33, created on 2019-12-30 10:41:13
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/common/logout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09d4497a8926_36250190',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad18747f43fd984574054991f6acd8dccc64dec2' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/common/logout.tpl',
      1 => 1576065996,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e09d4497a8926_36250190 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/logout.php">
    <input type="submit" class= "logbutton button4 submitAsBtn" style="width:auto;" value="Logout" />
</form>
<?php }
}
