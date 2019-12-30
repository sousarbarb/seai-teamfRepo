{include file='../common/header.tpl'}

<body>
<a class="logbutton button4 submitAsBtn" href='{$BASE_URL}pages/index.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
  <h2 class="display-4 text-white">FORGOT PASSWORD</h2>
  <p class="lead text-white mb-0">Please enter the email with wich you registered in our service</p>


    <div class="myacc">
  <form method="post" action="../actions/fpass.php">
    <div class="text-white">
      <label class="myaccountlabel">Email</label>
     <input type="text" name="fmail" class="lead" style="margin-left:-8em">
      <br>
	  <br>

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Reset password" />
      <a href="{$BASE_URL}pages/index.php" class="button4 buttonsAcc" style="text-decoration:none;color:white; margin-left:3em"> Cancel </a>
    </div>

  </div>

</div>

{include file='../common/footer.tpl'}
