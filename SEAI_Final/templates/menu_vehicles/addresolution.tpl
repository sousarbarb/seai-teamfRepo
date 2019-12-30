{include file='../common/header.tpl'}

<body>
<a class="logbutton button4 submitAsBtn" href='{$BASE_URL}pages/vehicle_pag.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
  <h2 class="display-4 text-white">ADD RESOLUTION</h2>
  <div class="separator"></div>

  {if (isset($success_messages))}
    {foreach $success_messages as $success}
      <div class="msg_success"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$success}</div>
    {/foreach}
  {/if}
  {if (isset($error_messages))}
    {foreach $error_messages as $error}
      <div class="msg_error"> <a class="msg_close" href="#" style="text-decoration:none;">&#215;</a>{$error}</div>
    {/foreach}
  {/if}

    <form class="formulario" id="form_provider" method="post" action="../actions/addsensor.php" enctype="multipart/form-data">
    <table class="tab">
    <tr><td class="gg">
    Value: </td><td class="register"><input type="text" name="value"
              value="{if (isset($form_values))}{$form_values.value}{/if}">
    </tr>
    <tr><td class="gg">
    Vel sampling: </td><td class="register"><input type="text" name="vel_sampling"
              value="{if (isset($form_values))}{$form_values.vel_sampling}{/if}">
    </tr>
    <tr><td class="gg">
    Consumption: </td><td class="register"><input type="text" name="consumption"
              value="{if (isset($form_values))}{$form_values.consumption}{/if}">
    </tr>
    <tr><td class="gg">
    Swath: </td><td class="register"><input type="text" name="swath"
              value="{if (isset($form_values))}{$form_values.swath}{/if}">
    </tr>
    <tr><td class="gg">
    Cost: </td><td class="register"><input type="text" name="cost"
              value="{if (isset($form_values))}{$form_values.cost}{/if}">
    </tr>
    <tr><td>
    Comments: </td><td class="register"><input type="text" name="comments"
              value="{if (isset($form_values))}{$form_values.comments}{/if}">
    </tr>
    
    <input type="hidden" name="vehicle_id" value="{$vehicle_id}">

    <tr><td>
    <input type="hidden" name="selectform" value="provider">
    <input class="btn btn-info" type="submit" name="submit" value="Add">
    </td></tr>
    </table>
    </form>


</div>

{include file='../common/footer.tpl'}
