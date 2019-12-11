<?php
include_once('../config/init.php');

//global $conn;
/*$stmt = $conn->prepare('SELECT *
                        FROM vehicles
                        WHERE privacy = ?
                        AND vehicles_filter1 = ?
                        AND vehicles_filter2 = ?
                        AND vehicles_filter3 = ?');
*/
//$query = "SELECT * FROM vehicles";

$filtered_get = array_filter($_GET);
$arguments=[];

$i=0;
//if ($acc_type=="provider") {
  if(count($filtered_get)) {
    //$query .= " WHERE";

    $keynames = array_keys($filtered_get); // make array of key names from $filtered_get

    foreach($filtered_get as $key => $value) {
      //$query .= " $keynames[$key] = '$value'";  // $filtered_get keyname = $filtered_get['keyname'] value
      if ($value=='privacy') {
        array_push($arguments, $entity_name);
      } elseif ($i==0) {
        array_push($arguments, 'public');
        array_push($arguments, $value);
      }
      else {
        array_push($arguments, $value);
      }
      $i=1;
      /*if (count($filtered_get) > 1 && (count($filtered_get) > $key)) { // more than one search filter, and not the last
        $query .= " AND";
      }*/
    }
  }
//} else {
  /*if(count($filtered_get)) {
    $query .= " WHERE";

    $keynames = array_keys($filtered_get); // make array of key names from $filtered_get

    foreach($filtered_get as $key => $value) {
      $query .= " $keynames[$key] = '$value'";  // $filtered_get keyname = $filtered_get['keyname'] value
      if (count($filtered_get) > 1 && (count($filtered_get) > $key)) { // more than one search filter, and not the last
        $query .= " AND";
      }
    }
  }
}*/

//executar query, devolver resultado
//$stmt->execute(array($arguments));
//return $stmt->fetchAll();
print_r($arguments);

$_SESSION['form_values']=$_GET;
//die(header('Location: ' . $_SERVER['HTTP_REFERER']));

?>
