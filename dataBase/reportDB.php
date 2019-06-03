<?php

//========= include =========
include 'config.inc.php';


$options = array(
    "sort" => array("time_start" => 1)
);

$filter_1 = array(
    'route' => '1',
);

$filter_3 = array(
    'route' => '3',
);


$collection = $client->timesyscmu->transit_Speed;
// ========================== select table ==========================
$result_1 = $collection->find($filter_1, $options); 
$result_3 = $collection->find($filter_3, $options); 


?>