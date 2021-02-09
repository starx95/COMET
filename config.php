<?php

$connect = new PDO("mysql:host=localhost;dbname=comet","root","");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if($received_data->action == 'fetchall')
{
  $query = "SELECT * FROM projects ORDER BY id DESC";
  $statement = $connect->prepare($query);
  $statement->execute();
  while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    $data[] = $row;
  }
  echo json_encode($data);
}


//$host = "localhost"; /* Host name */
//$user = "root"; /* User */
//$password = ""; /* Password */
//$dbname = "comet"; /* Database name */

//$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
//if (!$con) {
//  die("Connection failed: " . mysqli_connect_error());
//}