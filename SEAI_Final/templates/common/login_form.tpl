<!LOGIN FORM>
    <button onclick="document.getElementById('id01').style.display='block'" class= "logbutton button4 "style="width:auto;">Login / Sign-Up</button>
    <div id="id01" class="modal">
      <form method="post" class="modal-content animate" action="{$BASE_URL}actions/login.php">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="https://www.elegantthemes.com/blog/wp-content/uploads/2017/01/shutterstock_534491617-600.jpg" alt="Avatar" class="avatar">
        </div>
      <div class="container">
        <input type="text" placeholder="Enter Username" name="user" required>
        <input type="password" placeholder="Enter Password" name="password" required>
		{if $l_count > 1}
		<div class="g-recaptcha" data-sitekey="6LdrAMwUAAAAALniq3IijQhTPNiu_GCTpN1yKGK7" data-callback="callback"></div>
		<button type="submit" class="button4 submitAsBtn" disabled> Confirm </button>
		{else}
		<button type="submit" class="button4 submitAsBtn"> Confirm </button>
		{/if}
      </div>
      <div class="container">
        <span class="psw"> <a href="{$BASE_URL}pages/fpass.php" class="button4 submitAsBtn" style="text-decoration:none;color:white;">Forgot password?</a></span>
        <p class="psw"><a href="{$BASE_URL}pages/register.php" class="button4 submitAsBtn" style="text-decoration:none;color:white;">Sign-Up Here </a></p>
      </div>
      </form>
	  <script type="text/javascript">
		function callback(){
			console.log("The user has already solved the captcha, now you can submit your form.");
			document.querySelector('button[type="submit"]').disabled = false;			
		};
    </script>
    </div>
