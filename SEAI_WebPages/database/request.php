<?php
  /****************************************************************************************************
   ***** RESTRICTIONSSEARCH
   ****************************************************************************************************
   *Search for previous restrictions available to create a new request
   */
   function restrictionsSearch(){
    // Global variable: connection to the database
    global $conn;

    // Search restictions in the database
    $stm = $conn->prepare("
      SELECT DISTINCT type
      FROM restritions
    ");
    $restictions = $stm->execute();

	$restrictions_str = '<datalist id="restriction">';
	foreach($restrictions as $restriction){
		$select_str.='<option value='.$restriction['type'].'>'.$restriction['type'].'</option>';
	}
	$restrictions_str .= '</datalist>';

    return $restrictions;
  }