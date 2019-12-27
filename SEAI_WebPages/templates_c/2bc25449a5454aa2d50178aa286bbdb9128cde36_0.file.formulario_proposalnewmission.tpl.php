<?php
/* Smarty version 3.1.33, created on 2019-12-27 15:46:01
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\requests\formulario_proposalnewmission.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e061929ebb075_41862345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2bc25449a5454aa2d50178aa286bbdb9128cde36' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\requests\\formulario_proposalnewmission.tpl',
      1 => 1577457960,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/header.tpl' => 1,
    'file:../common/navbar_logged_in.tpl' => 1,
    'file:../common/logout.tpl' => 1,
    'file:../common/footer-short.tpl' => 1,
  ),
),false)) {
function content_5e061929ebb075_41862345 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:../common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/navbar_logged_in.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:../common/logout.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Proposal for a new mission</h2>
  <div class="separator"></div>
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

  <div class="myacc">
  <form method="post" action="../actions/???.php" enctype="multipart/form-data">

    <div class="text-white">

      <label class="myaccountlabel">Starting Time</label>
      <input type="datetime-local" name="starting_time" class="lead" placeholder="Enter the starting time of the mission"
      value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['starting_time'];
}?>">
      <br>
      <label class="myaccountlabel">Finishing Time</label>
      <input type="datetime-local" name="finishing_time" class="lead" placeholder="Enter the finishing time of the mission"
      value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['finishing_time'];
}?>">
      <br>
      <label class="myaccountlabel">Cost</label>
      <input type="number" name="cost" class="lead" placeholder="Enter the total cost of the mission"
      value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['cost'];
}?>">
      <br>
      <label class="myaccountlabel">Vehicle</label>
      <input type="text" name="vehicle" class="lead" placeholder="Enter the vehicle that will be used in the mission"
      value="<?php if (isset($_smarty_tpl->tpl_vars['form_values']->value)) {
echo $_smarty_tpl->tpl_vars['form_values']->value['vehicle'];
}?>">
      <br>
      <label class="myaccountlabel">Detailed information</label>
      <input type="file" name="newmission_file" id="newmission_file" hidden="hidden"/>
      <button type="button" id="newmission_button" class="button4 button_provider_hist">Choose a File</button>
      <span id="newmission_txt" class="newmission_txt">No file chosen, yet</span>
      <br>
      <br>



      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Send Mission" />
      <a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/???.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:../common/footer-short.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
