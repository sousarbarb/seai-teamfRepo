<?php
/* Smarty version 3.1.33, created on 2019-12-11 17:47:57
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\common\login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df11dbd6e6a61_32512609',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbf4e296b639017759fb59da52fa31ce08876a60' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\common\\login_form.tpl',
      1 => 1576082855,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5df11dbd6e6a61_32512609 (Smarty_Internal_Template $_smarty_tpl) {
?><!LOGIN FORM>
    <button onclick="document.getElementById('id01').style.display='block'" class= "logbutton button4 "style="width:auto;">Login / Sign-Up</button>
    <div id="id01" class="modal">
      <form method="post" class="modal-content animate" action="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/login.php">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2017/01/shutterstock_534491617-600.jpg" alt="Avatar" class="avatar">
        </div>
      <div class="container">
        <input type="text" placeholder="Enter Username" name="name" required>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit"> Confirm </button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
      <div class="container" style="background-color:#f1f1f1"><!-- box color on the forget pass button-->
        <span class="psw"> <a href="#">Forgot password?</a></span>
        <p class="psw"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
actions/register.php" class="createAccountNow">Sign-Up Here </a></p>
      </div>
      </form>
    </div>
<?php }
}
