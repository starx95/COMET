<?php
include('server.php');

$number = count($_POST["name"]);
if($number > 1)
{
	for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["name"][$i] != ''))
		{
			$sql = "INSERT INTO tbl_name(name) VALUES('".mysqli_real_escape_string($db, $_POST["name"][$i])."')";
			mysqli_query($db, $sql);
		}
	}
	echo "Data Inserted";
}
else
{
	echo "Please Enter Name";
}