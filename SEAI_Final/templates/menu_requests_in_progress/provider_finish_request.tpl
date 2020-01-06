{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<datalist id="file_types">
  {foreach $file_types as $file_type}
    <option value="{$file_type['file_type']}">
  {/foreach}
</datalist>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Send request info to client</h2>
  <div class="separator"></div>
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

  <div class="myacc">
  <form method="post" action="../actions/action_provider_finish_request.php" enctype="multipart/form-data">

    <div class="text-white">

      <label class="myaccountlabel" style="width:16em;">Cost</label>
      <input type="text" name="cost" class="lead" placeholder="Enter the total cost of the mission"
      value="{if isset($form_values)}{$form_values.cost}{/if}">
      <br>
      <label class="myaccountlabel" style="width:16em;">Link to request data download</label>
      <input type="text" name="link" class="lead" placeholder="Enter the data link"
      value="{if isset($form_values)}{$form_values.link}{/if}">
      <br>
      <label class="myaccountlabel" style="width:16em;">Select of write the data file type</label>
      <input type="text" list="file_types" name="file_type" class="lead" placeholder="Enter the file type"
      value="{if isset($form_values)}{$form_values.file_type}{/if}">
      <br>
      <br>

      <input type="hidden" name="mission_id"
      value="{if isset($form_values)}{$form_values.mission_id}{else}{$mission_id}{/if}">
      <input type="hidden" name="request_id"
      value="{if isset($form_values)}{$form_values.request_id}{else}{$request_id}{/if}">
      <input type="hidden" name="client_name"
      value="{if isset($form_values)}{$form_values.client_name}{else}{$client_name}{/if}">


      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Send Data" />
      <a href="{$BASE_URL}pages/menu_requests_progress.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
