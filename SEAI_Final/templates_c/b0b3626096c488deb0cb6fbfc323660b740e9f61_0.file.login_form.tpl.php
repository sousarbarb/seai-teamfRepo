<?php
/* Smarty version 3.1.33, created on 2020-01-01 14:50:24
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_Final\templates\common\login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e0ca3a03118c9_42948471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0b3626096c488deb0cb6fbfc323660b740e9f61' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_Final\\templates\\common\\login_form.tpl',
      1 => 1577703000,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e0ca3a03118c9_42948471 (Smarty_Internal_Template $_smarty_tpl) {
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
        <input type="text" placeholder="Enter Username" name="user" required>
        <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit" class="button4 submitAsBtn"> Confirm </button>
      </div>
      <div class="container">
        <span class="psw"> <a href="#" class="button4 submitAsBtn" style="text-decoration:none;color:white;">Forgot password?</a></span>
        <p class="psw"><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
pages/register.php" class="button4 submitAsBtn" style="text-decoration:none;color:white;">Sign-Up Here </a></p>
      </div>
      </form>
    </div>
<?php }
}
