{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">NOTIFICATIONS</h2>
  <p class="lead text-white mb-0">Check the latest notifications received</p>
  <div class="separator"></div>

  {*get notifications from database*}
  {*$notifications = [
                      ["not_read","notificação 1 aaaaaaaaaaaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa asaksln adoakldnao dkl adoakd alkd "],
                      ["not_read","apodamdkapdmada"],
                      ["read","notificação 2"],
                      ["read","notificação 3"]
                    ]*}

  {foreach $notifications as $notification}
    <div class="notification_not_read">{$notification['notification_info']}
      <form method="post" action="{$BASE_URL}actions/notification_mark_read.php">
        <input type="hidden" name="notification_id" value="{$notification['notification_id']}">
        <input type="submit" class="button4 submitAsBtn notification_mark_read" value="Mark as read" style="width:auto;">
      </form>
      <label class="notification_date">{$notification['notification_date']}</label>
      <br>
    </div>
  {/foreach}

</div>

{include file='../common/footer-short.tpl'}
