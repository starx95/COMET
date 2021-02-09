<?php 
include('server.php');

$sql = "UPDATE laporan SET file = 'test', type='test',size='test' WHERE id = '325471314'";
if(mysqli_query($db,$sql)){
	echo "success";
} else {
	echo "error";
}
?>