<?php

include_once('../config/init.php');

$result =' POLYGON((-8.6870 41.1715,-8.6840 41.1715,-8.6840 41.1700,-8.6870 41.1700,-8.6870 41.1715))';
  
  
  
  
$str_arr = preg_split ("/\,/", $result);  
$str_arr[0]=ltrim($str_arr[0], ' POLYGON((');
$n_pontos=sizeof($str_arr);
$str_arr[$n_pontos-1]=rtrim($str_arr[$n_pontos-1], ' ))');
//var_dump($str_arr[$n_pontos-1]);
foreach ($str_arr as &$string) {
    $string=preg_split("/\s\s+/", $string,-1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
}
foreach($str_arr as &$val){
	$val['lat'] = (float)$val['1'];
	$val['lng'] = (float)$val['0'];
    unset($val['0']);
    unset($val['1']);

}

//var_dump($str_arr);
$v=[
	vertices=>$str_arr,
	numberVertices=>$n_pontos,
];

$t1=[
	"0"=>$v,
];
$areadb=[
	polygonsVertLatLng=>$t1,
	numberPolygons=>1,
	circlesCenterRad=>[],
	numberCircles=> 0,
];
//var_dump($areadb);

print json_encode($areadb);


//header("Location: $BASE_URL". '/pages/show_previous_data.php');

?>
