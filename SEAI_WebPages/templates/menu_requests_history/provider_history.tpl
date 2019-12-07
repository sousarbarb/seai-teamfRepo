{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Mission ID</th><th>Service Client</th><th>Vehicles</th><th>Starting Time</th><th>Finishing Time</th><th>Informations</th>
    </tr>


    <!-- {foreach $requests as $request}{
        <tr>
        <td>{$request.area}</td><td>{$request.sp}</td><td>{$request.date}</td><td>{$request.specs}</td><td>{$request.price}</td><td><a href="pdf.pdf" download><img src ="images/pdf.png" widht=20px height=20px></td>

        </tr>
    {/foreach}
     -->

    </table>
    <br>

    </form>
<br>

</div>
</div>