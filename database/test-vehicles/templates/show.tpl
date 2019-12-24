{include file= 'common/header.tpl'}

<div id="show">

<section id="vehicle_selection">
  <header>Select vehicle name to show details:</header>
  <form action="{$BASE_URL}pages/show.php" method="POST">
    <!-- This is only here to simulate a vehicle selected in vehicles search results -->
    <datalist id="vehiclesnames">
    {foreach $vehicles_names as $vehicle_name}
      <option value="{$vehicle_name['vehicle_name']}">
    {/foreach}
    </datalist>
    <input  type="text"
            name="vehicle_name"
            placeholder="select here..."
            list = "vehiclesnames"
          {if isset($vehicle_name_selected)}
            value="{$vehicle_name_selected}"
          {/if}>
    <input type="submit" value="Submit">
  </form>
</section>



{if isset($vehicle_name_selected)}

<section id="vehicle_info">
  <article>
    <header>General information:</header>
    <p>Vehicle ID: {$generalInfo['vehicle_id']}</p>
    <p>Name: {$generalInfo['vehicle_name']}</p>
    <p>Service Provider ID: {$generalInfo['provider_id']}</p>
    <p>Localization: {$generalInfo['vehicle_localization']}</p>
    <p>Comments: {$generalInfo['vehicle_comments']}</p>
    <p>Active: {if $generalInfo['vehicle_active']}YES{else}NO{/if}</p>
    <p>Approval: {if $generalInfo['vehicle_approval']}YES{else}NO{/if}</p>
    <p>Public: {if $generalInfo['vehicle_public']}YES{else}NO{/if}</p>
  </article>

  <article>
    <header>Specifications</header>
    {if count($specifications) <= 0}
      <p>No results founded<p>
    {else}
      <p>Numbers of results founded: {count($specifications)}</p>
      <table>
        <tr>
          <th>spec_id</th>
          <th>spec_type</th>
          <th>spec_valuemin</th>
          <th>spec_valuemax</th>
          <th>spec_active</th>
          <th>spec_comments</th>
        </tr>
      {foreach $specifications as $specification}
        <tr>
          <td>{$specification['spec_id']}</td>
          <td>{$specification['spec_type']}</td>
          <td>{$specification['spec_valuemin']}</td>
          <td>{$specification['spec_valuemax']}</td>
          <td>{$specification['spec_active']}</td>
          <td>{$specification['spec_comments']}</td>
        </tr>
      {/foreach}
      </table>
    {/if}
  </article>

  <article>
    <header>Communications</header>
    {if count($communications) <= 0}
      <p>No results founded<p>
    {else}
      <p>Numbers of results founded: {count($communications)}</p>
      <table>
        <tr>
          <th>communication_id</th>
          <th>communication_type</th>
        </tr>
      {foreach $communications as $communication}
        <tr>
          <td>{$communication['communication_id']}</td>
          <td>{$communication['communication_type']}</td>
        </tr>
      {/foreach}
      </table>
    {/if}
  </article>

  <article>
    <header>Sensors</header>
    {if count($sensors) <= 0}
      <p>No results founded<p>
    {else}
      <p>Numbers of results founded: {count($sensors)}</p>
      {foreach $sensors as $sensor}
      <div>
        <p>ID: {$sensor['sensor_id']}</p>
        <p>Type: {$sensor['sensor_type']}</p>
        <p>Name: {$sensor['sensor_name']}</p>
        <p>Active: {if $sensor['sensor_active']}YES{else}NO{/if}</p>
        <p>Comments: {$sensor['sensor_comments']}</p>

        {$numresults = 0}
        {foreach $resolutions_array as $resolutions}
          {foreach $resolutions as $resolution}
            {if $resolution['res_sensorid'] == $sensor['sensor_id']}
              {$numresults = $numresults + 1}
            {/if}
          {/foreach}
        {/foreach}

        {if $numresults <= 0}
          <p>No results founded<p>
        {else}
          <p>Numbers of results founded: {$numresults}</p>
          <table>
            <tr>
              <th>res_id</th>
              <th>res_value</th>
              <th>res_consumption</th>
              <th>res_velocity</th>
              <th>res_cost</th>
              <th>res_swath</th>
              <th>res_active</th>
              <th>res_comments</th>
            </tr>
            {foreach $resolutions_array as $resolutions}
            {foreach $resolutions as $resolution}
            {if $resolution['res_sensorid'] == $sensor['sensor_id']}
            <tr>
              <td>{$resolution['res_id']}</td>
              <td>{$resolution['res_value']}</td>
              <td>{$resolution['res_consumption']}</td>
              <td>{$resolution['res_velocity']}</td>
              <td>{$resolution['res_cost']}</td>
              <td>{$resolution['res_swath']}</td>
              <td>{$resolution['res_active']}</td>
              <td>{$resolution['res_comments']}</td>
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

</section>

</div>

{/if}

{include file= 'common/footer.tpl'}