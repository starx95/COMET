<?php

//delete.php
include('server.php');
include('database_connection.php');

if(isset($_POST["id"]))
{
	$name = str_replace(' ', '_', $_SESSION['nama_projek']);
	$query = "DELETE FROM Staff_".$name." WHERE staff_no = '".$_POST['id']."'";
	$statement = $db->prepare($query);
	$statement->execute();
}
?>