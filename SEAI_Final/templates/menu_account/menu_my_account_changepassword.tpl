{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY ACCOUNT</h2>
  <p class="lead text-white mb-0">Manage account information</p>
  <div class="separator"></div>
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}
  <div class="myacc">
  <form method="post" action="../actions/my_account_changepassword.php">
    <div class="text-white">
      <label class="myaccountlabel">Username</label> <label class="lead">{$login}</label>
      <br>
      <label class="myaccountlabel">Old Password</label>
      <input type="password" name="old_password" class="lead"
            placeholder="Enter the old password" value="">
      <br>
      <label class="myaccountlabel">New Password</label>
      <input type="password" name="new_password" class="lead"
            placeholder="Enter the new password" value="">
      <br>
      <label class="myaccountlabel">Confirm New Password</label>
      <input type="password" name="confirm_password" class="lead"
            placeholder="Confirm the new password" value="">
      <br>
      <br>

      <input type="hidden" name="username" value="{$login}">

      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Confirm Changes" />
      <a href="{$BASE_URL}pages/index.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
