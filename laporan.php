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
	
	 
	
	$now = strtotime('now');
	$id = $_REQUEST['id'];
	
	if(isset ($_POST['new']) && $_POST['new'] == 1){
	$nama = $_POST['nama_projek'];
	$selectedfile = str_replace("'","", $_FILES['file']['name']);
	$file = $id." Laporan kemajuan ".$now." Projek ".$nama."-".$selectedfile;
	$file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="uploads/laporan/";
	
	$penilaian = $_POST['penilaian'];
	$cabaran = $_POST['cabaran'];
	$cadangan = $_POST['cadangan'];
	$id = $_POST['id'];
	$_SESSION['id'] = $id;
	$update="update projects set penilaian='".$penilaian."', cabaran='".$cabaran."', cadangan='".$cadangan."' where id='".$id."'";
	mysqli_query($db, $update) or die(mysqli_error());
	$sqlp = "SELECT * FROM projects where id=".$_SESSION['id'];
	$result = mysqli_query($db, $sqlp);
	while($rows = mysqli_fetch_array($result)){
		$registeredby = $rows['registeredby'];
		$project_name = $rows['nama_projek'];
	}

	$to = "nizam.yuseri@gmail.com";
	$subject = "Comet Admin";
	$txt = "Projek '".$project_name."' telah memuat naik laporan dan menunggu semakan anda";
	$headers = "From: CometAdmin@uum.edu.my";
	
	
	
	try{
	move_uploaded_file($_FILES['file']['tmp_name'],$folder.$file);
	} catch (RuntimeException $e) {
		echo $e->getMessage();
	}
	$sql="SELECT * FROM laporan where id=".$id;
			$result_set=mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result_set)){
				if($row['size'] == 0){
	$sql="INSERT INTO laporan(id,file,type,size) VALUES('$id','$file','$file_type','$file_size')";
				} else {
					$sql="UPDATE laporan SET file = '$file' ,type = '$file_type',size = '$file_size' WHERE id='$id'";
			}}
	if(mysqli_query($db,$sql)) {
		mail($to,$subject,$txt,$headers);
	} else { 
	die(mysqli_error($db));
	}
	
	header("location: index.php");
  }
?>
<!DOCTYPE html>
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
@media screen and (max-width: 481px){
}
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');  background-repeat: no-repeat;
  background-attachment: fixed;}

/* Full-width input fields */
input[type=text]{
  width: 78%;
  height: 40px;
  margin: 8px ;
  
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
	display:inline-block;
	width:180px;
	text-align:right;
}

label.file { 
            float: left; 
        } 
          
span.file { 
            display: block; 
            overflow: hidden; 
            padding: 0px 4px 0px 6px; 
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



  .container {
    margin: 0 auto;
    min-height: 100vh;
   
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
</style>
	<title>Laporan</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="loader" class="center"></div> 
  <div class="container">
  <div class="modal-content" >
    <div  class="border max-w rounded overflow-hidden shadow-lg">
      <div class="px-6 py-4" >
          <div class="img">
            <img class="img2 border" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="190" height="200"> 
            <span class="text-left">Nama: <?php echo $_SESSION['name']; ?>
            <br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></span>
          </div>
		  </div>
		   <?php $id=$_REQUEST['id']; $query = "SELECT * from projects where id='".$id."'"; $result = mysqli_query($db, $query) or die ( mysqli_error()); $row = mysqli_fetch_assoc($result); ?>
		  <form method="post" action="laporan.php" enctype="multipart/form-data">
		  <input type="hidden" name="new" value="1" />
		  <input type="hidden" name="nama_projek" value="<?php echo $row['nama_projek'];?>">
		  <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>" />
		  <div style="text-align:left">
          <strong name="nama_projek" style="margin-left:30px;height:8px">Nama Projek&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp; </strong><?php $id=$_REQUEST['id']; $query = "SELECT * from projects where id='".$id."'"; $result = mysqli_query($db, $query) or die ( mysqli_error()); $row = mysqli_fetch_assoc($result); echo $row['nama_projek'];?>
				<br/><strong style="margin-left:30px" name="file" for="file">Laporan Kemajuan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
				<span ><input style="cursor:pointer" name="file" accept="application/pdf,application/vnd.ms-excel"  id="file" type="file" required></input></span>
				
		<div >
			<span  class="left">
            <label  for="penilaian" class="text-left ml-5" >Penilaian&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </label></span>
			<input  name="penilaian" id="penilaian"  type="text" class="border ml-2 " required></input> 
		</div>
        <div>
            <span class="left">
            <label for="cabaran" class="text-left ml-5">Cabaran/Kekangan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</label></span>
            <input name="cabaran" id="cabaran"  type="text" class="border ml-2"  required></input> 
       </div>
	   <div>
            <span class="left">
            <label for="cadangan" class="text-left ml-5">Cadangan Penyelesaian:&nbsp;&nbsp;</label></span>
            <input name="cadangan" id="cadangan"  type="text"  class="border ml-2 "  required></input>
            </div>
        </div>
		<button type="submit" style="border-radius:4px" name="notify" <?php if (!isset($_SESSION['id'])){ echo "onclick=\"validate()\"";} else {echo "onclick=\"load()\"";}?> >Simpan</button>
      <a style="border-radius:4px;cursor:pointer" href="index.php">Batal</a>
	  </form>
        </div>
       </div>   
      </div>
	</body>
</html>
<script>
	function validate(){
			load();
	}
		
		function load()
		{
			document.querySelector( 
				"body").style.visibility = "hidden"; 
				document.querySelector( 
				"#loader").style.visibility = "visible"; 
		}
</script>


