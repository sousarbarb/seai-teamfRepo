{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}

<SCRIPT language="javascript">
		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>

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
				<tr style="text-align: center" >
					<td colspan="2">
					<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
					<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />
					</td>
				</tr>
		  </thead>
		  <tbody id="dataTable" >
				<tr >
					<td><input type="checkbox" name="chk" />
						<input list="specifications">
						  <datalist id="specifications">
							<option value="Specification 1">
							<option value="Specification 2">
							<option value="Specification 3">
							<option value="Specification 4">
							<option value="Specification 5">
						  </datalist>
					</td>
					<td>
						Value:
						<input list="values">
						  <datalist id="values">
							<option value="value 1">
							<option value="value 2">
							<option value="value 3">
							<option value="value 4">
							<option value="value 5">
						  </datalist>
					</td>
				</tr>
		 </tbody>
		</table>

		<input type="submit" name="back" class="confirm" value="Go back" >
		<input type="submit" name="Confirm" class="confirm" value="Confirm Request" >
	</form>
</div>
