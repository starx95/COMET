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
  
  $sqlp = "SELECT * FROM projects where id=".$_GET['id'];
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
  
// Username is root 
$user = 'starxdev'; 
$password = '01Gaidl!9[EM0Y'; 

// Database name is gfg 
$database = 'starxdev_comet'; 

// Server is localhost with 
// port number 3308 
$servername='localhost'; 
$mysqli = new mysqli($servername, $user, 
				$password, $database); 

// Checking for connections 
if ($mysqli->connect_error) { 
	die('Connect Error (' . 
	$mysqli->connect_errno . ') '. 
	$mysqli->connect_error); 
} 

// SQL query to select data from database 
$sql = "SELECT * FROM laporan WHERE id = '".$_GET['id']."' ORDER BY bil DESC "; 
$result = $mysqli->query($sql); 
$mysqli->close(); 
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

</html> 
	<style> 
		table { 
			margin: 0 auto; 
			font-size: large; 
			
		} 

		h1 { 
			text-align: center; 
		
			font-size: xx-large; 
			font-family: 'Gill Sans', 'Gill Sans MT', 
			' Calibri', 'Trebuchet MS', 'sans-serif'; 
		} 

		td { 
			
			
		} 

		th, 
		td { 
			font-weight: bold; 
			
			padding: 10px; 
			text-align: center; 
		} 

		td { 
			font-weight: lighter; 
		} 
	</style> 
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
		<section>
		<table style="width:95%;margin-left:auto;margin-right:auto;">
			<tr ><td style="text-align:center;width:15%"><b>Nama Projek:</b></td><td style="text-align:left; margin:0px"><?php echo $nama_projek; ?></td></tr>
			</table>
		<h1>Gambar Projek</h1> 
		<!-- TABLE CONSTRUCTION--> 
		<table style="border: 1px solid black; "> 
			<tr  style="border: 1px solid black; "> 
				<th  style="border: 1px solid black; ">no</th>
				<th  style="border: 1px solid black; ">id</th> 
				<th  style="border: 1px solid black; ">Nama </th> 
				<th  style="border: 1px solid black; ">Tindakan</th> 
			</tr> 
			<!-- PHP CODE TO FETCH DATA FROM ROWS--> 
			<?php // LOOP TILL END OF DATA 
				$no = 0;
				while($rows=$result->fetch_assoc()) 
				{
					if(strpos($rows['file'],"gambar")){		
						$no++;
			?> 
			<tr  style="border: 1px solid black; "> 
				<!--FETCHING DATA FROM EACH 
					ROW OF EVERY COLUMN-->
				<td  style="border: 1px solid black; "><?php echo $no; ?></td>
				<td  style="border: 1px solid black; "><?php echo $rows['id'];?></td> 
				<td  style="border: 1px solid black; "><?php echo $rows['file'];?></td> 
				<td  style="border: 1px solid black; "><a style="cursor:pointer;text-decoration:none" href="uploads/bukti/gambar/<?php echo $rows['file']; ?>" download>Download</a></td> 
			</tr> 
			<?php 
					}} 
			?> 
		</table> 
	</section> 
	<div align="center" style="margin:20px">
		<a style="text-decoration:none;cursor:pointer;border-radius:4px;background-color:#00009D;color:white;padding: 14px 20px;margin: 8px 0;" href="view_laporan.php?id=<?php echo $_SESSION['id']; ?>">Kembali</a>
	</div>
</div>

</body> 

</html> 
