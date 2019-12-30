{include file='common/header.tpl'}
{include file='common/navbar_logged_in.tpl'}
{include file='common/logout.tpl'}

<div class="menusLogin p-5">
<div class="vehicle_text">


	<h2 class="display-4 text-white">{$generalInfo['vehicle_name']}</h2>
	<p class="lead text-white mb-0">Information about vehicle</p>
	<div class="separator">
	</div>
	{if $extinct}
    <p>This vehicle doesn't exist.</p>
  {else}
  {if $notpublic}
    <p>Vehicle information not publicly available.</p>
  {else}

	<article>
		<p><label class="vehicle_info_label">Entity Name</label>{$generalInfo['provider_username']}</p>
		<p><label class="vehicle_info_label">Localization</label>{$generalInfo['vehicle_localization']}</p>
		<p><label class="vehicle_info_label">Comments</label> {$generalInfo['vehicle_comments']}</p>
		{if $sameprovider}
			<p><label class="vehicle_info_label">Approval</label> {if $generalInfo['vehicle_approval']}Yes{else}No{/if}</p>
		  <p><label class="vehicle_info_label">Public</label> {if $generalInfo['vehicle_public']}Yes{else}No{/if}</p>
    {/if}
	</article>

	<article>
		<table class="vehicle_titulo_table">
		<tr>
			<td class="vehicle_titulo">Specifications</td>
			{if $sameprovider}
			<td>
			<form id="{$generalInfo['vehicle_name']}_addspecification" method="post" action="{$BASE_URL}pages/addspecification.php">
				<input type="hidden" name="vehicle_name" value="$generalInfo['vehicle_name']">
			</form>
			<a href="#" onclick="document.getElementById('{$generalInfo['vehicle_name']}_addspecification').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Specification</a>
	  	</td>
			{/if}
		</tr>
		</table>

		{if count($specifications) <= 0}
			<p class="vehicle_res">No results found</p>
		{else}
			<p class="vehicle_res">Numbers of results found: {count($specifications)}</p>
			<table class="vehicles_table" style="margin:0em 0em 2em 0em">
				<tr>
					<th>Type</th>
					<th>Value min</th>
					<th>Value max</th>
					<th>Comments</th>
					{if $sameprovider}
					<th>Actions</th>
					{/if}
				</tr>
				{foreach $specifications as $specification}
				<tr>
					<td>{$specification['spec_type']}</td>
					<td>{$specification['spec_valuemin']}</td>
					<td>{$specification['spec_valuemax']}</td>
					<td>{$specification['spec_comments']}</td>
					{if $sameprovider}
					<td>
						<form id="{$specification['spec_id']}_edit" method="post" action="{$BASE_URL}pages/editspecification.php">
	            <input type="hidden" name="spec_id" value="{$specification['spec_id']}">
							<input type="hidden" name="spec_valuemin" value="{$specification['spec_valuemin']}">
							<input type="hidden" name="spec_valuemax" value="{$specification['spec_valuemax']}">
							<input type="hidden" name="spec_comments" value="{$specification['spec_comments']}">
	          </form>
						<form id="{$specification['spec_id']}_delete" method="post" action="{$BASE_URL}pages/deletespecification.php">
	            <input type="hidden" name="spec_id" value="{$specification['spec_id']}">
	          </form>
						<a href="#" onclick="document.getElementById('{$specification['spec_id']}_edit').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Edit Specification</a>
						<a href="#" onclick="document.getElementById('{$specification['spec_id']}_delete').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Specification</a>
					</td>
					{/if}
				</tr>
				{/foreach}
			</table>
		{/if}
	</article>

	<article>
		<table class="vehicle_titulo_table">
		<tr>
			<td class="vehicle_titulo">Communications</td>
			{if $sameprovider}
			<td>
				<form id="{$generalInfo['vehicle_name']}_addcommunication" method="post" action="{$BASE_URL}pages/addcommunication.php">
					<input type="hidden" name="vehicle_name" value="$generalInfo['vehicle_name']">
				</form>
				<a href="#" onclick="document.getElementById('{$generalInfo['vehicle_name']}_addcommunication').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Communication</a>
	  	</td>
			{/if}
		</tr>
		</table>
		{if count($communications) <= 0}
			<p class="vehicle_res">No results found</p>
		{else}
			<p class="vehicle_res">Numbers of results found: {count($communications)}</p>
			{foreach $communications as $communication}
			<table>
				<tr>
					<td><label class="vehicle_info_label">Type: </label>{$communication['communication_type']}</td>
					{if $sameprovider}
					<td>
						<form id="{$communication['communication_id']}_delete" method="post" action="{$BASE_URL}pages/deletecommunication.php">
							<input type="hidden" name="communication_id" value="{$communication['communication_id']}">
						</form>
						<a href="#" onclick="document.getElementById('{$communication['communication_id']}_delete').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Communication</a>
					</td>
					{/if}
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Type: </label>{$sensor['sensor_type']}</td>
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Comments: </label>{$sensor['sensor_comments']}</td>
				</tr>
			</table>



				<ul>
					<li>{$communication['communication_type']}</li>
				</ul>
			{/foreach}
		{/if}
	</article>

	<article>
		<table class="vehicle_titulo_table">
		<tr>
			<td class="vehicle_titulo">Sensors</td>
			{if $sameprovider}
			<td>
				<form id="{$generalInfo['vehicle_name']}_addsensor" method="post" action="{$BASE_URL}pages/addsensor.php">
					<input type="hidden" name="vehicle_name" value="$generalInfo['vehicle_name']">
				</form>
				<a href="#" onclick="document.getElementById('{$generalInfo['vehicle_name']}_addsensor').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Sensor</a>
	  	</td>
			{/if}
		</tr>
		</table>
		{if count($sensors) <= 0}
			<p class="vehicle_res">No results found</p>
		{else}
			<p class="vehicle_res">Numbers of results found: {count($sensors)}</p>
			{foreach $sensors as $sensor}
			<table>
				<tr>
					<td><label class="vehicle_info_label">Name: </label>{$sensor['sensor_name']}</td>
					{if $sameprovider}
					<td>
						<form id="{$sensor['sensor_id']}_edit" method="post" action="{$BASE_URL}pages/editsensor.php">
							<input type="hidden" name="sensor_id" value="{$sensor['sensor_id']}">
							<input type="hidden" name="sensor_type" value="{$sensor['sensor_type']}">
							<input type="hidden" name="sensor_name" value="{$sensor['sensor_name']}">
							<input type="hidden" name="sensor_comments" value="{$sensor['sensor_comments']}">
						</form>
						<form id="{$sensor['sensor_id']}_delete" method="post" action="{$BASE_URL}pages/deletesensor.php">
							<input type="hidden" name="sensor_id" value="{$sensor['sensor_id']}">
						</form>
						<a href="#" onclick="document.getElementById('{$sensor['sensor_id']}_edit').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Edit Sensor</a>
						<a href="#" onclick="document.getElementById('{$sensor['sensor_id']}_delete').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Sensor</a>
					</td>
					{/if}
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Type: </label>{$sensor['sensor_type']}</td>
				</tr>
				<tr>
					<td><label class="vehicle_info_label">Comments: </label>{$sensor['sensor_comments']}</td>
				</tr>
			</table>

			{$numresults = 0}

			<div style="margin:0em 0em 0em 2em">
			{foreach $resolutions_array as $resolutions}
				{foreach $resolutions as $resolution}
					{if $resolution['res_sensorid'] == $sensor['sensor_id']}
						{$numresults = $numresults + 1}
					{/if}
				{/foreach}
			{/foreach}
			<table class="vehicle_titulo_table">
			<tr>
				<td class="vehicle_titulo">Resolutions</td>
				{if $sameprovider}
				<td>
					<form id="{$sensor['sensor_id']}_add" method="post" action="{$BASE_URL}pages/addresolution.php">
						<input type="hidden" name="sensor_id" value="{$sensor['sensor_id']}">
					</form>
					<a href="#" onclick="document.getElementById('{$sensor['sensor_id']}_add').submit()" class= "button4 submitAsBtn button_provider_hist2" style="color:white;width: auto;">Add New Resolution</a>
		  	</td>
				{/if}
			</tr>
			</table>
			{if $numresults <= 0}
				<p class="vehicle_res">No results found<p>
			{else}
				<p class="vehicle_res">Numbers of results found: {$numresults}</p>
				<table class="vehicles_table" style="margin:0em 0em 2em 0em">
					<tr>
						<th>Value</th>
						<th>Consumption</th>
						<th>Velocity</th>
						<th>Cost</th>
						<th>Swath</th>
						<th>Comments</th>
						{if $sameprovider}
						<th>Actions</th>
						{/if}
					</tr>
					{foreach $resolutions_array as $resolutions}
						{foreach $resolutions as $resolution}
							{if $resolution['res_sensorid'] == $sensor['sensor_id']}
								<tr>
									<td>{$resolution['res_value']}</td>
									<td>{$resolution['res_consumption']}</td>
									<td>{$resolution['res_velocity']}</td>
									<td>{$resolution['res_cost']}</td>
									<td>{$resolution['res_swath']}</td>
									<td>{$resolution['res_comments']}</td>
									{if $sameprovider}
									<td>
										<form id="{$resolution['res_id']}_edit" method="post" action="{$BASE_URL}pages/editresolution.php">
					            <input type="hidden" name="res_id" value="{$resolution['res_id']}">
											<input type="hidden" name="res_value" value="{$resolution['res_value']}">
											<input type="hidden" name="res_consumption" value="{$resolution['res_consumption']}">
											<input type="hidden" name="res_velocity" value="{$resolution['res_velocity']}">
											<input type="hidden" name="res_cost" value="{$resolution['res_cost']}">
											<input type="hidden" name="res_swath" value="{$resolution['res_swath']}">
											<input type="hidden" name="res_comments" value="{$resolution['res_comments']}">
					          </form>
										<form id="{$resolution['res_id']}_delete" method="post" action="{$BASE_URL}pages/deleteresolution.php">
					            <input type="hidden" name="res_id" value="{$resolution['res_id']}">
					          </form>
										<a href="#" onclick="document.getElementById('{$resolution['res_id']}_edit').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Edit Resolution</a>
										<a href="#" onclick="document.getElementById('{$resolution['res_id']}_delete').submit()" class= "button4 submitAsBtn button_provider_hist3" style="color:white;width: auto;">Delete Resolution</a>
									</td>
									{/if}
								</tr>
							{/if}
						{/foreach}
					{/foreach}
				</table>
			{/if}
		</div>
		{/foreach}
	{/if}
</article>
{/if}
{/if}
<br><br><br>
</div>
</div>

{include file='common/footer-short.tpl'}