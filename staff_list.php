<?php

//action.php

include('database_connection.php');
include('server.php');
if(isset($_POST["action"]))
{
	
	$organisasi = implode(",", $_POST["organisasi"]);
	$staff_no = implode(",", $_POST["staff_no"]);
	$name = implode(",", $_POST["name"]);
	$data = array(
		':staff_no'		=>  $staff_no,
		':name'			=>	$name,
		':organisasi'	=>	$organisasi
	);
	$query = '';
	if($_POST["action"] == "insert")
	{
		
		$_SESSION['nama_projek'] = str_replace(' ', '_', $_SESSION['nama_projek']);
		$query = "INSERT INTO Staff_".$_SESSION['nama_projek']." (staff_no, name, organisasi) VALUES (:staff_no, :name, :organisasi)";
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

	$statement = $connect->prepare($query);
	$statement->execute($data);
}


?>