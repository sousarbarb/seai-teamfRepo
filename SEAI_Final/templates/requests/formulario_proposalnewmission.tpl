{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Proposal for a new mission</h2>
  <div class="separator"></div>
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}

  <div class="myacc">
  <form method="post" action="../actions/???.php" enctype="multipart/form-data">

    <div class="text-white">

      <label class="myaccountlabel">Starting Time</label>
      <input type="datetime-local" name="starting_time" class="lead" placeholder="Enter the starting time of the mission"
      value="{if isset($form_values)}{$form_values.starting_time}{/if}">
      <br>
      <label class="myaccountlabel">Finishing Time</label>
      <input type="datetime-local" name="finishing_time" class="lead" placeholder="Enter the finishing time of the mission"
      value="{if isset($form_values)}{$form_values.finishing_time}{/if}">
      <br>
      <label class="myaccountlabel">Cost</label>
      <input type="number" name="cost" class="lead" placeholder="Enter the total cost of the mission"
      value="{if isset($form_values)}{$form_values.cost}{/if}">
      <br>
      <label class="myaccountlabel">Vehicle</label>
      <input type="text" name="vehicle" class="lead" placeholder="Enter the vehicle that will be used in the mission"
      value="{if isset($form_values)}{$form_values.vehicle}{/if}">
      <br>
      <label class="myaccountlabel">Detailed information</label>
      <input type="file" name="newmission_file" id="newmission_file" hidden="hidden"/>
      <button type="button" id="newmission_button" class="button4 button_provider_hist">Choose a File</button>
      <span id="newmission_txt" class="newmission_txt">No file chosen, yet</span>
      <br>
      <br>



      <input type="submit" name="submit" class= "button4 buttonsAcc" value="Send Mission" />
      <a href="{$BASE_URL}pages/???.php" class="button4 buttonsAcc" style="text-decoration:none;color:white"> Cancel </a>
    </div>
  </form>
  </div>
  </div>

</div>

{include file='../common/footer-short.tpl'}
