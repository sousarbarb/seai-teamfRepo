{include file= 'common/header.tpl'}

<aside>
  <header>Search Filters</header>
  <form action="{$BASE_URL}pages/search.php" method="post">

    <h1>Service Providers:</h1>

    {foreach $service_providers as $entity_name}
      <input  type="checkbox"
              name="service_providers_array[]""
              value="{$entity_name['entity_name']}"
              {if !empty($service_providers_selected)}
                {foreach $service_providers_selected as $selected}
                  {if $entity_name['entity_name'] == $selected}
                    checked
                  {/if}
                {/foreach}
              {/if}
              >
      <label for="{$entity_name['entity_name']}">
        {$entity_name['entity_name']}
      </label><br>
    {/foreach}

    <h1>Specifications:</h1>

    {foreach $specifications as $specification_type}
      <input  type="checkbox"
              name="specifications_array[]""
              value="{$specification_type['specification_type']}"
              {if !empty($specifications_selected)}
                {foreach $specifications_selected as $selected}
                  {if $specification_type['specification_type'] == $selected}
                    checked
                  {/if}
                {/foreach}
              {/if}
              >
      <label for="{$specification_type['specification_type']}">
        {$specification_type['specification_type']}
      </label><br>
    {/foreach}

    <h1>Communications:</h1>

    {foreach $communications as $communication_type}
      <input  type="checkbox"
              name="communications_array[]""
              value="{$communication_type['communication_type']}"
              {if !empty($communications_selected)}
                {foreach $communications_selected as $selected}
                  {if $communication_type['communication_type'] == $selected}
                    checked
                  {/if}
                {/foreach}
              {/if}
              >
      <label for="{$communication_type['communication_type']}">
        {$communication_type['communication_type']}
      </label><br>
    {/foreach}

    <h1>Type of Sensors:</h1>

    {foreach $sensors as $sensor_type}
      <input  type="checkbox"
              name="sensors_array[]""
              value="{$sensor_type['sensor_type']}"
              {if !empty($sensors_selected)}
                {foreach $sensors_selected as $selected}
                  {if $sensor_type['sensor_type'] == $selected}
                    checked
                  {/if}
                {/foreach}
              {/if}
              >
      <label for="{$sensor_type['sensor_type']}">
        {$sensor_type['sensor_type']}
      </label><br>
    {/foreach}

    <h1>Resolutions:</h1>

    {foreach $resolutions as $res_value}
      <input  type="checkbox"
              name="resolutions_array[]""
              value="{$res_value['value']}"
              {if !empty($resolutions_selected)}
                {foreach $resolutions_selected as $selected}
                  {if $res_value['value'] == $selected}
                    checked
                  {/if}
                {/foreach}
              {/if}
              >
      <label for="{$res_value['value']}">
        {$res_value['value']}
      </label><br>
    {/foreach}

    <input type="submit" value="Submit">
  </form>
</aside>

{include file= 'common/footer.tpl'}