<?php
/* Smarty version 3.1.33, created on 2019-11-27 16:32:23
  from '/usr/users2/2015/up201503070/public_html/SEAI_WebPages/templates/login_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ddea517948e18_63286944',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dea9c969c5afcb76b3d628b86e20cb1bf2575cd0' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_WebPages/templates/login_form.tpl',
      1 => 1574872248,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ddea517948e18_63286944 (Smarty_Internal_Template $_smarty_tpl) {
?><!LOGIN FORM>
    <button onclick="document.getElementById('id01').style.display='block'" class= "logbutton button4 "style="width:auto;">Login / Sign-Up</button>
    <div id="id01" class="modal">
      <form class="modal-content animate" action="/action_page.php">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2017/01/shutterstock_534491617-600.jpg" alt="Avatar" class="avatar">
        </div>
      <div class="container">
        <input type="text" placeholder="Enter Username" name="uname" required>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <button type="submit"> Confirm </button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
      <div class="container" style="background-color:#f1f1f1"><!-- box color on the forget pass button-->
        <span class="psw">Forgot <a href="#">password?</a></span>
        <p class="psw"><a href="createAccount.html" class="createAccountNow">Sign-Up Here </a></p>
      </div>
      </form>
    <?php echo '<script'; ?>
>
      // Get the modal
      var modal = document.getElementById('id01');
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    <?php echo '</script'; ?>
>
    </div><?php }
}
