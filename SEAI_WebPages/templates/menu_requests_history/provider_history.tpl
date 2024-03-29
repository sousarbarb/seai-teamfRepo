{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<div class="menusLogin p-5">
    <h2 class="display-4 text-white">New Request - Existent Data</h2>
    <div class="separator"></div>

    <table class='table_pd'>
    <tr>
    <th style="text-align: center" >Mission ID</th>
    <th style="text-align: center" >Service Client</th>
    <th style="text-align: center" >Vehicles</th>
    <th style="text-align: center" >Starting Time</th>
    <th style="text-align: center">Finishing Time</th>
    <th style="text-align: center" >Informations</th>
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
        <td>{$request.area}</td><td>{$request.sp}</td><td>{$request.date}</td><td>{$request.specs}</td><td>{$request.price}</td>
        <td>
        <form method="POST" action="../actions/upload.php" enctype="multipart/form-data">
        <input type="file" name="real-file" id="real-file" hidden="hidden"/>
        <button type="button" id="custom-button" class="button4 button_provider_hist">Choose a File</button>
        <span id="custom-text" class="custom-txt">No file chosen, yet</span>
        <input type="submit" value="Confirmar" name="submit" class="button4 submitAsBtn button_provider_hist">
        </form>


        </td>
        </tr>
    {/foreach}

    </table>
    <br>

<br>

</div>
</div>
