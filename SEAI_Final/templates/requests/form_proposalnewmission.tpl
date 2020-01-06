{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<datalist id="vehicles">
  {foreach $vehicles as $vehicle}
    <option value="{$vehicle['vehicle_name']}">
  {/foreach}
</datalist>

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Proposal for a new mission</h2>
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
  <form method="post" action="../actions/action_proposalnewmission.php" enctype="multipart/form-data">

    <div class="text-white">

      <label class="myaccountlabel">Estimated Starting Time</label>
      <input type="date" name="starting_time" class="lead" style="line-height:1em" placeholder="Enter the starting time of the mission"
      value="{if isset($form_values)}{$form_values.starting_time}{/if}">
      <br>
      <label class="myaccountlabel">Estimated Finishing Time</label>
      <input type="date" name="finishing_time" class="lead" style="line-height:1em" placeholder="Enter the finishing time of the mission"
      value="{if isset($form_values)}{$form_values.finishing_time}{/if}">
      <br>
      <label class="myaccountlabel">Estimated Cost</label>
      <input type="text" name="cost" class="lead" placeholder="Enter the total cost of the mission"
      value="{if isset($form_values)}{$form_values.cost}{/if}">
      <br>
      <label class="myaccountlabel">Vehicle</label>
      <input type="text" list="vehicles" name="vehicle" class="lead" placeholder="Enter the vehicle that will be used in the mission"
      value="{if isset($form_values)}{$form_values.vehicle}{/if}">
      <br>
      <label class="myaccountlabel">Detailed information</label>
      <input type="file" name="real-file" id="real-file" hidden="hidden"/>
      <button type="button" id="custom-button" class="button4 button_provider_hist">Choose a File</button>
      <span id="custom-text" class="custom-text">No file chosen, yet</span>
      <br>
      <br>

      <input type="hidden" name="request_id"
      value="{if isset($form_values)}{$form_values.request_id}{else}{$request_id}{/if}">
      <input type="hidden" name="request_sensor_type"
      value="{if isset($form_values)}{$form_values.request_sensor_type}{else}{$request_sensor_type}{/if}">
      <input type="hidden" name="request_res_value"
      value="{if isset($form_values)}{$form_values.request_res_value}{else}{$request_res_value}{/if}">


      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Send Mission" />
      <a href="{$BASE_URL}pages/menu_requests_available.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
