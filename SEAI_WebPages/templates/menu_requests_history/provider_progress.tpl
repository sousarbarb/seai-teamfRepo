{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Mission ID</th><th>Mission Specifications</th><th>Plan Proposal</th><th>Payment Confirmation</th><th>Status</th>
    </tr>


    <!-- {foreach $requests as $request}{
        <tr>
        <td>{$request.area}</td>
        <td>{$request.sp}</td>
    
        <td>{if $budget==false}
        <a href="client_progress.tpl">Insert Budget</a>
        {else}
        <input type="checkbox" checked="true" onclick="return false;"/>
        </td>

        <td>
        <input type="checkbox">
        </td>


        <td>{<a href="client_progress.tpl">Update Status</a>}</td>
        </tr>
    {/foreach}
     -->

    </table>
    <br>

    </form>
<br>

</div>
</div>