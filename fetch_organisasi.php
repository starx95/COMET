<?php
include('server.php');
include('database_connection.php');

if(isset($_SESSION['id'])){
$query = "SELECT * FROM projects WHERE id=".$_SESSION['id']."";
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_rows = $statement->rowCount();
$output = ' <div class="table-responsive">
			<table style="margin-bottom:20px;margin-top:20px;margin-left:20px;margin-right:20px;width:90%" class="table table-bordered table-striped">
			<tr>
				<th>Nama Organisasi</th>
				<th>Delete</th>
			</tr>
			';

if($total_rows > 0)
{
	foreach($result as $row)
	{
		$str_arr = explode (",", $row["penglibatan"]);	
		$org_num = count($str_arr);
		$int = 0;
		$i = 1;
		$first = 0;
		$arr_org = '';
		if($row['penglibatan']!=""){
		foreach($str_arr as $rows)
		{
		if($str_arr[$int] != ""){
		$output .= '<tr style="margin-bottom:20px;margin-top:20px;margin-left:20px;margin-right:20px">
						<td style="width:100%">'.$str_arr[$int].'</td>
						<td ><button type="button" row=\''.$_SESSION['id'].'\' name="delete" onclick="myFunction(\''.$str_arr[$int].'\',\''.$_SESSION['id'].'\')" id="'.$int.'" class=" btn-danger btn-xs delete">Buang</button></td>
					</tr>';
					?><script>
						var passedArray = <?php echo json_encode($str_arr); ?>;
						var mysql = require('mysql');
						
						function load_data()
							{
								$.ajax({
									url:"fetch_organisasi.php",
									method:"POST",
									success:function(data)
									{
										$('#result').html(data);
									}
								})
							}
						
						function myFunction(ind,id) {
						for( var i = 0; i < passedArray.length; i++){ if ( passedArray[i] === ind) { passedArray.splice(i, 1)}};
							
							var sql = "UPDATE projects SET penglibatan = '"+passedArray+"',bil_agensi=bil_agensi-1 WHERE id='"+ id+"'";
							
							
							
						$(document).on('click', '.delete', function(){
							
							
								$.ajax({
									url:"delete_organisasi.php",
									method:"POST",
									data:{sql:sql},
									success:function(data)
									{
										
										load_data();
									
									}
								})
							
						});
						}
						
					</script><?php
					if($i < $org_num){
						$arr_org .= $str_arr[$int].",";
						$i++;
					} else {
						$arr_org .= $str_arr[$int];
					}
		$int++;
		}else{$int++;}}}else{$output .= '
	<tr>
		<td colspan="4">Tiada Organisasi didaftarkan</td>
	</tr>
	';
		//echo $arr_org;
	}
}}

$output .= '</table></div>';

echo $output;
?>
