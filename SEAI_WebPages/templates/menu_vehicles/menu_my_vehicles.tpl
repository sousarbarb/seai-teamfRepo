{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

{if ($acc_type!="provider")}
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Error</h2>
  <p class="lead text-white mb-0">You don't have permission to see this page</p>
  <br><br><br><br><br><br><br><br><br><br><br><br>
</div>
{else}
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY VEHICLES</h2>
  <p class="lead text-white mb-0">Infomation about my institution's vehicles</p>
  <div class="separator"></div>
    <div class="grid_vehicles">
      <div class="text-white vehicles_table">
        <div class="vehicles_row">
          <div class="vehicle">
            <div class="vehicle_frame">
               <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
               <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
        </div>
        <div class="vehicles_row">
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
          <div class="vehicle">
            <div class="vehicle_frame">
              <span class="helper"></span><img src="{$BASE_URL}images/vehicles/auv.png"></img>
            </div>
            <label>sup</label>
          </div>
        </div>
      </div>
      <div class="text-white vehicles_sideText">
        <label class="vehicle_filtro_lbl">Filter</label><br>
        <form method="post" action="{$BASE_URL}actions/action_vehicles_filter.php">
          <input type="radio" name="vehicles_filter" value="filtro1"> Filtro1</input><br>
          <input type="radio" name="vehicles_filter" value="filtro2"> Filtro2</input><br>
          <input type="radio" name="vehicles_filter" value="filtro3"> Filtro3</input><br>
          <input type="radio" name="vehicles_filter" value="filtro4"> Filtro4</input><br>
          <input type="radio" name="vehicles_filter" value="filtro5"> Filtro5</input><br>
          <input type="radio" name="vehicles_filter" value="filtro6"> Filtro6</input><br>
          <input type="submit" name="vehicles_submit" style="display:none"></input>
        </form>
      </div>
    </div>

</div>
{/if}

{include file='../common/footer-short.tpl'}

<script>
$('input[type=radio][name=vehicles_filter]').change(function() {
    $('input[type=submit][name=vehicles_submit]').click();
});
</script>
