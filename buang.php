<?php
include('server.php');

if(isset($_GET['id'])){
$id = $_GET['id'];
$sql = "DELETE FROM projects WHERE id=$id";
if(mysqli_query($db, $sql)){
	echo "DATA DELETED";
}

}

?>