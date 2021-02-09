<?php 
include('server.php');

	
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
  
  if($result = mysqli_query($db, "SELECT * FROM users")){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
			$_SESSION['pusat'] = $row['pusat_tanggungjawab'];
		}
	}
  }
  
  

	$id = $_GET['id'];
	$sqll = "SELECT * FROM laporan where id=".$id;
	$sqlp = "SELECT * FROM projects where id=".$id;
	$result = mysqli_query($db, $sqlp);
	while($rows = mysqli_fetch_array($result)){
		$nama_projek = $rows['nama_projek'];
		$status = $rows['status'];
		$penilaian = $rows['penilaian'];
		$cabaran = $rows['cabaran'];
		$cadangan = $rows['cadangan'];
		$status = $rows['status'];
		$tarikhtamat = $rows['tarikh_tamat'];
		$pelaksanaan = $rows['pelaksanaan'];
		$output = $rows['output'];
		$impak = $rows['impak'];
		$penilaian = $rows['penilaian'];
		$kesimpulan = $rows['kesimpulan'];
	}
	$resultl = mysqli_query($db,$sqll);
	while($row = mysqli_fetch_array($resultl)){
		$laporan = $row['file'];
	}
	if($status=="Aktif" && (strtotime($tarikhtamat) > strtotime('now')))
	$id = $_GET['id'];
	
	  if(isset($_POST['rating'])){
	  $stars = $_POST['rating'];
	$sql = "UPDATE projects SET penarafan=$stars WHERE id = $id";
	mysqli_query($db,$sql);
  }
  
	if($status == "Tamat"){
	$sql="SELECT * FROM laporan where id=".$id;
	$result_set=mysqli_query($db,$sql);
	while($row = mysqli_fetch_array($result_set)){
		if(strpos($row['file'],"gambar")){
			$gambar = $row['file'];
		}  if(strpos($row['file'],"kehadiran")){
			$kehadiran = $row['file'];
		}  if(strpos($row['file'],"kerjasama")){
			$kerjasama = $row['file'];
		} if(strpos($row['file'],"lain-lain")){
			$lain_lain = $row['file'];
		}
	}
	}
	
	if(isset($_POST['simpan'])){
		$rating = $_POST['rating']." bintang";
		$sql="UPDATE projects SET penarafan='$rating' WHERE id='$id'";
		mysqli_query($db,$sql);
		echo '<script>alert("Penarafan telah berjaya dikemaskini")</script>'; 
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="http://example.com/favicon.png">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');  background-repeat: no-repeat;
  background-attachment: fixed;}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  width: 97%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
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
}

th{
	text-align:center;
	
}

td{
	text-align:center;
	
}

  a.menu_links { cursor: pointer; }
}

	a:link, a:visited {
  background-color: #00009D;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  opacity: 0.8;
}

a {
  cursor: pointer;
}

/* Set a style for all buttons */
button {
  background-color: #00009D;
  color: white;
  padding: 12px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
}

.star-rating{
	font-size: 0;
}
.star-rating__wrap{
	display: inline-block;
	font-size: 2rem;
}
.star-rating__wrap:after{
	content: "";
	display: table;
	clear: both;
}
.star-rating__ico{
	float: right;
	padding-left: 2px;
	cursor: pointer;
	color: #FFB300;
}
.star-rating__ico:last-child{
	padding-left: 0;
}
.star-rating__input{
	display: none;
	height: 25px;
  width: 25px;
}
.star-rating__ico:hover:before,
.star-rating__ico:hover ~ .star-rating__ico:before,
.star-rating__input:checked ~ .star-rating__ico:before
{
	content: "\f005";
}
</style>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="crudApp" class="container"  style=" width: 1000px;">
  <div class="modal-content">



 <div class="img">
	 <img style="display:inline-block" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="215px" height="220px" style="margin-left:20px"  id="img"></img>
		<p id="detail" style="margin-left:20px" class="text-left">Name: <?php echo $_SESSION['name']; ?><br/>Pusat Tanggungjawab: <?php echo $_SESSION['pusat']?></p>
		</div>
		<br>
		<br>
		<div class="containers">
<div id="body">
	<table  class="table table-bordered  table-sm " style="width:95%;margin-left:auto;margin-right:auto;">
    <tr ><th width="20%">Nama Projek</th><td><?php echo $nama_projek; ?></td></tr>
	<?php if($status == "Aktif" && (strtotime($tarikhtamat) > strtotime('now'))){ ?>
	<tr ><th width="20%">Laporan Kemajuan</th><?php if(isset($laporan)){?>
								<td colspan="3"><a href="uploads/laporan/<?php echo $laporan; ?>" style="cursor:pointer">Laporan</a></td>								
								<?php } else { ?>Dokumen laporan masih belum dimuat naik</td>	
								<?php } ?>
	<tr ><th width="20%">Penilaian</th><td><?php echo $penilaian?></td></tr>
	<tr ><th width="20%">Cabaran/Kekangan</th><td><?php echo $cabaran?></td></tr>
	<tr ><th width="20%">Cadangan penyelesaian</th><td><?php echo $cadangan?></td></tr>
	<?php } else if(($status == "Aktif") && (strtotime($tarikhtamat) < strtotime('now'))){
						$sql="SELECT * FROM laporan where id=".$id;
						$result_set=mysqli_query($db,$sql);
						while($row = mysqli_fetch_array($result_set)){
										if(strpos($row['file'],"kerjasama")){
												$kerjasama = $row['file'];
										}
										if(strpos($row['file'],"persetujuan")){
												$persetujuan = $row['file'];
										}
										if(strpos($row['file'],"kehadiran")){
												$kehadiran = $row['file'];
										}
										if(strpos($row['file'],"gambar")){
												$gambar = $row['file'];
										}
										if(strpos($row['file'],"kemajuan")){
												$laporan = $row['file'];
										}
										if(strpos($row['file'],"lain-lain")){
												$lain_lain = $row['file'];
										}
									}
							if(strtotime($rows['tarikh_tamat']) < strtotime('now')){ 
							if(isset($gambar)){ ?>
								<tr><th>Pelaksanaan</th><td><?php echo $pelaksanaan;?></tr>
								<tr><th>Output</th><td><?php echo $output;?></td></tr>
								<tr><th>Impak</th><td><?php echo $impak;?></td></tr>
								<tr><th>Penilaian</th><td><?php echo $penilaian; ?></td></tr>
								<tr><th>Kesimpulan</th><td><?php echo $kesimpulan; ?></td></tr>
								<tr><th colspan="4">Senarai semak</th></tr>
								<tr><td colspan="2"><a href="uploads/bukti/kerjasama/<?php echo $kerjasama; ?>" style="cursor:pointer;text-decoration:none;float:left;margin-left:40px">Surat Persetujuan Kerjasama</a><a style="cursor:pointer;text-decoration:none;float:left;margin-left:135px"  href="uploads/bukti/kehadiran/<?php echo $kehadiran; ?>">Senarai Kehadiran</a><a href="uploads/bukti/lain-lain/<?php echo $lain_lain; ?>" style="cursor:pointer;text-decoration:none;float:right;margin-right:80px">lain-lain</a><a style="cursor:pointer;text-decoration:none;float:left;margin-left:90px" href="imageindex.php?id=<?php echo $id; ?>">Gambar</a></td></tr>
								<tr><th>Penarafan</th><td><div class="star-rating">
								<form method="POST" action="view_laporan.php?id=<?php echo $id; ?>" >
								<div class="star-rating__wrap">
								<?php $sql="SELECT * FROM projects WHERE id='".$id."'";
									$result = mysqli_query($db,$sql);
									$row = mysqli_fetch_array($result);
									$ratings = $row['penarafan']; 
									?>
									<form method="post" name="form" action="view_laporan.php?id=<?php echo $id; ?>">
									<input class="star-rating__input" id="star-rating-5" type="radio" name="rating" onchange="this.form.submit()" value="5" <?php if (strpos($ratings,"5") !== false){ echo "checked";} ?>>
									<label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
									<input class="star-rating__input" id="star-rating-4" type="radio" name="rating" onchange="this.form.submit()" value="4" <?php if (strpos($ratings,"4") !== false){ echo "checked";} ?>>
									<label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
									<input class="star-rating__input" id="star-rating-3" type="radio" name="rating" onchange="this.form.submit()" value="3" <?php if (strpos($ratings,"3") !== false){ echo "checked";} ?>>
									<label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
									<input class="star-rating__input" id="star-rating-2" type="radio" name="rating" onchange="this.form.submit()" value="2" <?php if (strpos($ratings,"2") !== false){ echo "checked";} ?>>
									<label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
									<input class="star-rating__input" id="star-rating-1" type="radio" name="rating" onchange="this.form.submit()" value="1" <?php if (strpos($ratings,"1") !== false){ echo "checked";} ?>>
									<label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
									</form>
								</div>
								</div></td></tr>
							<?php }}} else if($status == "Tamat") { ?>
								<tr ><th width="20%">Pelaksanaan</th><td colspan="3"><?php $pelaksanaan ?></td>								
								<tr ><th width="20%">Output</th><td><?php echo $output?></td></tr>
								<tr><th width="20%">Impak</th><td><?php echo $impak?></td></tr>
								<tr ><th width="20%">Penilaian</th><td><?php echo $penilaian?></td></tr>
								<tr ><th width="20%">Kesimpulan</th><td><?php echo $kesimpulan?></td></tr>
								<tr ><th colspan="2" width="20%">Dokumen bukti</th></tr>
								<tr><td colspan="2"><a style="cursor:pointer;text-decoration:none;float:left;margin-left:60px" href="uploads/bukti/kerjasama/<?php echo $kerjasama; ?>">surat persetujuan kerjasama</a><a style="cursor:pointer;text-decoration:none;float:left;margin-left:90px" href="imageindex.php">Gambar</a><a style="text-decoration:none;cursor:pointer" href="uploads/bukti/kehadiran/<?php echo $kehadiran; ?>">senarai kehadiran</a><a style="cursor:pointer;text-decoration:none;float:right;margin-right:60px" href="uploads/bukti/lain-lain/<?php echo $lain_lain; ?>">lain-lain</a></td></tr>
														<?php }?>
								</table>
								<div align="center" style="margin:20px">
								</form>
								<a style="cursor:pointer;border-radius:4px;background-color:#00009D;color:white;padding: 14px 20px;margin: 8px 0;" href="view.php?id=<?php echo $id; ?>">Kembali</a>
								</div>
</div>
</body>
</html>
<script>

	function star5(stars){
		window.alert(stars);
		<?php 
		$sql = "UPDATE projects SET penarafan = 5 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql); exit();?>
		exit();
	}
	function star4(stars){
		window.alert(stars);
		<?php 
		$sql = "UPDATE projects SET penarafan = 4 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql); exit();?>
		exit();
	}
	function star3(stars){
		window.alert(stars);
			<?php 
		$sql = "UPDATE projects SET penarafan = 3 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql); exit();?>
		exit();
	}
	function star2(stars){
		window.alert(stars);
		<?php 
		$sql = "UPDATE projects SET penarafan = 2 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql);exit();?>
		exit();
	}
	function star1(stars){
		window.alert(stars);
		<?php 
		$sql = "UPDATE projects SET penarafan = 1 WHERE id=".$_GET['id']."";
		mysqli_query($db,$sql);exit();?>
		exit();
	}
</script>