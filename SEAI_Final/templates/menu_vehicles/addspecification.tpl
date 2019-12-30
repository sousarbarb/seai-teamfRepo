{include file='../common/header.tpl'}

<body>
<a class="logbutton button4 submitAsBtn" href='{$BASE_URL}pages/vehicle_pag.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
  <h2 class="display-4 text-white">ADD SPECIFICATION</h2>
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

    <form class="formulario" id="form_provider" method="post" action="../actions/addspecification.php" enctype="multipart/form-data">
    <table class="tab">
    <tr><td class="gg">
    Type: </td><td class="register"><input type="text" name="type"
              value="{if (isset($form_values))}{$form_values.type}{/if}">
    </tr>
    <tr><td>
    Value min: </td><td class="register"><input type="text" name="valuemin"
              value="{if (isset($form_values))}{$form_values.valuemin}{/if}">
    </tr>
    <tr><td>
    Value max: </td><td class="register"><input type="text" name="valuemax"
              value="{if (isset($form_values))}{$form_values.valuemax}{/if}">
    </tr>
    <tr><td>
    Comments: </td><td class="register"><input type="text" name="comments"
              value="{if (isset($form_values))}{$form_values.comments}{/if}">
    </tr>
    
    <input type="hidden" name="vehicle_name" value="{$vehicle_name}">

    <tr><td>
    <input type="hidden" name="selectform" value="provider">
    <input class="btn btn-info" type="submit" name="submit" value="Add">
    </td></tr>
    </table>
    </form>


</div>

{include file='../common/footer.tpl'}
