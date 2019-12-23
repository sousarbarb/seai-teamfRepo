{include file= 'common/header.tpl'}

<section id="new">
  <!-- Creates new vehicle -->
  <article>
    <header>New vehicle</header>
    <form action="{$BASE_URL}actions/newVehicle.php" method="POST">
      <p>Service Provider Username:</p>
      <datalist id="vehicle_serviceproviders">
      {foreach $service_providers as $service_provider}
        <option value="{$service_provider['user_id']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['vehicle_service_username'])}
        <input  type="text"
                name="vehicle_service_username"
                placeholder="select or type here..."
                list = "vehicle_serviceproviders"
                value="{$FORM_VALUES['vehicle_service_username']}">
      {else}
        <input  type="text"
                name="vehicle_service_username"
                placeholder="select or type here..."
                list = "vehicle_serviceproviders">
      {/if}
      <br>

      <p>Name of vehicle:</p>
      {if isset($FORM_VALUES['vehicle_name'])}
        <input  type="text"
                name="vehicle_name"
                placeholder="type here..."
                value="{$FORM_VALUES['vehicle_name']}">
      {else}
        <input  type="text"
                name="vehicle_name"
                placeholder="type here...">
      {/if}
      <br>

      <p>Localization:</p>
      {if isset($FORM_VALUES['vehicle_localization'])}
        <input  type="text"
                name="vehicle_localization"
                placeholder="41.252314 50.102957 (lon. lat.)..."
                value="{$FORM_VALUES['vehicle_localization']}">
      {else}
        <input  type="text"
                name="vehicle_localization"
                placeholder="41.252314 50.102957 (lon. lat.)...">
      {/if}
      <br>

      <p>Comments:</p>
      {if isset($FORM_VALUES['vehicle_comments'])}
        <textarea type="text"
                  name="vehicle_comments">
                    {$FORM_VALUES['vehicle_comments']}</textarea>
      {else}
        <textarea type="text"
                  name="vehicle_comments"
                  placeholder="type here..."></textarea>
      {/if}
      <br>

      <p>Public:</p>
      <input type="radio" name="vehicle_public" value="y"> Yes 
      <input type="radio" name="vehicle_public" value="n"> No 
      <br>
      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new specification -->
  <article>
    <header>New specification</header>
    <form action="{$BASE_URL}actions/newSpec.php" method="POST">
      <p>Vehicle name:</p>
      <datalist id="spec_vehiclesnames">
      {foreach $vehicles_names as $vehicle_name}
        <option value="{$vehicle_name['vehicle_name']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['spec_vehiclename'])}
        <input  type="text"
                name="spec_vehiclename"
                placeholder="select or type here..."
                list = "spec_vehiclesnames"
                value="{$FORM_VALUES['spec_vehiclename']}">
      {else}
        <input  type="text"
                name="spec_vehiclename"
                placeholder="select or type here..."
                list = "spec_vehiclesnames">
      {/if}
      <br>

      <p>Specification type:</p>
      <datalist id="spec_specstypes">
      {foreach $specification_types as $specification_type}
        <option value="{$specification_type['specification_type']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['spec_spectype'])}
        <input  type="text"
                name="spec_spectype"
                placeholder="select or type here..."
                list = "spec_specstypes"
                value="{$FORM_VALUES['spec_spectype']}">
      {else}
        <input  type="text"
                name="spec_spectype"
                placeholder="select or type here..."
                list = "spec_specstypes">
      {/if}
      <br>

      <p>Minimum value:</p>
      {if isset($FORM_VALUES['spec_minvalue'])}
        <input  type="text"
                name="spec_minvalue"
                placeholder="VALUE (UNITS)..."
                value="{$FORM_VALUES['spec_minvalue']}">
      {else}
        <input  type="text"
                name="spec_minvalue"
                placeholder="VALUE (UNITS)...">
      {/if}
      <br>

      <p>Maximum value:</p>
      {if isset($FORM_VALUES['spec_maxvalue'])}
        <input  type="text"
                name="spec_maxvalue"
                placeholder="VALUE (UNITS)..."
                value="{$FORM_VALUES['spec_maxvalue']}">
      {else}
        <input  type="text"
                name="spec_maxvalue"
                placeholder="VALUE (UNITS)...">
      {/if}
      <br>

      <p>Comments:</p>
      {if isset($FORM_VALUES['spec_comments'])}
        <textarea type="text"
                  name="spec_comments">
                    {$FORM_VALUES['spec_comments']}</textarea>
      {else}
        <textarea type="text"
                  name="spec_comments"
                  placeholder="type here..."></textarea>
      {/if}
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new sensor -->
  <article>
    <header>New sensor</header>
    <form action="{$BASE_URL}actions/newSensor.php" method="POST">
      <p>Vehicle name:</p>
      <datalist id="sensor_vehiclesnames">
      {foreach $vehicles_names as $vehicle_name}
        <option value="{$vehicle_name['vehicle_name']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['sensor_vehiclename'])}
        <input  type="text"
                name="sensor_vehiclename"
                placeholder="select or type here..."
                list = "sensor_vehiclesnames"
                value="{$FORM_VALUES['sensor_vehiclename']}">
      {else}
        <input  type="text"
                name="sensor_vehiclename"
                placeholder="select or type here..."
                list = "sensor_vehiclesnames">
      {/if}
      <br>

      <p>Sensor name:</p>
      {if isset($FORM_VALUES['sensor_sensorname'])}
        <input  type="text"
                name="sensor_sensorname"
                placeholder="type here..."
                value="{$FORM_VALUES['sensor_sensorname']}">
      {else}
        <input  type="text"
                name="sensor_sensorname"
                placeholder="type here...">
      {/if}
      <br>

      <p>Sensor type:</p>
      <datalist id="sensor_sensortypes">
      {foreach $sensor_types as $sensor_type}
        <option value="{$sensor_type['sensor_type']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['sensor_sensortype'])}
        <input  type="text"
                name="sensor_sensortype"
                placeholder="select or type here..."
                list = "sensor_sensortypes"
                value="{$FORM_VALUES['sensor_sensortype']}">
      {else}
        <input  type="text"
                name="sensor_sensortype"
                placeholder="select or type here..."
                list = "sensor_sensortypes">
      {/if}
      <br>

      <p>Comments:</p>
      {if isset($FORM_VALUES['sensor_comments'])}
        <textarea type="text"
                  name="sensor_comments">
                    {$FORM_VALUES['sensor_comments']}</textarea>
      {else}
        <textarea type="text"
                  name="sensor_comments"
                  placeholder="type here..."></textarea>
      {/if}
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new resolution -->
  <article>
    <header>New resolution</header>
    <form action="{$BASE_URL}actions/newResolution.php" method="POST">
      <p>Sensor Id:</p>
      <datalist id="res_sensorsids">
      {foreach $sensors_ids as $sensor_id}
        <option value="{$sensor_id['id']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['res_sensorid'])}
        <input  type="text"
                name="res_sensorid"
                placeholder="select or type here..."
                list = "res_sensorsids"
                value="{$FORM_VALUES['res_sensorid']}">
      {else}
        <input  type="text"
                name="res_sensorid"
                placeholder="select or type here..."
                list = "res_sensorsids">
      {/if}
      <br>

      <p>Resolution:</p>
      {if isset($FORM_VALUES['res_resolution'])}
        <input  type="text"
                name="res_resolution"
                placeholder="VALUE (UNITS)..."
                value="{$FORM_VALUES['res_resolution']}">
      {else}
        <input  type="text"
                name="res_resolution"
                placeholder="VALUE (UNITS)...">
      {/if}
      <br>

      <p>Nominal Velocity (DISTANCE / TIME):</p>
      {if isset($FORM_VALUES['res_velocity'])}
        <input  type="text"
                name="res_velocity"
                placeholder="VALUE (UNITS)..."
                value="{$FORM_VALUES['res_velocity']}">
      {else}
        <input  type="text"
                name="res_velocity"
                placeholder="VALUE (UNITS)...">
      {/if}
      <br>

      <p>Impact on vehicle battery (ENERGY / TIME):</p>
      {if isset($FORM_VALUES['res_consumption'])}
        <input  type="text"
                name="res_consumption"
                placeholder="VALUE (UNITS)..."
                value="{$FORM_VALUES['res_consumption']}">
      {else}
        <input  type="text"
                name="res_consumption"
                placeholder="VALUE (UNITS)...">
      {/if}
      <br>

      <p>Sensor swath range (meters):</p>
      {if isset($FORM_VALUES['res_swath'])}
        <input  type="text"
                name="res_swath"
                placeholder="12312.41231..."
                value="{$FORM_VALUES['res_swath']}">
      {else}
        <input  type="text"
                name="res_swath"
                placeholder="12312.41231...">
      {/if}
      <br>

      <p>Cost (€/h):</p>
      {if isset($FORM_VALUES['res_cost'])}
        <input  type="text"
                name="res_cost"
                placeholder="12341.4142..."
                value="{$FORM_VALUES['res_cost']}">
      {else}
        <input  type="text"
                name="res_cost"
                placeholder="12341.4142...">
      {/if}
      <br>

      <p>Comments:</p>
      {if isset($FORM_VALUES['res_comments'])}
        <textarea type="text"
                  name="res_comments">
                    {$FORM_VALUES['res_comments']}</textarea>
      {else}
        <textarea type="text"
                  name="res_comments"
                  placeholder="type here..."></textarea>
      {/if}
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>

  <!-- Creates new resolution -->
  <article>
    <header>New communication</header>
    <form action="{$BASE_URL}actions/newCommun.php" method="POST">
      <p>Type communication:</p>
      <datalist id="commun_types">
      {foreach $communication_types as $communication_type}
        <option value="{$communication_type['communication_type']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['commun_type'])}
        <input  type="text"
                name="commun_type"
                placeholder="select or type here..."
                list = "commun_types"
                value="{$FORM_VALUES['commun_type']}">
      {else}
        <input  type="text"
                name="commun_type"
                placeholder="select or type here..."
                list = "commun_types">
      {/if}
      <br>

      <p>Vehicle name:</p>
      <datalist id="commun_vehiclesnames">
      {foreach $vehicles_names as $vehicle_name}
        <option value="{$vehicle_name['vehicle_name']}">
      {/foreach}
      </datalist>
      {if isset($FORM_VALUES['commun_vehiclename'])}
        <input  type="text"
                name="commun_vehiclename"
                placeholder="select or type here..."
                list = "commun_vehiclesnames"
                value="{$FORM_VALUES['commun_vehiclename']}">
      {else}
        <input  type="text"
                name="commun_vehiclename"
                placeholder="select or type here..."
                list = "commun_vehiclesnames">
      {/if}
      <br>

      <input type="submit" value="Submit">
      <input type="reset"  value="Reset">
    </form>
  </article>
</section>


{include file= 'common/footer.tpl'}