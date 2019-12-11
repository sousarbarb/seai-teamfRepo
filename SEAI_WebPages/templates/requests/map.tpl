{include file='../common/header.tpl'}
{include file='../common/navbar_logged_in.tpl'}
{include file='../common/logout.tpl'}
<div class="menusLogin p-5">
<form action="{$BASE_URL}/pages/show_previous_data.php" method="get">
   	<h2 class="display-4 text-white">New Request - Area Selection</h2>
	<div class="grid">
	<div id="mapid" style="width: 100%; height: 48em; grid-column-start: 1;  grid-column-end: 2; grid-row-start: 1; grid-row-end: 3;"></div>
	<div id="tooltip"></div>
	<!-- Debug section -->

	<script>
	  var map, tooltip, deleteShape;
	  mapConfiguration();
	</script>
	<div class="filters"></div>
	<div class="infotext">	
	<p id="info"></p>
	
	<div class="popup" onclick="myFunction()"> Help
	  <span class="popuptext" id="myPopup">Instruction on how to use the interactive map: <br> -Double click the end point to finnish the area edition, <br> -Double click on an already created polygon to edit it,</span>
	</div>
	<input type="submit" name="Confirm" class="popup" value="Confirm Selection" style="width: 10em;">
	</form>
</div>