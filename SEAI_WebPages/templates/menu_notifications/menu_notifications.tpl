{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">NOTIFICATIONS</h2>
  <p class="lead text-white mb-0">Check the latest notifications received</p>
  <div class="separator"></div>

  {*get notifications from database*}
  {$notifications = [
                      ["not_read","notificação nao lidaaaaaaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa aaaaa asaksln adoakldnao dkl adoakd alkd "],
                      ["read","notificação lida"]
                    ]}

  {foreach $notifications as $n => $notification}
    {if $notification[0]=='not_read'}
      <div class="notification_not_read">{$notification[1]} <a class="notification_mark_read" href="#"  style="text-decoration:none;">Mark as read</a></div>
    {else}
      <div class="notification_read">{$notification[1]} </div>
    {/if}
  {/foreach}


  {if (isset($success_messages))}
    {foreach $success_messages as $success}
      <div class="msg_success">{$success} <a class="msg_close" href="#"  style="text-decoration:none;">&#215;</a></div>
    {/foreach}
  {/if}
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}
</div>

{include file='../common/footer-short.tpl'}
