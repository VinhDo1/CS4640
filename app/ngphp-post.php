<?php
// header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Origin: *'); //whoever sends me a request anywhere, it works. Opens the backend to everyone
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');


// retrieve data from the request
$postdata = file_get_contents("php://input");

// extract the JSON data into PHP array
$request = json_decode($postdata);

$data = [];
foreach ($request as $k => $v)
{
    $data[0]['get'.$k] = $v;
}

// send response back in json format
echo json_encode(['content'=>$data]);
?>