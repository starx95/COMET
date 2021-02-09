<?php 
include('server.php');
$skop = "";
$sdg = "";

if(!empty($_POST['skop'])){
      foreach($_POST['skop'] as $temp){
		$skop .= "-".$temp;
      }
}
if(!empty($_POST['sdg'])){
      foreach($_POST['sdg'] as $tmp){
		$sdg .= "-".$tmp;
      }
	 
}
if(isset($_SESSION['id'])){
	$result = mysqli_query($db, "SELECT * FROM laporan WHERE id='".$_SESSION['id']."'");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
			if(strpos($row['file'],"kerjasama")){
				$kerjasama = $row['file'];
				$no_kerjasama = $row['bil'];
			}if(strpos($row['file'],"sokongan")){
				if($row['size'] == 0){}else{
					$sokongan = $row['file'];
					$no_sokongan = $row['bil'];}
			}if(strpos($row['file'],"milestone")){
				$milestone = $row['file'];
				$no_milestone = $row['bil'];
			} 
		}
	}
}

$i=1; foreach ($_POST['skop'] as $skop){   $i.")". $skop." "; $i++;}
$n=1; foreach ($_POST['sdg'] as $penglibatan){  $n.")". $penglibatan." "; $n++;}
if(!isset($_SESSION['id'])){
	$id = rand();	
} else {
	$id = $_SESSION['id'];
}
	if(isset ($_POST['new']) && $_POST['new'] == 1){
		//INSERT PROJECTS
	if (isset($_POST['save'])) 
	{
	$penglibatan =  $_POST['penglibatan'];
	$id =  $_POST['id'];
	$sixmnth =  $_POST['sixmnth'];
	$registeredby = $_SESSION['email'];
	$nama_projek =  $_POST['nama_projek'];
	$tarikh_mula=  $_POST['tarikh_mula'];
	$tarikh_tamat=  $_POST['tarikh_tamat'];
	$negeri=  $_POST['negeri'];
	$lokasi=  $_POST['lokasi'];
	$Penglibatan_Organisasi_Luar= implode( $_POST['Penglibatan_Organisasi_Luar']);
	$sumbangan=  $_POST['sumbangan'];
	$so=  $_POST['s/o'];
	$pemindahan_ilmu=  $_POST['pemindahan_ilmu'];
	$pendahuluan= $_POST['pendahuluan'];
	$latarbelakang=  $_POST['latarbelakang'];
	$objektif=  $_POST['objektif'];
	$pelaksanaan=  $_POST['pelaksanaan']; 
	$pra_penilaian=  $_POST['penilaian'];
	$status = $_POST['status'];
	$sdg = $_POST['sdg'];
	$skop = $_POST['skop'];
	$penarafan =  $_POST['penarafan'];
	$skopt =  $_POST['skopt'];
	$name = $_SESSION['name'];
	$ptj = $_SESSION['pusat'];
	$yes = $_POST['penglibatan_komuniti'];
	if(isset($_SESSION['id'])){
	$query = "UPDATE projects SET registeredby='$registeredby', nama_projek='$nama_projek', tarikh_mula='$tarikh_mula', tarikh_tamat='$tarikh_tamat',negeri='$negeri',lokasi='$lokasi', penglibatan_komuniti='$yes',sumbangan='$sumbangan',so='$so',pemindahan='$pemindahan_ilmu',pendahuluan='$pendahuluan',latarbelakang='$latarbelakang',objektif='$objektif',pelaksanaan='$pelaksanaan',pra_penilaian='$pra_penilaian', skop='$skop', skopt='$skopt', sdg='$sdg', penarafan='$penarafan',status='$status', ptj='$ptj',sixmnth='$sixmnth'
				WHERE id='".$_SESSION['id']."'";
				if (mysqli_query($db, $query)) {
					unset($_SESSION['update']);
				header('index.php');
				}
	}		
	}
	
	$nama = $_POST['nama_projek'];
	if(isset($_SESSION['id'])){
		$file = $_SESSION['id']." Surat kerjasama ".$nama."-".$_FILES['kerjasama']['name'];
	} else {
	$file = $_POST['id']." Surat kerjasama ".$nama."-".$_FILES['kerjasama']['name'];
	}
	
	$file_loc = $_FILES['kerjasama']['tmp_name'];
	$file_size = $_FILES['kerjasama']['size'];
	$file_type = $_FILES['kerjasama']['type'];
	$folder="uploads/semak/kerjasama/";
	if($_FILES['kerjasama']['size'] != 0){
	move_uploaded_file($_FILES['kerjasama']['tmp_name'],$folder.$file);
	
		$idl = $_POST['no_kerjasama']; 
		if(isset($_SESSION['id'])){
			
			$sqlk = "UPDATE `laporan` SET `file`='$file',`type`='$file_type',`size`='$file_size' WHERE `bil` = '$idl'";
			} else {
			$sqlk="INSERT INTO laporan(id,file,type,size) VALUES('$id','$file','$file_type','$file_size')";
			}
	if(mysqli_query($db,$sqlk)){
			echo "success";
		} else {
			echo "error";
		}
	}
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'penglibatan\']; ?>"></td>';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="id" class="border px-4 py-2 width" type="text" value="<?php echo $id; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sixmnth" class="border px-4 py-2 width" type="text" value="<?php echo $strtotime;?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="nama_projek" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'nama_projek\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="negeri" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'negeri\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="lokasi" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'lokasi\']; ?>">';
    echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="Penglibatan_Organisasi_Luar[]" class="border px-4 py-2 width" type="text" value="<?php foreach ($_POST[\'Penglibatan_Organisasi_Luar\'] as $tmp){echo $tmp;} ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sumbangan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'sumbangan\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="tarikh_mula" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'mula\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="tarikh_tamat" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'tamat\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="s/o" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'S/O_kod\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pemindahan_ilmu" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'pemindahan_ilmu\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pendahuluan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'pendahuluan\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="latarbelakang" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'latarbelakang\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="objektif" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'objektif\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sdg" class="border px-4 py-2 width" type="text" value="<?php $n=1; foreach ($_POST[\'sdg\'] as $penglibatan){  echo $n.")". $penglibatan." "; $n++;} ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="skop" class="border px-4 py-2 width" type="text" value="<?php $i=1; foreach ($_POST[\'skop\'] as $skop){  echo $i.")". $skop." "; $i++;} ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="skopt" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'skopt\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penarafan" class="border px-4 py-2 width" type="text" value="<?php echo $penarafan." Bintang"; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pelaksanaan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'pelaksanaan\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penilaian" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'penilaian\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="staff" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'staff\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="nama" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'nama\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="organisasi" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'organisasi\']; ?>">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="status" class="border px-4 py-2 width" type="text" value="Pending">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="ptj" class="border px-4 py-2 width" type="text" value="'.$_SESSION['pusat'].'">';
	echo '<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan_komuniti" class="border px-4 py-2 width" type="text" value="<?php echo $_POST[\'penglibatan_komuniti\']; ?>">';
	if(isset($_SESSION['id'])){
		$file_sokongan = $_SESSION['id']." Surat sokongan ".$nama."-".$_FILES['sokongan']['name'];
	} else {
	$file_sokongan = $_POST['id']." Surat sokongan ".$nama."-".$_FILES['sokongan']['name'];
	}
	if($_FILES['sokongan']['size'] != 0){
	$file_loc_sokongan = $_FILES['sokongan']['tmp_name'];
	$file_size_sokongan = $_FILES['sokongan']['size'];
	$file_type_sokongan = $_FILES['sokongan']['type'];
	$folder_sokongan="uploads/semak/sokongan/";
	if($_FILES['sokongan']['size'] != 0){
	move_uploaded_file($_FILES['sokongan']['tmp_name'],$folder_sokongan.$file_sokongan);
		$ids = $_SESSION['id'];
		if(isset($sokongan)){
			$no_sokongan = $_POST['no_sokongan'];
			$sqls = "UPDATE `laporan` SET `file`='$file_sokongan',`type`='$file_type_sokongan',`size`='$file_size_sokongan' WHERE `bil` = '$no_sokongan'";
		} else {
			$sqls="INSERT INTO laporan(id,file,type,size) VALUES('$id','$file_sokongan','$file_type_sokongan','$file_size_sokongan')";
		}
	
	if(mysqli_query($db,$sqls)){
			echo "success";
		} else {
			echo "error";
		}
	}
	}
	if(isset($_SESSION['id'])){
		$file_milestone = $_SESSION['id']." Surat milestone ".$nama."-".$_FILES['milestone']['name'];
	} else {
	$file_milestone = $_POST['id']." Surat milestone ".$nama."-".$_FILES['milestone']['name'];
	}
	$file_loc_milestone = $_FILES['milestone']['tmp_name'];
	$file_size_milestone = $_FILES['milestone']['size'];
	$file_type_milestone = $_FILES['milestone']['type'];
	$folder_milestone="uploads/semak/milestone/";
	if($_FILES['milestone']['size'] != 0){
	move_uploaded_file($_FILES['milestone']['tmp_name'],$folder_milestone.$file_milestone);
		$idm = $_SESSION['id'];
		if(isset($_SESSION['id'])){
			$no_milestone = $_POST['no_milestone'];
		$sqlm = "UPDATE `laporan` SET `file`='$file_milestone',`type`='$file_type_milestone',`size`='$file_size_milestone' WHERE `bil` = '$no_milestone'";
		} else {
		$sqlm="INSERT INTO laporan(id,file,type,size) VALUES('$id','$file_milestone','$file_type_milestone','$file_size_milestone')";
		}
		
	if(mysqli_query($db,$sqlm)){
	echo "success";
} else {
	echo "error";
}
	}
	header('location: index.php');
	}
?>
<html>
<head>
<script>



var counter = 1;
var dynamicInput = [];

function addInput(){
    var newinput = document.createElement('div');
    newinput.id = dynamicInput[counter];
    newinput.innerHTML =  " <br ><label for='myInputs[]'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AJK:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input  style='padding: 12px 20px; 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box; width:224px;border-radius: 8px;border:solid' type='text' placeholder='Staff no.' name='myInputs[]'> <input style='width:24' type='button' value='-' onClick='removeInput("+dynamicInput[counter++]+");'><input style='padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;margin-left:4px;width:225px;border-radius: 8px;border:solid;width:224px' type='text' placeholder='Nama' name='myInputs[]' ><input style='width:224px;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;margin-left:4px;border-radius: 8px;border:solid' type='text' placeholder='Organisasi' name='myInputs[]'>";
    document.getElementById('formulario').appendChild(newinput);
    
}
  
  function removeInput(id){
    var elem = document.getElementById(id);
	counter--;
    return elem.parentNode.removeChild(elem);
  }
</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

<style>
body {font-family: Arial, Helvetica, sans-serif; background-image: url('bg.jpg');  background-repeat: no-repeat;background-attachment: fixed;}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

input[type=checkbox] {
	margin:6px;
}

td{
	text-align:center;
}

input[type=checkbox] {
	vertical-align: top;
}
/* Set a style for all buttons */
.logoutbutton {
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border-radius:30px;
  height: 20px
  border: none;
  cursor: pointer;
  width: 97%;
}

button:hover {
  opacity: 0.8;
}

.containers:hover .image {
  opacity: 0.7;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

 .img {
    display: flex;
    align-items:center;
    margin:10px;
  }

.container {
  padding: 1px;
}

span.psw {
  float: right;
  padding-top: 4px;
  padding-right: 40px;
}

.forgot
{
    display: block;
    border-top: 4px solid #a7a59b;
    background-color: #f6e9d9;
    height: 22px;
    line-height: 22px;
    padding: 4px 6px;
    font-size: 14px;
    color: #000;
    margin-bottom: 13px;
    clear: both;
}

.forgot .psw { float: right; }

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 5% from the bottom and centered */
  width: 100%; /* Could be more or less, depending on screen size */
}

.title {
  font-family:  "arial black";
  display: block;
  font-weight: 300;
  font-size: 80px;
  color: #35495e;
  letter-spacing: 1px;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

a:link, a:visited {
  color: (internal value);
  text-decoration: underline;
  text-align: center;
  cursor: auto;
}

a:link:active, a:visited:active {
  color: (internal value);
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

.labelcss{
  display: inline-block;
  text-align:right;
  vertical-align: top;
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
  
  a.menu_links { cursor: pointer; }
  
/* Set a style for all buttons */
button {
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin-top:15px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
}

</style>
<title>Comet</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="loader" class="center"></div> 
<form action="semak.php" method="post" action="semak.php?id=<?php if (isset($_GET['id'])){echo $_GET['id'];} ?>" enctype="multipart/form-data">
		<?php 
		 $_SESSION['done']="submit";
		$penarafan = 0;
			if ($_POST['pemindahan_ilmu'] == "ya"){
				$penarafan++;
			} 
			
			if ($_POST['Penglibatan_Organisasi_Luar'] != ""){
				$penarafan++;
			}
			
			$strtotime = strtotime($_POST['mula']); 
			$strtotime=$strtotime + 15638397;
			?>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['penglibatan']; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="id" class="border px-4 py-2 width" type="text" value="<?php echo $id ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sixmnth" class="border px-4 py-2 width" type="text" value="<?php echo $strtotime;?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="nama_projek" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['nama_projek']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="negeri" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['negeri']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="lokasi" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['lokasi']; ?>">
        <input type="hidden" style="height:35px" placeholder="project name" id="name" name="Penglibatan_Organisasi_Luar[]" class="border px-4 py-2 width" type="text" value="<?php foreach ($_POST['Penglibatan_Organisasi_Luar'] as $tmp){echo $tmp;} ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sumbangan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['sumbangan']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="tarikh_mula" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['mula']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="tarikh_tamat" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['tamat']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="s/o" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['S/O_kod']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pemindahan_ilmu" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['pemindahan_ilmu']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pendahuluan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['pendahuluan']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="latarbelakang" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['latarbelakang']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="objektif" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['objektif']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sdg" class="border px-4 py-2 width" type="text" value="<?php $n=1; foreach ($_POST['sdg'] as $penglibatan){  echo $n.")". $penglibatan." "; $n++;} ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="skop" class="border px-4 py-2 width" type="text" value="<?php $i=1; foreach ($_POST['skop'] as $skop){  echo $i.")". $skop." "; $i++;} ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pelaksanaan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['pelaksanaan']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penilaian" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['penilaian']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="staff" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['staff']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="nama" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['nama']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="organisasi" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['organisasi']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="status" class="border px-4 py-2 width" type="text" value="Pending">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="skopt" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['skopt']; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan_komuniti" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["penglibatan_komuniti"]; ?>"></td>
		<input type ="hidden" name="penarafan" value="<?php if($_POST['penglibatan_komuniti'] == 'ya'){ echo "3"; } else{ echo $penarafan." Bintang"; } ?>" ></input>
<div class="container"  style=" width: 1000px;">
<div class="modal-content" style="display: inline-block;width: auto ">

         <div class="px-6 py-4" style="margin:20px"><p class="text-right" style ='font-family:verdana;margin:4px' >Pendaftaran Projek Baru</p>
      <div class="px-6 py-4" style="margin-left:20px">
          <div class="img">
            <img class="img2 border" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="200" height="200"> 
            <span class="text-left">Nama: <?php echo $_SESSION['name']; ?>
            <br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat']; ?></span>
          </div>
          <p class="text-left ml-5" style="font-weight:bold">Nama Projek&nbsp;&nbsp;&nbsp;&nbsp;:  <?php echo $_POST['nama_projek']; ?> </p>
        <div class="flex mt-2">
            <label style="display: inline-block;text-align:left;vertical-align: top; float:left" for="table" class="text-left ml-5">Senarai Semak:&nbsp;</label>
            <table class="table-auto ml-2" id="table">
            <tr><input type="hidden" name="no_kerjasama" value="<?php echo $no_kerjasama ?>" /> 
            <td style="vertical-align: middle" class="text-left ml-2">Surat / Emel Persetujuan  Kerjasama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><input onclick="return false" id="Kerjasama" style="vertical-align: middle;" type="checkbox" <?php if(isset($kerjasama)){echo "checked";}?> ></input><input  type="file" accept="application/pdf,application/vnd.ms-excel" style="display:none;background-color:#4d8cf2;padding:8px;color" onchange="check()" name="kerjasama" value="<?php if(isset($_SESSION['id'])){echo $kerjasama;}?>" id="kerjasama" class="inputfile" <?php if(isset($_SESSION['id'])){}else{echo "required";}?> >
			<label  id="label" style="background-color:#4d8cf2;padding:8px;color:#fff;border: 2px solid #9ec3ff;border-radius:9px;margin-top:20px;cursor:pointer;" for="kerjasama" required><i class="glyphicon glyphicon-open" required></i>&nbsp;Muatnaik dokumen</label></td></tr>
            <tr><input type="hidden" name="no_sokongan" value="<?php echo $no_sokongan ?>" /> 
                <td class="text-left ml-2">Lain-lain dokumen sokongan (jika ada)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><input id="csokongan" style="vertical-align: middle;" onclick="return false" type="checkbox" <?php if(isset($sokongan)){echo "checked";}?>></input><input value="<?php echo $kerjasama?>" type="file" accept="application/pdf,application/vnd.ms-excel" style="display:none;background-color:#4d8cf2;padding:8px;color" value="<?php echo $sokongan?>" onchange="check()" name="sokongan" id="sokongan" class="inputfile" >
			<input type="hidden" name="new" value="1" /><label  id="label" style="background-color:#4d8cf2;padding:8px;color:#fff;border: 2px solid #9ec3ff;border-radius:9px;margin-top:20px;cursor:pointer;" for="sokongan" required><i class="glyphicon glyphicon-open" required></i>&nbsp;Muatnaik dokumen</label></td></tr><input type="hidden" name="no_milestone" value="<?php echo $no_milestone ?>" /> 
                <td class="text-left ml-2">Milestone (excel)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><input id="cmilestone" style="vertical-align: middle;" type="checkbox" onclick="return false" <?php if(isset($milestone)){echo "checked";}?>></input><input value="<?php if(isset($_SESSION['id'])){echo $milestone;}?>" type="file" accept="application/pdf,application/vnd.ms-excel" style="display:none;background-color:#4d8cf2;padding:8px;color" onchange="check()" name="milestone" id="milestone" class="inputfile" <?php if(isset($_SESSION['id'])){}else{echo "required";}?>>
			<input type="hidden" name="new" value="1" /><label  id="label" style="background-color:#4d8cf2;padding:8px;color:#fff;border: 2px solid #9ec3ff;border-radius:9px;margin-top:20px;cursor:pointer;" for="milestone" required><i class="glyphicon glyphicon-open" required></i>&nbsp;Muatnaik dokumen</label></td></tr>
           </table>
           <p style="color:red" id="msg"></p>
            
        </div>
        </div>
		<button style=" background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer; border-radius:4px"<?php if (!isset($_SESSION['id'])){ echo "onclick=\"validate()\"";} else {echo "onclick=\"load()\"";}?> type="submit" name="save" value="save" >Simpan</button>
		<a style="background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;display: inline-block;border-radius:4px" href="index.php">Batal</a>      </div>
    </div>
	</form>
	</div>

  <script>
	
  
	
	function validate(){
	if(document.getElementById("kerjasama").value == "") {
                document.getElementById('msg').innerHTML = "Sila pilih dokumen kerjasama untuk dimuat naik!";
    }
	if(document.getElementById("milestone").value == "") {
		document.getElementById('msg').innerHTML = "Sila pilih dokumen milestone untuk dimuat naik!";
    }
	if(document.getElementById("milestone").value != "" && document.getElementById("kerjasama").value != "") {
		load();
    } 
 }
	
	function load()
	{
		document.querySelector( 
			"body").style.visibility = "hidden"; 
			document.querySelector( 
			"#loader").style.visibility = "visible"; 
	}
	
	function check(){
		if(document.getElementById("kerjasama").value != "") {
			document.getElementById("Kerjasama").checked="true";
		}if(document.getElementById("sokongan").value != "") {
			document.getElementById("csokongan").checked="true";
		}if(document.getElementById("milestone").value != "") {
			document.getElementById("cmilestone").checked="true";
		}
	}
		window.onload = function() {
			$(document.getElementById("Kerjasama").click(function() { return false; }));
		};
	
	
	</script>
</body>
</html>



<style>
        #loader { 
            border: 12px solid #f3f3f3; 
            border-radius: 50%; 
            border-top: 12px solid #444444; 
            width: 70px; 
            height: 70px; 
            animation: spin 1s linear infinite; 
        } 
          
        @keyframes spin { 
            100% { 
                transform: rotate(360deg); 
            } 
        } 
          
        .center { 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            margin: auto; 
        } 

    input[type=button]{
        background-color: #2196F3;
         border: none;
        color: white;
        padding: 4px 8px;
        text-decoration: none;
        margin: 0px 2px;
        cursor: pointer;
    }

  form.example button {
    float: left;
    width: 20%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
  }

  p.c {
    text-align: right;
    margin-right: 10px;
    margin-bottom: 10px;
  }

  .width{
    width: 100%
  }

  .width*{
    width: 100%
  }

  .rule{
    margin-left: 590px;
  }
  .btn{
    margin-bottom: 20px;
    margin-top: 20px;
  }
  .dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }

  .dropdown-content a:hover {
    background-color: blue;
  }

  .dropdown-content a:hover, .dropdown:hover .dropbtn {
    display: block;
    background-color: red;
    margin-top: 0;
  }

  .dropdown  {
    font-size: 16px;
    border: none;
    outline: none;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
  }
  .chkbox {
    margin-right: 20px;
  }
  .img2 {
    margin-top:0px;
    margin-left:10px;
    margin-right:10px;
  }
  .img {
    display: flex;
    align-items:center;
    margin:10px;
  }

  .width{
    width:100%;
  }

  .container {
    margin: 0 auto;
    min-height: 100vh;
    min-width: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }

  .title {
    font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    display: block;
    font-weight: 300;
    font-size: 80px;
    color: #35495e;
    letter-spacing: 1px;
  }
</style>
