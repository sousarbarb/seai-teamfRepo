{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Pending Offers</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Mission Name</th><th>Restrictions</th><th>User</th><th>Sensor Type</th><th>Resolution</th><th>Estimated Cost</th><th>
    </tr>

    {*get requests from DB
    .................*}

    {$requests = [
                    ["area"=>"100", "sp"=>"20", "date"=>"13", "specs"=>"x", "price"=>"13", "file"=>"files/teste.txt"],
                    ["area"=>"100", "sp"=>"20", "date"=>"13", "specs"=>"x", "price"=>"13", "file"=>"files/teste.txt"],
                    ["area"=>"100", "sp"=>"20", "date"=>"13", "specs"=>"x", "price"=>"13", "file"=>"files/teste.txt"]
                ]}



    {foreach $requests as $request}
        <tr>
        <td>{$request.name}</td><td>{$request.restrictions}</td><td>{$request.user}</td><td>{$request.sensor}</td><td>{$request.resolution}</td><td>{$request.cost}</td>
        <td><a href="actiondeleterequest.php?id_request=".{$row['id_request']}."">Eliminar</a></td><td><a href="accept_request.tpl">Aceitar</a></td>

        </tr>
    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
