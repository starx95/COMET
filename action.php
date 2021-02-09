<?php
include('server.php');
//action.php
 $nama_projek;
 $penarafan;
 $tarikh_mula;
 $tarikh_tamat;
 $negeri;
 $status;
 $lokasi;
 $Penglibatan_Organisasi_Luar;
 $sumbangan;
 $so;
 $pemindahan_ilmu;
 $pendahuluan;
 $latarbelakang;
 $objektif;
 $pelaksanaan;
 $pra_penilaian;
 $staff;
 $nama;
 $organisasi;
// connect to the database

$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if($received_data->action == 'fetchall')
{
 $query = "
 SELECT * FROM projects
 ORDER BY id ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 while($rows = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $rows;
 }
 echo json_encode($data);
}
if(isset($_POST['save']))
{
 $nama_projek = $_POST['nama_projek'];


 $query = "
 INSERT INTO projects
 (nama_projek, tarikh_mula, tarikh_tamat,penarafan,status,negeri,lokasi,penglibatan,sumbangan,s/o,pemindahan,pendahuluan,latarbelakang,objektif,pelaksanaan,pra-penilaian,staff,nama,organisasi) 
 VALUES ($nama_projek,  $tarikh_mula, $tarikh_tamat, $penarafan, $status, $negeri,$lokasi,$Penglibatan_Organisasi_Luar,$sumbangan,$so,$pemindahan_ilmu,$pendahuluan,$latarbelakang,$objektif,$pelaksanaan,$pra_penilaian,$staff,$nama,$organisasi)";

 $statement = $db->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Inserted'
 );

 echo json_encode($output);
}
if($received_data->action == 'fetchSingle')
{
 $query = "
 SELECT * FROM projects
 WHERE id = '".$received_data->id."'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 foreach($result as $row)
 {
  $data['id'] = $row['id'];
  $data['nama_projek'] = $row['nama_projek'];
  $data['tarikh_mula'] = $row['tarikh_mula'];
  $data['tarikh_tamat'] = $row['tarikh_tamat'];
  $data['penarafan'] = $row['penarafan'];
  $data['status'] = $row['status'];
 }

 echo json_encode($data);
}
if($received_data->action == 'update')
{
 $data = array(
  ':nama_projek' => $received_data->nama_projek,
  ':tarikh_mula' => $received_data->tarikh_mula,
  ':id'   => $received_data->id
 );

 $query = "
 UPDATE projects
 SET nama_projek = :nama_projek, 
 tarikh_mula = :tarikh_mula
 WHERE id = :id
 ";

 $statement = $connect->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Updated'
 );

 echo json_encode($output);
}

if($received_data->action == 'delete')
{
 $query = "
 DELETE FROM projects
 WHERE id = '".$received_data->id."'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $output = array(
  'message' => 'Data Deleted'
 );

 echo json_encode($output);
}

//INSERT PROJECTS
if (isset($_POST['save'])) 
{
$nama_projek = mysqli_real_escape_string($db, $_POST['nama_projek']); 
$tarikh_mula = mysqli_real_escape_string($db, $_POST['tarikh_mula']);


$query = "INSERT INTO projects ( nama_projeks, tarikh_mula) 
  			  VALUES('$nama_projek', '$tarikh_mula')";
  	if(mysqli_query($db, $query))
	{
		echo "<script>alert('Successfuly Saved');</script>";
		header('location: index.php');
	}
}

?>