{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}
<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request - Existent Data</h2>
	<br>
	<form action="{$BASE_URL}/Actions/buy_request.php" method="post">

	<table class='table_pd'>
	<tr>
	<th>Area covered</th><th>Service Provider</th><th>Date</th><th>Vehicle</th><th>Price</th><th></th>
	</tr>
	<!-- {foreach $requests as $request}{
		<tr>
		<td>{$request.area}</td><td>{$request.sp}</td><td>{$request.date}</td><td>{$request.specs}</td><td>{$request.price}</td><td><input type="radio" name="check" value="{$request.id}"></td>
		</tr>
	{/foreach}
	 -->
	 <td>90%</td><td>lsts</td><td>4/12</td><td>dasda</td><td>100$</td><td><input type="radio" name="check" value="3"></td>
	</table>

	<br>
	<input type="submit" name="back" class="comfirm" value="Back" >
	<input type="submit" name="Confirm" class="comfirm" value="Confirm" >
	</form>

<br>
</div>
</div>

{include file='../common/footer.tpl'}