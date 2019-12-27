<?php
  /****************************************************************************************************
   ***** SENSORSSSEARCH
   ****************************************************************************************************
   *Search for previous restrictions available to create a new request
   */
   function sensorsSearch($restrictions){
    $restrictions_str = '<datalist id="sensor">';
	foreach($restrictions as $restriction){
		$restrictions_str.='<option value='.$restriction['sensor_type'].'>'.$restriction['sensor_type'].'</option>';
	}
	$restrictions_str .= '</datalist>';

    return $restrictions_str;
  }
  
  /****************************************************************************************************
   ***** RESOLUTIONSSEARCH
   ****************************************************************************************************
   *Search for previous restrictions available to create a new request
   */
   function resolutionsSearch($restrictions){
    $restrictions_str = '<datalist id="resolution">';
	foreach($restrictions as $restriction){
		$restrictions_str.='<option value='.$restriction['value'].'>'.$restriction['value'].'</option>';
	}
	$restrictions_str .= '</datalist>';

    return $restrictions_str;
  }