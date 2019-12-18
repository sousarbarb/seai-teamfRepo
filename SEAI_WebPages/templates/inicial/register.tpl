{include file='../common/header.tpl'}

<body>
<a class="logbutton button4 submitAsBtn" href='{$BASE_URL}pages/index.php' style="width:auto;text-decoration:none;color:white;"> Go Back </a>
<div class="page-content p-5" id="content">
  <h2 class="display-4 text-white">REGISTRATION</h2>
  <p class="lead text-white mb-0">Select the type of user and fill the form to register on this platform</p>
  <div class="separator"></div>
<div class="service">
  <a href="#form_provider" onclick="return false;" class="button4left buttonsRegSelect" style="text-decoration:none;color:white"> Service Provider </a>
  <a href="#form_client" onclick="return false;" class="button4right buttonsRegSelect" style="text-decoration:none;color:white"> Service Client </a>
</div>

<div class="formulario">
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
<form class="form_register" id="form_provider" method="post" action="../actions/register_action.php" enctype="multipart/form-data">
<table class="tab">
<tr><td class="gg">
Entity Name: </td><td class="register"><input type="text" name="entity_name"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.entity_name}{/if}">
</tr>
<tr><td>
Address: </td><td class="register"><input type="text" name="entity_address"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.entity_address}{/if}">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="entity_email"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.entity_email}{/if}">
</tr>
<tr><td>
Phone Number: </td><td class="register"><input type="text" name="entity_number"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.entity_number}{/if}">
</tr>
<tr class="space_under"><td>
Image: </td><td class="register"><input type="file" name="entity_image" id="entity_image" required></td>
</tr>

<tr><td>
Official Representative: </td><td class="register"><input type="text" name="name"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.name}{/if}">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="email"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.email}{/if}">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="number"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.number}{/if}">
</tr>

<tr><td>
Username: </td><td class="register"><input type="text" name="user"
          value="{if (isset($form_values) && ($form_values.selectform=='provider'))}{$form_values.user}{/if}">
</tr>
<tr><td>
Password: </td><td class="register"><input type='password' name="password">
</tr>
<tr><td>
Confirm Password: </td><td class="register"><input type='password' name="password2">
</tr>
<tr><td>
<input type="hidden" name="selectform" value="provider">
<input class="btn btn-info" type="submit" name="submit" value="Register">
</td></tr>
</table>
</form>


<form class="form_register" id="form_client" method="post" action="../actions/register_action.php">
<table class="tab">
<tr><td class="gg">
Name: </td><td class="register"><input type="text" name="name"
          value="{if (isset($form_values) && ($form_values.selectform=='client'))}{$form_values.name}{/if}">
</tr>
<tr><td>
E-mail: </td><td class="register"><input type="text" name="email"
          value="{if (isset($form_values) && ($form_values.selectform=='client'))}{$form_values.email}{/if}">
</tr>
<tr class="space_under"><td>
Phone Number: </td><td class="register"><input type="text" name="number"
          value="{if (isset($form_values) && ($form_values.selectform=='client'))}{$form_values.number}{/if}">
</tr>

<tr><td>
Username: </td><td class="register"><input type="text" name="user"
          value="{if (isset($form_values) && ($form_values.selectform=='client'))}{$form_values.user}{/if}">
</tr>
<tr><td>
Password: </td><td class="register"><input type='password' name="password">
</tr>
<tr><td>
Confirm Password: </td><td class="register"><input type='password' name="password2">
</tr>
<tr><td>
<input type="hidden" name="selectform" value="client">
<input class="btn btn-info" type="submit" name="submit" value="Register">
</td></tr>
</table>
</form>



</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>




</div>

{include file='../common/footer.tpl'}
