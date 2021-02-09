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
	$_SESSION['id'] = $id;
	$sqlp = "SELECT * FROM projects where id=".$id;
	$result = mysqli_query($db, $sqlp);
	while($rows = mysqli_fetch_array($result)){
		$status = $rows['status'];
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="http://example.com/favicon.png">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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


</style>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="crudApp" class="container"  style=" width: 95%;">
  <div class="modal-content">



 <div id="div" align="center" class="img">
	 <img style="display:inline-block" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="215px" height="220px" style="margin-left:20px"  id="img"></img>
		<p id="detail" style="margin-left:20px" class="text-left">Name: <?php echo $_SESSION['name']; ?><br/>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></p>
		</div>
		<div id="divhead"></div>
		<br>
		<br>
		<div class="containers">
<div id="body">
<div class="table-responsive" >
 <table id="tables" class="table table-bordered table-sm" style="width:95%;margin-left:auto;margin-right:auto;"  >
    
    <?php
			$result = mysqli_query($db, $sqlp);
			$rows = mysqli_fetch_array($result);
			
					$nama_projek = str_replace(' ', '_', $rows['nama_projek']);
					
							?>
					
							<tr>
							<th>Nama Projek</th>
							<td colspan="3"><?php echo $rows['nama_projek'] ?></td>
							</tr>
							<tr >
							<th >Pendahuluan</th>
							<td  colspan="3"><?php echo $rows['pendahuluan'] ?></td>
							</tr>
							<tr >
							<th >Latarbelakang</th>
							<td  colspan="3"><?php echo $rows['latarbelakang'] ?></td>
							</tr>
							<tr >
							<th >Objektif</th>
							<td  colspan="3"><?php echo $rows['objektif'] ?></td>
							</tr>
							<tr >
							<th >Pelaksanaan</th>
							<td  colspan="3"><?php echo $rows['pelaksanaan'] ?></td>
							</tr>
							<tr >
							<th >Pra-penilaian</th>
							<td  colspan="3"><?php echo $rows['pra_penilaian'] ?></td>
							</tr>
							
							<tr>
							<tr>
							<tr>
							<th>Skop</th>
							<td colspan="3"><?php echo $rows['skop'] ?></td>
							</tr>
							<tr >
							<th>SDG</th>
							<td colspan="3"><?php echo $rows['sdg'] ?></td>
							</tr>
							<tr>
							<th>Tarikh Mula</th>
							<td><?php echo $rows['tarikh_mula'] ?></td>
							<th>Penarafan</th>
							<td><?php echo $rows['penarafan'] ?></td>
							
							</tr>
							<tr>
							<th>Tarikh Tamat</th>
							<td><?php echo $rows['tarikh_tamat'] ?></td>
							<th>Negeri</th>
							<td><?php echo $rows['negeri'] ?></td>
							
							</tr>
							<tr>
							<th>Lokasi</th>
							<td><?php echo $rows['lokasi'] ?></td>
							<th>Penglibatan Organisasi Luar</th>
							<td ><?php echo $rows['penglibatan'] ?></td>
							</tr>
							<tr>
							<th>Sumbangan</th>
							<td><?php echo $rows['sumbangan'] ?></td>
							<th>S/O Kod</th>
							<td><?php echo $rows['so'] ?></td>
						
							</tr>
							<tr>
							<th>Pemindahan Ilmu</th>
							<td><?php echo $rows['pemindahan'] ?></td>
							<th>AJK</th>
							<td><a style="cursor:pointer;text-decoration:none" href="stafflist.php?name=<?php echo $nama_projek ?>"> SENARAI AJK  </a></td>
							</tr>
							<?php
			
		
			if($status == "Pending"){
			$sql="SELECT * FROM laporan where id=".$id;
			$result_set=mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result_set)){
				if(strpos($row['file'],"kerjasama")){
					$kerjasama = $row['file'];
				} else if(strpos($row['file'],"sokongan")){
					if($row['size'] == 0){$sokongan = 0;} else {
					$sokongan = $row['file'];}
				} else if(strpos($row['file'],"milestone")){
					$milestone = $row['file'];
				}
			}
			?>
			<tr><th>Dokumen</th><td><a href="uploads/semak/kerjasama/<?php echo $kerjasama; ?>" style="cursor:pointer;text-decoration:none">Surat Persetujuan Kerjasama</a></td><td ><?php if ($sokongan ==0){echo "tiada dokumen sokongan";} else{?><a style="cursor:pointer;text-decoration:none" href="uploads/semak/sokongan/<?php echo $sokongan ?>" >Dokumen Sokongan</a><?php }?></td><td><a href="uploads/semak/milestone/<?php echo $milestone ?>" style="cursor:pointer;text-decoration:none">Milestone</a></td></tr>
			</table>
			</div>
			<div align="center" style="margin:20px">
			<form method="POST" action="server.php">
			<input type="hidden" name="id_lulus" value="<?php echo $id; ?>" ></input>
			<button type="submit" name="lulus" value="Aktif" style="border-radius:4px">Lulus</button>
			<a style="cursor:pointer;border-radius:4px;background-color:#00009D;color:white;padding: 14px 20px;margin: 8px 0;text-decoration:none" href="index.php">Kembali</a>
			</form>
			</div>
			<?php } else if($status == "Tamat"){
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
				}?>
						<tr><td colspan="4"><a style="cursor:pointer;text-decoration:none" href="view_laporan.php?id=<?php echo $id ?>">Senarai Semak</a></td></tr>
						</table>
						</div>
						<div align="center" style="margin:20px">
						<form method="POST">
						<a style="cursor:pointer;border-radius:4px;background-color:#00009D;color:white;padding: 14px 20px;margin: 8px 0;" href="index.php">Kembali</a>
						</form>
						</div>
					<?php } else if($status == "Aktif"){
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
								<tr><th colspan="4"><a style="cursor:pointer;text-decoration:none" href="view_laporan.php?id=<?php echo $id ?>">Senarai semak</a></th></tr>
							<?php } else { ?>
								<tr><th>Bukti Program</th><td colspan="3">Dokumen masih belum dimuat naik</td></tr>
							<?php } ?>
								</table>
								<div align="center" style="margin:20px">
								<form method="post" action="server.php">
								<button type="submit" name="sah_tamat" value="Tamat" style="border-radius:4px">Sah Tamat</button>
								<a style="cursor:pointer;border-radius:4px;background-color:#00009D;color:white;padding: 14px 20px;margin: 8px 0;" href="index.php">Kembali</a>
								<input type="hidden" name="id_tamat" value="<?php echo $id; ?>" ></input>
								</form>
							<?php } else { 
								if(isset($laporan)){?>
								<tr><th>Laporan</th><td colspan="3"><a href="view_laporan.php?id=<?php echo $id ?>"style="cursor:pointer">Laporan</a></td>								
								<?php } else { ?>
								<tr><th>Laporan</th><td colspan="3">Dokumen laporan masih belum dimuat naik</td>	
								<?php } ?>
								</table>
								</div>
								<div align="center" style="margin:20px">
								<form method="POST" >
								<a style="cursor:pointer;border-radius:4px;background-color:#00009D;color:white;padding: 14px 20px;margin: 8px 0;" href="index.php">Kembali</a>
								</form>
								</div>
					<?php }} ?>
</div>
</body>
<script>
window.onload = function() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        var img = document.getElementById("img");
        var detail = document.getElementById("detail");
        var div = document.getElementById("div");
        var divhead = document.getElementById("divhead");
        var logout = document.getElementById("logout");
        var col = document.getElementById("projek_id");
        var btn = document.getElementsByName("btn1");
        document.getElementById("detail").style.display = "none";
        document.getElementById("img").style.marginTop = "50px";
		document.getElementById("crudApp").style.width = "90%";
		document.getElementById("tables").style.width = "5px";
		document.getElementById("tables").style.margin-left = "auto";
		document.getElementById("tables").style.margin-right = "auto";
        img.style.height = "180px";
        img.style.width = "170px";
        div.className = "";
        div.innerHTML = "<div align='center'>" + div.innerHTML + "</div>";
        detail.innerHTML = "<p style='text-align:center' >" + detail.innerHTML;
        divhead.innerHTML += "<br>" + "\n" + detail.innerHTML + "</br>";
        detail.style.width = "100%";

        //document.write("mobile");
    } else {
        var detail = document.getElementById("detail").style.display = "block";
    }
}
</script>
</html>