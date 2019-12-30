{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Waiting Offers</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Institution Name</th><th>Estimated Starting Time</th><th>Estimated Finishing Time</th><th>Estimated Cost</th><th>Detailed Informations</th>
    </tr>

    {$missions = getAllMissionsProposal( $request_id )}


    {foreach $missions as $mission}
        <tr>
        <td> {$mission['entity_name']} </td>
        <td>{$mission['est_starting_time']}</td>
        <td>{$mission['est_finished_time']}</td>
        <td>{$mission['price']}</td>
        <td>{$mission['pdf']} <a href="pdf.pdf" download><img src ="images/pdf.png" widht=20px height=20px></a></td>

        <td><a href="menu_requests_waiting.php">Aceitar</a></td>
        <td><a href="actions/deletemission.php?id_misson=". {$mission['mission_id']}."">Ignorar</a></td>

        </tr>
    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
