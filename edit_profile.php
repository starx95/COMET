<?php 
include('server.php');
/*if(isset($_SESSION['msg']) && $_SESSION['msg'] == "Sila kemaskini butiran anda terlebih dahulu"){
	 ?><script>
	 window.alert("Sila kemaskini butiran anda terlebih dahulu");
	</script>
	<?php unset($_SESSION['msg']); 
}*/
// UPDATE USER
if (isset($_POST['upd_user'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db,$_POST['name']);
  $_SESSION['name'] = $name;
  if(isset($_POST['kata'])){
  $pw= mysqli_real_escape_string($db,md5($_POST['kata']));
  }
  $ext = mysqli_real_escape_string($db, $_POST['ext']);
  $pst = mysqli_real_escape_string($db, $_POST['pst']);

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if(isset($_POST['id'])){
 if($result = mysqli_query($db, "SELECT * FROM users WHERE id='".$_POST['id']."'")){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
			$img = $row['img'];
  }}}}
    if ($user['email'] === $email && $user['id'] === $_POST['id']) {
		
    } else if ($user['email'] === $email){
		echo "<script>alert('email already exist');</script>";
      array_push($errors, "email already exists");
	}
  
  if (count($errors) == 0) {
	  if(!$_FILES['pic']['name']){
		  $pic = $img;
	  } else {
		  $pic = $_POST['id']." profil-pic ".$nama."-". $_FILES['pic']['name'];
	  }
	$id = $_POST['id'];
	$file_loc = $_FILES['pic']['tmp_name'];
	$file_size = $_FILES['pic']['size'];
	$file_type = $_FILES['pic']['type'];
	if($_POST['kata'] == ""){
  	$query = "UPDATE users SET img = '$pic', name='$name',ext='$ext',pusat_tanggungjawab='$pst' WHERE id='$id'";
	} else {
	$query = "UPDATE users SET img = '$pic', name='$name', password='$pw', ext='$ext',pusat_tanggungjawab='$pst' WHERE id='$id'";
	}
  	if(mysqli_query($db, $query))
	{
		echo "<script>alert('Profile Successfuly Updated');</script>";
		// Upload file
		//upload profile pic to the server
		if(isset($_FILES['pic'])){
		move_uploaded_file($_FILES['pic']['tmp_name'],'uploads/profil/'.$pic);
		}
		header('location: index.php');
	}
  }
  
} else {
		if($result = mysqli_query($db, "SELECT * FROM users WHERE id='".$_GET['id']."'")){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
			$pst = $row['pusat_tanggungjawab'];
			$img = $row['img'];
			$name = $row['name'];
			$email = $row['email'];
			$ext = $row['ext'];
		}
	}
  }
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
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');background-repeat: no-repeat;
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
button {
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 97%;
}

a {
  display: block;
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  border: none;
  cursor: pointer;
  width: 97%;
  text-align:center;  
}

a:hover {
  text-decoration: none;
  color:white;
  opacity: 0.8;
}

button:hover {
  opacity: 0.8;
}

i:hover {
  opacity: 0.8;
}

.hover:hover {
  opacity: 0.8;
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

img.avatar {
  width: 40%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

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
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
 
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
  
  .error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
  
#img {
	border:1px solid #ff7979;
	padding: 10px;
	margin: 20px;
	width: 100px;
}
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}

#label:hover{
	background-color:#3b73ce;
	border-color:#729fe7;
	cursor:pointer;
}
</style>
</head>
<body>

<div id="id01" class="container">
  
  <form enctype="multipart/form-data" class="modal-content " action="edit_profile.php" method="post">
	<div class="container">
		<h1 style="text-align:center">Ubahsuai Profil</h1>
		<div align="center">
		<img src="<?php echo "uploads/profil/". $img ?>" width="215px" height="220px"  id="img"><br>
		<input type="file" accept="image/*" style="display:none;background-color:#4d8cf2;padding:8px;color" onchange="preview(event)" name="pic" id="pic" class="inputfile" >
		<label class="hover" id="label" style="background-color:#4d8cf2;padding:8px;color:#fff;border: 2px solid #9ec3ff;border-radius:9px;margin-top:20px;cursor:pointer;" for="pic" ><i class="glyphicon glyphicon-open" ></i>&nbsp;Pilih Gambar...</label><br>
		<p style="color:red" id="msg"></p>
		</div>
		<label for="name"><b>Nama</b></label>
		<input type="text" placeholder="Masukkan nama" name="name" id="name" value="<?php echo $name; ?>" required>
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></input>
		<label style="display:none" for="email"><b>Email</b></label>
		<input style="display:none" type="email" placeholder="Masukkan Email" name="email" id="email" value="<?php echo $email; ?>" required>
		</br>
		<label for="kata"><b>Kata laluan</b></label>
		</br>
		<input type="password" placeholder="Masukkan kata laluan jika anda ingin mengubahnya" name="kata" id="kata" >
		<br>
		<label for="ext"><b>Ext</b></label>
		</br>
		<input type="text" placeholder="Masukkan Ext" name="ext" id="ext" value="<?php echo $ext; ?>" required>
		</br>
		<label for="pst"><b>Pusat Tanggungjawab</b></label>
		<select id="pst" name="pst" class="border px-12 py-2" style="height: 50px;width: 97%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;" id = "myList">
			<option value = "Perpustakaan Sultanah Bahiyah" <?php if($pst == "Perpustakaan Sultanah Bahiyah"){ echo 'selected';} ?>>Perpustakaan Sultanah Bahiyah</option>			  
			<option value = "Pusat Pengajian Pengurusan Perniagaan (SBM),UUM COB" <?php if($pst == "Pusat Pengajian Pengurusan Perniagaan (SBM),UUM COB"){ echo 'selected';} ?>>Pusat Pengajian Pengurusan Perniagaan (SBM),UUM COB</option>			  
			<option value = "Pusat Pengajian Pengkomputeran (SOC), UUM CAS" <?php if($pst == "Pusat Pengajian Pengkomputeran (SOC), UUM CAS"){ echo 'selected';} ?>>Pusat Pengajian Pengkomputeran (SOC), UUM CAS</option>			  
			<option value = "Pusat Pengajian Antarabangsa (SOIS),UUM COLGIS" <?php if($pst == "Pusat Pengajian Antarabangsa (SOIS),UUM COLGIS"){ echo 'selected';} ?>>Pusat Pengajian Antarabangsa (SOIS),UUM COLGIS</option>			  
			<option value = "Jabatan Canselori" <?php if($pst == "Jabatan Canselori"){ echo 'selected';} ?>>Jabatan Canselori</option>			  
			<option value = "Jabatan Strategik & Pembangunan Perniagaan (BSD)" <?php if($pst == "Jabatan Strategik & Pembangunan Perniagaan (BSD)"){ echo 'selected';} ?>>Jabatan Strategik & Pembangunan Perniagaan (BSD)</option>			  
			<option value = "UUMKL Kampus" <?php if($pst == "UUMKL Kampus"){ echo 'selected';} ?>>UUMKL Kampus</option>			  
			<option value = "Pusat Pengajian Perniagaan Islam (IBS)" <?php if($pst == "Pusat Pengajian Perniagaan Islam (IBS)"){ echo 'selected';} ?>>Pusat Pengajian Perniagaan Islam (IBS)</option>			  
			<option value = "Othman Yeop Abdullah Graduate School of Business (OYAGSB)" <?php if($pst == "Othman Yeop Abdullah Graduate School of Business (OYAGSB)"){ echo 'selected';} ?>>Othman Yeop Abdullah Graduate School of Business (OYAGSB)</option>			  
			<option value = "Pusat Pengajian Ekonomi, Kewangan dan Perbankan (SEFB)" <?php if($pst == "Pusat Pengajian Ekonomi, Kewangan dan Perbankan (SEFB)"){ echo 'selected';} ?>>Pusat Pengajian Ekonomi, Kewangan dan Perbankan (SEFB)</option>			  
			<option value = "Pusat Pengajian Perakaunan Tunku Puteri Intan Shafinaz (TISSA)" <?php if($pst == "Pusat Pengajian Perakaunan Tunku Puteri Intan Shafinaz (TISSA)"){ echo 'selected';} ?>>Pusat Pengajian Perakaunan Tunku Puteri Intan Shafinaz (TISSA)</option>			  
			<option value = "Pusat Pengajian Pengurusan Teknologi dan Logistik (STML)" <?php if($pst == "Pusat Pengajian Pengurusan Teknologi dan Logistik (STML)"){ echo 'selected';} ?>>Pusat Pengajian Pengurusan Teknologi dan Logistik (STML)</option>			  
			<option value = "Ghazali Shafie Graduate School of Government  (GSGSG)" <?php if($pst == "Ghazali Shafie Graduate School of Government  (GSGSG)"){ echo 'selected';} ?>>Ghazali Shafie Graduate School of Government  (GSGSG)</option>			  
			<option value = "Pusat Pengajian Undang-Undang (SOL)" <?php if($pst == "Pusat Pengajian Undang-Undang (SOL)"){ echo 'selected';} ?>>Pusat Pengajian Undang-Undang (SOL)</option>			  
			<option value = "Pusat Pengajian Pengurusan Pelancongan, Hospitaliti & Acara (STHEM)" <?php if($pst == "Pusat Pengajian Pengurusan Pelancongan, Hospitaliti & Acara (STHEM)"){ echo 'selected';} ?>>Pusat Pengajian Pengurusan Pelancongan, Hospitaliti & Acara (STHEM)</option>			  
			<option value = "Pusat Pengajian Kerajaan (SOG)" <?php if($pst == "Pusat Pengajian Kerajaan (SOG)"){ echo 'selected';} ?>>Pusat Pengajian Kerajaan (SOG)</option>			  
			<option value = "Pusat Pengajian Sains Kuantitatif (SQS)" <?php if($pst == "Pusat Pengajian Sains Kuantitatif (SQS)"){ echo 'selected';} ?>>Pusat Pengajian Sains Kuantitatif (SQS)</option>			  
			<option value = "Awang Had Salleh Graduate School Of Arts and Sciences (AHSGS)" <?php if($pst == "Awang Had Salleh Graduate School Of Arts and Sciences (AHSGS)"){ echo 'selected';} ?>>Awang Had Salleh Graduate School Of Arts and Sciences (AHSGS)</option>			  
			<option value = "Pusat Pengajian Teknologi Multimedia dan Komunikasi (SMMTC)" <?php if($pst == "Pusat Pengajian Teknologi Multimedia dan Komunikasi (SMMTC)"){ echo 'selected';} ?>>Pusat Pengajian Teknologi Multimedia dan Komunikasi (SMMTC)</option>			  
			<option value = "Pusat Pengajian Pendidikan dan Bahasa Moden (SEML)" <?php if($pst == "Pusat Pengajian Pendidikan dan Bahasa Moden (SEML)"){ echo 'selected';} ?>>Pusat Pengajian Pendidikan dan Bahasa Moden (SEML)</option>			  
			<option value = "Pusat Pengajian Pengurusan Industri Kreatif dan Seni Persembahan (SCIMPA)" <?php if($pst == "Pusat Pengajian Pengurusan Industri Kreatif dan Seni Persembahan (SCIMPA)"){ echo 'selected';} ?>>Pusat Pengajian Pengurusan Industri Kreatif dan Seni Persembahan (SCIMPA)</option>			  
			<option value = "Pusat Pengajian Psikologi Gunaan, Dasar & Kerja Sosial (SAPSP)" <?php if($pst == "Pusat Pengajian Psikologi Gunaan, Dasar & Kerja Sosial (SAPSP)"){ echo 'selected';} ?>>Pusat Pengajian Psikologi Gunaan, Dasar & Kerja Sosial (SAPSP)</option>			  
			<option value = "Pusat Pengajian Bahasa, Tamadun dan Falsafah (SLCP)" <?php if($pst == "Pusat Pengajian Bahasa, Tamadun dan Falsafah (SLCP)"){ echo 'selected';} ?>>Pusat Pengajian Bahasa, Tamadun dan Falsafah (SLCP)</option>			  
			<option value = "Jabatan Keselamatan" <?php if($pst == "Jabatan Keselamatan"){ echo 'selected';} ?>>Jabatan Keselamatan</option>			  
			<option value = "Jabatan Pembangunan dan Penyenggaraan (JPP)" <?php if($pst == "Jabatan Pembangunan dan Penyenggaraan (JPP)"){ echo 'selected';} ?>>Jabatan Pembangunan dan Penyenggaraan (JPP)</option>			  
			<option value = "Jabatan Hal Ehwal Akademik (JHEA)" <?php if($pst == "Jabatan Hal Ehwal Akademik (JHEA)"){ echo 'selected';} ?>>Jabatan Hal Ehwal Akademik (JHEA)</option>			  
			<option value = "Hal Ehwal Pelajar " <?php if($pst == "Hal Ehwal Pelajar "){ echo 'selected';} ?>>Hal Ehwal Pelajar </option>			  
			<option value = "U-Assist" <?php if($pst == "U-Assist"){ echo 'selected';} ?>>U-Assist</option>			  
			<option value = "Pusat Kaunseling" <?php if($pst == "Pusat Kaunseling"){ echo 'selected';} ?>>Pusat Kaunseling</option>			  
			<option value = "Pusat Alumni" <?php if($pst == "Pusat Alumni"){ echo 'selected';} ?>>Pusat Alumni</option>			  
			<option value = "Pusat Inovasi dan Pengkomersilan (ICC)" <?php if($pst == "Pusat Inovasi dan Pengkomersilan (ICC)"){ echo 'selected';} ?>>Pusat Inovasi dan Pengkomersilan (ICC)</option>			  
			<option value = "Pusat Sukan" <?php if($pst == "Pusat Sukan"){ echo 'selected';} ?>>Pusat Sukan</option>			  
			<option value = "Pusat Pendidikan Profesional dan Lanjutan (PACE)" <?php if($pst == "Pusat Pendidikan Profesional dan Lanjutan (PACE)"){ echo 'selected';} ?>>Pusat Pendidikan Profesional dan Lanjutan (PACE)</option>			  
			<option value = "Pusat Pengujian, Pengukuran dan Penilaian (CeTMA)" <?php if($pst == "Pusat Pengujian, Pengukuran dan Penilaian (CeTMA)"){ echo 'selected';} ?>>Pusat Pengujian, Pengukuran dan Penilaian (CeTMA)</option>			  
			<option value = "Pusat Pengurusan Penyelidikan dan Inovasi (RIMC)" <?php if($pst == "Pusat Pengurusan Penyelidikan dan Inovasi (RIMC)"){ echo 'selected';} ?>>Pusat Pengurusan Penyelidikan dan Inovasi (RIMC)</option>			  
			<option value = "Pusat Asasi Pengurusan (PAP)" <?php if($pst == "Pusat Asasi Pengurusan (PAP)"){ echo 'selected';} ?>>Pusat Asasi Pengurusan (PAP)</option>			  
			<option value = "Pusat Kokurikulum (Ko-K)" <?php if($pst == "Pusat Kokurikulum (Ko-K)"){ echo 'selected';} ?>>Pusat Kokurikulum (Ko-K)</option>			  
			<option value = "Pusat Pengajaran Pembelajaran Universiti (UTLC)" <?php if($pst == "Pusat Pengajaran Pembelajaran Universiti (UTLC)"){ echo 'selected';} ?>>Pusat Pengajaran Pembelajaran Universiti (UTLC)</option>			  
			<option value = "Pusat Kerjasama dan Hal Ehwal Antarabangsa (CIAC)" <?php if($pst == "Pusat Kerjasama dan Hal Ehwal Antarabangsa (CIAC)"){ echo 'selected';} ?>>Pusat Kerjasama dan Hal Ehwal Antarabangsa (CIAC)</option>			  
			<option value = "Pusat Kesihatan Universiti (PKU)" <?php if($pst == "Pusat Kesihatan Universiti (PKU)"){ echo 'selected';} ?>>Pusat Kesihatan Universiti (PKU)</option>			  
			<option value = "Pusat Kerjasama Universiti-Industri (CUIC)" <?php if($pst == "Pusat Kerjasama Universiti-Industri (CUIC)"){ echo 'selected';} ?>>Pusat Kerjasama Universiti-Industri (CUIC)</option>			  
			<option value = "Pusat Pembangunan Kerjaya (CDC)" <?php if($pst == "Pusat Pembangunan Kerjaya (CDC)"){ echo 'selected';} ?>>Pusat Pembangunan Kerjaya (CDC)</option>			  
			<option value = "Pusat Islam " <?php if($pst == "Pusat Islam "){ echo 'selected';} ?>>Pusat Islam </option>			  
			<option value = "Pusat Seni dan Budaya (PSB)" <?php if($pst == "Pusat Seni dan Budaya (PSB)"){ echo 'selected';} ?>>Pusat Seni dan Budaya (PSB)</option>			  
			<option value = "U-Press (UUM Press)" <?php if($pst == "U-Press (UUM Press)"){ echo 'selected';} ?>>U-Press (UUM Press)</option>			  
			<option value = "UUM Information Technology (UUMIT)" <?php if($pst == "UUM Information Technology (UUMIT)"){ echo 'selected';} ?>>UUM Information Technology (UUMIT)</option>			  
			<option value = "Institut Pengurusan Kualiti (IPQ)" <?php if($pst == "Institut Pengurusan Kualiti (IPQ)"){ echo 'selected';} ?>>Institut Pengurusan Kualiti (IPQ)</option>			  
			<option value = "Institut Pemikiran Tun Dr. Mahathir Mohamed (IPDM) " <?php if($pst == "Institut Pemikiran Tun Dr. Mahathir Mohamed (IPDM) "){ echo 'selected';} ?>>Institut Pemikiran Tun Dr. Mahathir Mohamed (IPDM) </option>			  
			<option value = "Institut Pembangunan Keusahawanan & Koperasi (CEDI) " <?php if($pst == "Institut Pembangunan Keusahawanan & Koperasi (CEDI) "){ echo 'selected';} ?>>Institut Pembangunan Keusahawanan & Koperasi (CEDI) </option>			  
			<option value = "Institut Penyelidikan Pengurusan dan Perniagaan (IMBre) " <?php if($pst == "Institut Penyelidikan Pengurusan dan Perniagaan (IMBre) "){ echo 'selected';} ?>>Institut Penyelidikan Pengurusan dan Perniagaan (IMBre) </option>			  
			<option value = "Akademi Golf Nasional (UUMNGA)" <?php if($pst == "Akademi Golf Nasional (UUMNGA)"){ echo 'selected';} ?>>Akademi Golf Nasional (UUMNGA)</option>			  
			<option value = "Muzium Pengurusan UUM" <?php if($pst == "Muzium Pengurusan UUM"){ echo 'selected';} ?>>Muzium Pengurusan UUM</option>			  
			<option value = "UUM Corporate Communication" <?php if($pst == "UUM Corporate Communication"){ echo 'selected';} ?>>UUM Corporate Communication</option>			  
			<option value = "Unit Audit Dalam" <?php if($pst == "Unit Audit Dalam"){ echo 'selected';} ?>>Unit Audit Dalam</option>			  

		</select>
		<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" ></input>
		<button id="signup" type="submit" name="upd_user">Simpan</button>
		<a onClick="javascript:history.go(-1)">Kembali</a>
    </div>
  </form>
</div>



<script type="text/javascript">


 
 function preview(event){
	var input = event.target.files[0];
	var reader = new FileReader();
	reader.onload = function(){
		var result = reader.result;
		var img = document.getElementById('img');
		img.src = result;
	}
	reader.readAsDataURL(input);
 }
	
// Get the modal
var modal = document.getElementById('id01');

    $(window).on('load',function(){
        $('#id01').modal('show');
    });

</script>

</body>
</html>