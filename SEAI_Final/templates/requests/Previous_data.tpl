{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}
<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request - Existent Data</h2>
	<div class="separator"></div>
	<form action="{$BASE_URL}actions/manage_request.php" name="league" method="post"><input id ="rid" name="rid" type="hidden"/>
	<table class='pd_filt' id="fil">
		<td>
			<table class='table_pd' id="foo">
			<tr>
			<th style="text-align: center">Area covered</th>
			<th style="text-align: center">Service Provider</th>
			<th style="text-align: center">Date</th>
			<th style="text-align: center">Price</th>
			<th style="text-align: center">Price per square meter</th>
			<th></th>
			</tr>
			{foreach $requests as $request}
				<tr id={$request.request_id}>
				<td>{number_format ($request.area_ratio*100, 4)}%</td>
				<td>{$request.provider_name} ({$request.provider_username})</td>
				<td>{$request.data_date}</td><td>{$request.data_price}€</td>
				<td>{number_format ($request.price_area_ratio,5)}€/m</td>
				<td><button type="button" class ="clickMe button4 submitAsBtn button_provider_hist" onclick="doFunction(this);">See Details</button></td>
				</tr>
				<tr>
				<td class="info" colspan="6" >{$request.request_id}</td>
				</tr>
			{/foreach}
			</table>

		<td>
			<div class="text-white vehicles_sideText">
				{if ($acc_type=="provider")}
				&nbsp;&nbsp;
				<a href="{$BASE_URL}pages/menu_vehicles_add.php" class="button4 buttonsAcc" style="text-decoration:none;color:white;"> Add Vehicle </a>
				<br><br>
				{/if}
				<label class="vehicle_filtro_lbl">Filter type 1</label><br>
				<form method="get" action="{$BASE_URL}actions/vehicles_filter_public.php">
				  <input type="checkbox" name="map_filter1" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter1=='all'))}checked="checked"{/if}> All</input><br>
				  <input type="checkbox" name="map_filter1" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter1'))}checked="checked"{/if}> Filter1</input><br>
				  <input type="checkbox" name="map_filter1" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter2'))}checked="checked"{/if}> Filter2</input><br>
				  <input type="checkbox" name="map_filter1" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter3'))}checked="checked"{/if}> Filter3</input><br>
				  <input type="checkbox" name="map_filter1" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter4'))}checked="checked"{/if}> Filter4</input><br>
				  <input type="checkbox" name="map_filter1" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter1=='filter5'))}checked="checked"{/if}> Filter5</input><br>
				<br>
				<label class="vehicle_filtro_lbl">Filter type 2</label><br>
				  <input type="checkbox" name="map_filter2" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter2=='all'))}checked="checked"{/if}> All</input><br>
				  <input type="checkbox" name="map_filter2" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter1'))}checked="checked"{/if}> Filter1</input><br>
				  <input type="checkbox" name="map_filter2" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter2'))}checked="checked"{/if}> Filter2</input><br>
				  <input type="checkbox" name="map_filter2" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter3'))}checked="checked"{/if}> Filter3</input><br>
				  <input type="checkbox" name="map_filter2" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter4'))}checked="checked"{/if}> Filter4</input><br>
				  <input type="checkbox" name="map_filter2" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter2=='filter5'))}checked="checked"{/if}> Filter5</input><br>
				<br>
				<label class="vehicle_filtro_lbl">Filter type 3</label><br>
				  <input type="checkbox" name="map_filter3" value="all" {if (!(isset($form_values)) || ($form_values.vehicles_filter3=='all'))}checked="checked"{/if}> All</input><br>
				  <input type="checkbox" name="map_filter3" value="filter1" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter1'))}checked="checked"{/if}> Filter1</input><br>
				  <input type="checkbox" name="map_filter3" value="filter2" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter2'))}checked="checked"{/if}> Filter2</input><br>
				  <input type="checkbox" name="map_filter3" value="filter3" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter3'))}checked="checked"{/if}> Filter3</input><br>
				  <input type="checkbox" name="map_filter3" value="filter4" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter4'))}checked="checked"{/if}> Filter4</input><br>
				  <input type="checkbox" name="map_filter3" value="filter5" {if (isset($form_values) && ($form_values.vehicles_filter3=='filter5'))}checked="checked"{/if}> Filter5</input><br>
				  <input type="submit" name="map_submit" style="display:none" value=""></input>
				</form>
			</div>
		</td>

	</table>
	<br>
	<input type="submit" name="back" class="comfirm" value="Go back to Map" >
	<input type="submit" name="Plan" class="comfirm" value="Plan new Mission" >
	</form>
</td>

<br>
</div>
</div>
