{include file='common/header.tpl'}
{include file='common/navbar_logged_in.tpl'}
{include file='common/logout.tpl'}

{if ($acc_type!="admin")}
<div class="menusLogin p-5">
  <h2 class="display-4 text-white">Error</h2>
  <p class="lead text-white mb-0">You don't have permission to see this page</p>
  <br><br><br><br><br><br><br><br><br><br><br><br>
</div>
{else}
<div class ="menusLogin p-5">
  <h2 class="display-4 text-white">VEHICLES</h2>
  <p class="lead text-white mb-0">Select the vehicles you want to validate or remove</p>
  <div class="separator"></div>

  <div class="grid-vehicles">
  <div class="vehicles_table">
    <table width=600 border=1 id='tabela'>
      <tr>
        <th>Name</th>
        <th>Institution</th>
        <th>Active</th>
        <th>Approved</th>
      </tr>

      {foreach $search_results as $result}
        <tr>
          <td>{$result['vehicle_name']}</td>
          <td>{$result['provider_entityname']}</td>
          <td>{$result['vehicle_active']}</td>
          <td>{$result['vehicle_approval']}</td>
        </tr>
      {/foreach}

    </table>



  </div>
  </div>


<br>
<br>

</div>
</div>
{/if}

{include file='common/footer-short.tpl'}
