{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
  <h2 class="display-4 text-white">MY DATA</h2>
  <p class="lead text-white mb-0">Details about my data</p>
  <div class="separator"></div>
    <div class="my_data">
      <table class='table_pd'>
      <tr>
      <th>Column 1</th><th>Column 2</th><th>Column 3</th>
      </tr>
      {*foreach $mydata as $data}{
          <tr>
          <td>{$data.col1}</td><td>{$data.col2}</td><td>{$data.col3}</td>
          </tr>
      {/foreach*}
      </table>
    </div>
</div>

{include file='../common/footer-short.tpl'}
