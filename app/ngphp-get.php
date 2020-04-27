<?php
// header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Origin: *'); //whoever sends me a request anywhere, it works. Opens the backend to everyone
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');


// retrieve data from the request
$getdata = $_GET['str'];        // assume param's named 'str'

// extract the JSON data into PHP array
$request = json_decode($getdata);

$data = [];
foreach ($request as $k => $v)
{
    $data[0]['get'.$k] = $v;
}

// send response back in json format
echo json_encode(['content'=>$data]);
?>