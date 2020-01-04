{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}
<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request - Existent Data</h2>
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
	<div class="grid-vehicles">
      <div class="text-white">
	<form action="{$BASE_URL}actions/manage_request.php" name="league" method="post"><input id ="rid" name="rid" type="hidden"/>
	<table class='table_pd' id="foo">
			<tr>
			<th style="text-align: center">Area covered</th>
			<th style="text-align: center">Service Provider</th>
			<th style="text-align: center">Date</th>
			<th style="text-align: center">Price</th>
			<th style="text-align: center">Price per square meter</th>
			<th></th>
			<th></th>
			</tr>
			{foreach $requests as $request}
				<tr id={$request.request_id}>
				<td>{number_format ($request.area_ratio*100, 4)}%</td>
				<td>{$request.provider_name} ({$request.provider_username})</td>
				<td>{$request.data_date}</td><td>{$request.data_price}€</td>
				<td>{number_format ($request.price_area_ratio,5)}€/m</td>
				<td><button type="button" class ="clickMe button4 submitAsBtn button_provider_hist" onclick="doFunction(this);">See Details</button></td>
				<td><input type="radio" name="check" value="{$request.request_id},{$request.mission_id}"></td>
				</tr>
				<tr>
				<td class="info" colspan="6" >{$request.request_id}</td>
				</tr>
			{/foreach}
			</table>
			<input type="submit" name="back" class="comfirm" value="Go back to Map" >
			<input type="submit" name="Plan" class="comfirm" value="Plan new Mission" >
			<input type="submit" name="buy" class="comfirm" value="Buy Request" >
			</form>
</div>
	
			<div class="text-white vehicles_sideText">
			<label class="vehicle_filtro_lbl" style="font-size:25px; text-decoration: underline;">Filters</label><br>
			<form method="post" action="{$BASE_URL}pages/show_previous_data.php">
      <label class="vehicle_filtro_lbl">Sensors</label><br>
          {foreach $sensors as $sensor_type}
            <input  type="checkbox"
                    name="sensors_array[]"
                    id="sensors_filter"
                    value="{$sensor_type['sensor_type']}"
                    {if !empty($sensors_selected)}
                      {foreach $sensors_selected as $selected}
                        {if $sensor_type['sensor_type'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$sensor_type['sensor_type']}<br>
          {/foreach}
        <br>

        <label class="vehicle_filtro_lbl">Resolutions</label><br>
          {foreach $resolutions as $res_value}
            <input  type="checkbox"
                    name="resolutions_array[]"
                    id="resolutions_filter"
                    value="{$res_value['value']}"
                    {if !empty($resolutions_selected)}
                      {foreach $resolutions_selected as $selected}
                        {if $res_value['value'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$res_value['value']}<br>
          {/foreach}
        <br>
		<label class="vehicle_filtro_lbl">File types</label><br>
          {foreach $file_type as $tfile}
                 <input  type="checkbox"
                    name="file_type_array[]"
                    id="filetype_filter"
                    value="{$tfile['file_type']}"
                    {if !empty($file_type_selected)}
                      {foreach $file_type_selected as $selected}
                        {if $tfile['file_type'] == $selected}
                          checked
                        {/if}
                      {/foreach}
                    {/if}
                    >
            {$tfile['file_type']}<br>
          {/foreach}
        <br>
		  <input type="submit" name="vehicles_submit" style="display:none" value=""></input>
				</form>
			</div>

	<br>
	


<br>
</div>
</div>
</div>
</div>
