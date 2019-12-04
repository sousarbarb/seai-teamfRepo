<?php
/* Smarty version 3.1.33, created on 2019-12-04 21:02:38
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\menu_account\menu_my_account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5de810de32f5e0_70492820',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3354c24122fae3336179afedff2410c13436fc2d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\menu_account\\menu_my_account.tpl',
      1 => 1575489685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/navbar_logged_in.tpl' => 1,
    'file:../common/logout.tpl' => 1,
    'file:../common/footer.tpl' => 1,
  ),
),false)) {
function content_5de810de32f5e0_70492820 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
    <div class="text-white">
      <label class="myaccountlabel">Name</label> <label class="lead">My name</label>
      <br>
      <label class="myaccountlabel">E-mail</label> <label class="lead">user_email@emailprovider.com</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">+123453674980</label>
      <br>
      <br>
            <label class="myaccountlabel">Entity Name</label> <label class="lead">Entity that I represent</label>
      <br>
      <label class="myaccountlabel">Address</label> <label class="lead">Entity address</label>
      <br>
      <label class="myaccountlabel">E-mail</label> <label class="lead">entity_email@emailprovider.com</label>
      <br>
      <label class="myaccountlabel">Phone Number</label> <label class="lead">+425745359078</label>
      <br>
      <br>
      
      <form action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/menu_my_account_change.php">
          <input type="submit" class= "button4 submitAsBtn" style="width:auto;" value="Change User Info" />
      </form>

    </div>
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
