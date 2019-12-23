{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">Waiting Offers</h2>
    <br>

    <table class='table_pd'>
    <tr>
    <th>Institution Name</th><th>Detailed Information</th>
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
        <td>{$request.institute_name}</td><td>{$request.informarions} <a href="pdf.pdf" download><img src ="images/pdf.png" widht=20px height=20px></td>
        <td><a href="actions/actiondeleterequest.php?id_request=". {$row['id_request']}."">Eliminar</a></td><td><a href="menu_my_account.tpl">Aceitar</a></td>

        </tr>
    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
