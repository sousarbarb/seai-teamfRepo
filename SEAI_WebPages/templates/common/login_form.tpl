<!LOGIN FORM>
    <button onclick="document.getElementById('id01').style.display='block'" class= "logbutton button4 "style="width:auto;">Login / Sign-Up</button>
    <div id="id01" class="modal">
      <form method="post" class="modal-content animate" action="{$BASE_URL}actions/login.php">
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
        <p class="psw"><a href="{$BASE_URL}actions/register.php" class="createAccountNow">Sign-Up Here </a></p>
      </div>
      </form>
    </div>
