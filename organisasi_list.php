<?php

//action.php

include('database_connection.php');
include('server.php');

if(isset($_POST["action"]))
{
	
	$id = $_SESSION['id'];
	$sql = "SELECT penglibatan FROM projects WHERE id='$id'";
	$result = mysqli_query($db,$sql);
	$result = mysqli_fetch_array($result);
	echo $result;
	if($result == " "){
		$penglibatan = $_POST['penglibatan'];
	} else {
		$penglibatan = ",".$_POST['penglibatan'];
	}
	$query = '';
	if($_POST["action"] == "insert")
	{
		$query = "UPDATE projects SET penglibatan=concat(penglibatan,'$penglibatan'),bil_agensi=bil_agensi+1 WHERE id='$id'";
	}
	if($_POST["action"] == "edit")
	{
		$query = "
		UPDATE tbl_name 
		SET name = :name, 
		programming_languages = :programming_languages 
		WHERE id = '".$_POST['hidden_id']."'
		";
	}
	echo $query;
	$statement = $connect->prepare($query);
	$statement->execute($data);
} else {
	echo "ERROR";
}


?>