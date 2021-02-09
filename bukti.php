<?php 
include('server.php');

	$sql = "SELECT * FROM projects";
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
  
	$nama = $_POST['nama_projek'];
	if (strpos($_POST['output'], "\"") !== false) {
    $_POST['output'] = str_replace("\"", "'",$_POST['output']);
	}
	if (strpos($_POST['impak'], "\"") !== false) {
		$_POST['impak'] = str_replace("\"", "'",$_POST['impak']);
	}
	if (strpos($_POST['pelaksanaan'], "\"") !== false) {
		$_POST['pelaksanaan'] = str_replace("\"", "'",$_POST['pelaksanaan']);
	}
	if (strpos($_POST['penilaian'], "\"") !== false) {
		$_POST['penilaian'] = str_replace("\"", "'",$_POST['penilaian']);
	}
	if (strpos($_POST['kesimpulan'], "\"") !== false) {
		$_POST['kesimpulan'] = str_replace("\"", "'",$_POST['kesimpulan']);
	}
  
  if(isset ($_POST['new']) && $_POST['new'] == 1){
	$id = $_POST['id'];
	$pelaksanaan = $_POST['pelaksanaan'];
	$output = $_POST['output'];
	$impak = $_POST['impak'];
	$penilaian = $_POST['penilaian'];
	$kesimpulan = $_POST['kesimpulan'];
	$sql = "UPDATE projects SET pelaksanaan = \"".$pelaksanaan."\",output = \"".$output."\",impak=\"".$impak."\",penilaian=\"".$penilaian."\",kesimpulan=\"".$kesimpulan."\" WHERE id=\"".$id."\"";
	mysqli_query($db, $sql) or die(mysqli_error($db));
	
	
	$kerjasama = $_POST['id']." kerjasama ".$nama."-". $_FILES['kerjasama']['name'];
	$file_loc = $_FILES['kerjasama']['tmp_name'];
	$file_size = $_FILES['kerjasama']['size'];
	$file_type = $_FILES['kerjasama']['type'];
	$sql="INSERT INTO laporan(id,file,type,size) VALUES(\"".$id."\",\"".$kerjasama."\",\"".$file_type."\",\"".$file_size."\")";
	mysqli_query($db,$sql) or die(mysqli_error($db));
	// Upload file
	move_uploaded_file($_FILES['kerjasama']['tmp_name'],'uploads/bukti/kerjasama/'.$kerjasama);
	
	$kehadiran = $_POST['id']." kehadiran ".$nama."-". $_FILES['kehadiran']['name'];
	$file_loc = $_FILES['kehadiran']['tmp_name'];
	$file_size = $_FILES['kehadiran']['size'];
	$file_type = $_FILES['kehadiran']['type'];
	$sql="INSERT INTO laporan(id,file,type,size) VALUES(\"".$id."\",\"".$kehadiran."\",\"".$file_type."\",\"".$file_size."\")";
	mysqli_query($db,$sql) or die(mysqli_error($db));
	// Upload file
	move_uploaded_file($_FILES['kehadiran']['tmp_name'],'uploads/bukti/kehadiran/'.$kehadiran);
	
	// Count total files
	$countfiles = count($_FILES['gambar']['name']);
	
	// Looping all files
	for($i=0;$i<$countfiles;$i++){
	$gambar = $_POST['id']." gambar ".$nama."-". $_FILES['gambar']['name'][$i];
	$file_loc = $_FILES['gambar']['tmp_name'];
	$file_size = $_FILES['gambar']['size'];
	$file_type = $_FILES['gambar']['type'];
	$sql="INSERT INTO laporan(id,file,type,size) VALUES(\"".$id."\",\"".$gambar."\",\"".$file_type."\",\"".$file_size."\")";
	mysqli_query($db,$sql) or die(mysqli_error($db));
	// Upload file
	move_uploaded_file($_FILES['gambar']['tmp_name'][$i],'uploads/bukti/gambar/'.$gambar);
	}
	
	$lain_lain = $_POST['id']." lain-lain ".$nama."-". $_FILES['lain-lain']['name'];
	$file_loc = $_FILES['lain-lain']['tmp_name'];
	$file_size = $_FILES['lain-lain']['size'];
	$file_type = $_FILES['lain-lain']['type'];
	
	$sql="INSERT INTO laporan(id,file,type,size) VALUES(\"".$id."\",\"".$lain_lain."\",\"".$file_type."\",\"".$file_size."\")";
	mysqli_query($db,$sql) or die(mysqli_error($db));
	// Upload file
	move_uploaded_file($_FILES['lain-lain']['tmp_name'],'uploads/bukti/lain-lain/'.$lain_lain);
	$to = "nizam.yuseri@gmail.com";
	$subject = "Comet Admin";
	$txt = "Projek '".$nama."' telah memuat naik laporan akhir projek dan menunggu semakan anda";
	$headers = "From: CometAdmin@uum.edu.my";
	mail($to,$subject,$txt,$headers);
	header("location: index.php");
	
  }?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="http://example.com/favicon.png">
<link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');background-repeat: no-repeat;
  background-attachment: fixed;}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  width: 78%;
  height: 40px;
  margin: 4px;
 
  
  border: 1px solid #ccc;
  box-sizing: border-box;
}

 input[type=file] {
	 display:inline-block;
	 margin: 20px;
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

/* Set a style for all buttons */
button {
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
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

label {
	
	margin-left:74px;
	text-align:left;
}

label.file { 
            float: left; 
        } 
          
span.file { 
            display: block; 
            overflow: hidden; 
            padding: 0px 4px 0px 6px; 
        } 
textarea {
  width: 80%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}

.labelcss{
  display: inline-block;
  text-align:right;
  vertical-align: top;
}

.Center { 
            
            position: relative; 
             
            left: 50%; 
           
            margin-left: -100px; 
        } 
</style>
	<title>Output</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
  <div class="modal-content" >
    <div class="border max-w rounded overflow-hidden shadow-lg">
      <div class="px-6 py-4" >
          <div class="img">
            <img class="img2 border" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="190" height="200"> 
            <span class="text-left">Nama: <?php echo $_SESSION['name'];?>
            <br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></span>
          </div>
		  <div style="text-align:left">
		  
          <label style="margin-bottom:15px;height:8px;display:inline-block" class="labelcss">Nama Projek&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $_POST['nama_projek'];?></label><br>
			
			<form enctype="multipart/form-data" method="post" action="bukti.php">
			<input type="hidden" name="nama_projek" value="<?php echo $_POST['nama_projek'];?>">
			<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>" />
			
			<input type="hidden" name="new" value="1" />
            <label style="margin-left:72px;display:inline-block" for="semak" >Senarai Semak&nbsp;:</label>
			<table style="margin-left:180px" id="semak" >
             <input type="hidden" name="pelaksanaan" value="<?php echo $_POST['pelaksanaan'] ?>"/>
			 <input type="hidden" name="output" value="<?php echo $_POST['output'] ?>"/>
			 <input type="hidden" name="impak" value="<?php echo $_POST['impak'] ?>"/>
			 <input type="hidden" name="penilaian" value="<?php echo $_POST['penilaian'] ?>"/>
			 <input type="hidden" name="kesimpulan" value="<?php echo $_POST['kesimpulan'] ?>"/>
              <tr>
              <td class="text-left ml-2" class="labelcss"><strong>Surat / Emel Persetujuan  Kerjasama&nbsp;&nbsp;</strong></td><td>:<input name="kerjasama" type="file" accept="application/pdf,application/vnd.ms-excel" class=" text-black font-bold" required> </td>&nbsp;&nbsp;<td></tr>
              <tr>
                  <td class="text-left ml-2"><strong>Senarai Kehadiran&nbsp;&nbsp;</strong></td><td>:<input type="file" name="kehadiran" accept="application/pdf,application/vnd.ms-excel" class=" text-black font-bold" required></tr>
              <tr>
                  <td class="text-left ml-2"><strong>Gambar&nbsp;&nbsp;</strong></td><td>:<input type="file" name="gambar[]" accept="image/*" class=" text-black font-bold" multiple required> </td>&nbsp;&nbsp; <td></tr>
              <tr>
                  <td class="text-left ml-2"><strong>Lain-lain&nbsp;&nbsp;</strong></td><td>:<input type="file" name="lain-lain" accept="application/pdf,application/vnd.ms-excel" class=" text-black font-bold"required> </td>&nbsp;&nbsp;<td></tr>
            </table>
			<div style="text-align:center">
              <button type="submit" style="border-radius:4px">Simpan</button>
				<a style="border-radius:4px" href="index.php">Batal</a>
				</div>
            </form>
        
        </div>
	  </div>
	 
      </div>
    </div>
	</div>
	</body>
</html>

<script>

    export default {
        name:'register',
        data()
        {
          return {registerForm:{
            pemindahanIlmu:null
          }}
        },
         methods: {
              cancel() {
                this.$router.push("/admin");
              },
              Submit(id, index) {
    	                if(confirm('are you sure?'))this.$router.push("/laporan");
    
    }
         }
    }
    
</script>

<style>
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
