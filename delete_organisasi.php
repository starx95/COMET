<?php

//delete.php
include('server.php');
include('database_connection.php');

if(isset($_POST["sql"]))
{
	$query = $_POST["sql"];
	$statement = $connect->prepare($query);
	$statement->execute();
}
?>