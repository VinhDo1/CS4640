<?php

header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

// get the size of incoming data
$content_length = (int) $_SERVER['CONTENT_LENGTH'];

// retrieve data from the request
$postdata = file_get_contents("php://input");

// Process data
// (this example simply extracts the data and restructures them back)

// Extract json format to PHP array
$request = json_decode($postdata);

require('connect-db.php');

foreach ($request as $k => $v)
{
  if($k == "username")
  {
    $username = $v;
  }
  else if($k == "pwd")
  {
    $password = $v;
  }
  else if($k == "question_option")
  {
    $question = $v;
  }
  else if($k == "answer")
  {
    $answer = $v;
  }
}
// $username = $request["username"];
// $password = $request["pwd"];
// $question = $request["question_option"];
// $answer = $request["answer"];

// $hash_pwd = password_hash($password, PASSWORD_BCRYPT);
$hash_pwd = $password;
$query = "INSERT INTO register (username, password, question, answer) VALUES (:username, :password, :question, :answer)";
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->bindValue(':password', $hash_pwd);
$statement->bindValue(':question', $question);
$statement->bindValue(':answer', $answer);
$statement->execute();
$statement->closeCursor();
session_start();
$_SESSION['username'] = $username;
$_SESSION['pwd'] = $hash_pwd;
// header('Location: lobby.php');

$data = [];
$data[0]['length'] = $content_length;
foreach ($request as $k => $v)
{
  $data[0]['post_'.$k] = $v;
}

echo json_encode(['content'=>$data]);
/* GET Method
// Send response (in json format) back the front end
echo json_encode(['content'=>$data]);

// Retrieve data from the request
$getdata = $_POST['str'];     // param sent from Angular is named 'str'


// Process data

// Extract json format to PHP array
$request = json_decode($getdata);
require('connect-db.php');
   
echo $request[0]
// $username = $_GET["username"];
// $password = $_GET["pwd"];
// $hash_pwd = password_hash($password, PASSWORD_BCRYPT);
// $query = "INSERT INTO register (username, password) VALUES (:username, :password)";
// $statement = $db->prepare($query);
// $statement->bindValue(':username', $username);
// $statement->bindValue(':password', $hash_pwd);
// $statement->execute();
// $statement->closeCursor();
// session_start();
// $_SESSION['username'] = $username;
// $_SESSION['pwd'] = $hash_pwd;
// header('Location: http://localhost:81/cs4640/lobby.php');


// $data = [];
// foreach ($request as $k => $v)
// {
//   $data[0]['get_'.$k] = $v;
// }


// Send response (in json format) back the front end
echo json_encode(['content'=>$data]);
*/
?>
