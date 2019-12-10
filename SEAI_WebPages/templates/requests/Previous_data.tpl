{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}
<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request - Existent Data</h2>
	<br>
	<form action="{$BASE_URL}/Actions/buy_request.php" method="post">

	<table class='table_pd' id="foo">
	<tr>
	<th>Area covered</th><th>Service Provider</th><th>Date</th><th>Price</th><th></th>
	</tr>
	<!-- {foreach $requests as $request}{
		<tr>
		<td>{$request.area}</td><td>{$request.sp}</td><td>{$request.date}</td><td>{$request.price}</td><td><input type="checkbox" name="check" value="{$request.id}"></td> 
		</tr>
		<tr>
	    <td div class="info" colspan="6" ></td>
	    </tr>
	{/foreach}
	 -->
	 <tr>
	 <td>90%</td><td>lsts</td><td>4/12</td><td>100$</td><td><input type="checkbox" name="check" value="3"></td>
	 </tr>
	 <tr>
	 <td div class="info" colspan="6" >555.555.555</td>
	 </tr>
	 <tr>
	 <td>70%</td><td>seai</td><td>4/12</td><td>100$</td><td><input type="checkbox" name="check" value="3"></td>
	 </tr>
	 <tr>
	 <td div class="info" colspan="6" >radddwadqwqdq</td>
	 </tr>
	</table>
	<br>
	<input type="submit" name="back" class="comfirm" value="Back" >
	<input type="submit" name="Confirm" class="comfirm" value="Confirm" >
	</form>

<br>
</div>
</div>


