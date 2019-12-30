{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">New Password</h2>
  <p class="lead text-white mb-0">Reset password information</p>
  <div class="separator"></div>
  <div class="myacc">
  <form method="post" action="../actions/fpass_changepassword.php">
    <div class="text-white">
      <label class="myaccountlabel">New Password</label>
      <input type="password" name="new_password" class="lead"
            placeholder="Enter the new password" value="">
      <br>
      <label class="myaccountlabel">Confirm New Password</label>
      <input type="password" name="confirm_password" class="lead"
            placeholder="Confirm the new password" value="">
      <br>
      <br>

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="{$BASE_URL}pages/index.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
