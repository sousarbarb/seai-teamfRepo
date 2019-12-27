{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}


<div class="menusLogin p-5">
	<h2 class="display-4 text-white">New Request</h2>
	<p class="lead text-white mb-0">Request New Mission Plan</p>
	<div class="separator"></div>
	<form action="{$BASE_URL}actions/plan_new_mission.php" method="post">
		<table class="table table-light table-bordered table_plan_new_mission" >
		  <thead>
		    <tr>
		      <th style="text-align: center"> Mission Restrictions</th>
		      <th style="text-align: center"> Intended Value</th>
		    </tr>
		  </thead>
		  <tbody>
			<tr>
				<td> Sensor Type </td> 
				<td>
					<input list="sensor">
					  {$sensors}
				</td>
			</tr><tr>
				<td> Resolution </td>
				<td>
					<input list="resolution">
					  {$resolutions}
				</td>
			</tr>
			<tr >
				<td> Deadline</td>
				<td>
					<input type="date" name="bday">
				</td>
			</tr>
			<tr >
				<td> Comment </td>
				<td>
					<textarea rows="4" cols="50">Comment</textarea>
				</td>
			</tr>
		 </tbody>
		</table>

		<input type="submit" name="back" class="confirm" value="Go back" >
		<input type="submit" name="Confirm" class="confirm" value="Confirm Request" >
	</form>
</div>
