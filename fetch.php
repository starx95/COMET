<?php
include('server.php');
include('database_connection.php');
$name = str_replace(' ', '_', $_SESSION['nama_projek']);

$query = "SELECT * FROM Staff_".$name."";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_rows = $statement->rowCount();

$output = '
<div class="table-responsive">
	<table style="margin-left:80px;width:90%" class="table table-bordered table-striped">
		<tr>
			<th>Staff No.</th>
			<th>Nama</th>
			<th>Organisasi</th>
			<th>Delete</th>
		</tr>
';

if($total_rows > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row["staff_no"].'</td>
			<td>'.$row["name"].'</td>
			<td>'.$row["organisasi"].'</td>
			<td><button type="button" name="delete" staff_no="'.$row["staff_no"].'" class="btn btn-danger btn-xs delete">Delete</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4">Tiada Staff didaftarkan</td>
	</tr>
	';
}
$output .= '</table></div>';

echo $output;

?>