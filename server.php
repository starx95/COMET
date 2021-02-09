<?php
if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();
}
	
// initializing variables
$email    = "";
$nama_projek = "";
$tarikh_mula = "";
$errors = array(); 

Class dbObj{
/* Database connection */
var $dbhost = "localhost";
var $username = "starxdev";
var $password = "01Gaidl!9[EM0Y";
var $dbname = "starxdev_comet";
var $conn;
function getConnstring() {
$con = mysqli_connect($this->dbhost, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

/* check connection */
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
} else {
$this->conn = $con;
}
return $this->conn;
}
}


// connect to the database
$db = mysqli_connect('localhost', 'starxdev', '01Gaidl!9[EM0Y', 'starxdev_comet');
$sql = "SELECT * FROM projects";
  if (!isset($_SESSION['email'])) {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db,$_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['psw']);
  $password_2 = mysqli_real_escape_string($db, $_POST['psw-repeat']);
  $ext = mysqli_real_escape_string($db, $_POST['ext']);
  $pst = mysqli_real_escape_string($db, $_POST['pst']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)){array_push($errors,"Please insert your name");}
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
    if ($user['email'] == $email) {
      array_push($errors, "email already exists");
	  $_SESSION['success'] = 'Pendaftaran tidak berjaya!';
		header('location: register.php');
    }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
	$tahap=1;
	$id = $_POST['id'];
	$pic = $_POST['id']." profil-pic ".$nama."-". $_FILES['pic']['name'];
	$file_loc = $_FILES['pic']['tmp_name'];
	$file_size = $_FILES['pic']['size'];
	$file_type = $_FILES['pic']['type'];
  	$query = "INSERT INTO users (img, name, email, password, ext, tahap, pusat_tanggungjawab) 
  			  VALUES('$pic', '$name','$email', '$password', '$ext', '$tahap', '$pst')";
  	if(mysqli_query($db, $query))
	{
		$_SESSION['success'] = 'Pendaftaran berjaya!';
		move_uploaded_file($_FILES['pic']['tmp_name'],'uploads/profil/'.$pic);
		header('location: login.php');
	} else {
		$_SESSION['success'] = 'Pendaftaran tidak berjaya!';
		header('location: register.php');
	} 	
  }
}

//LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['psw']);
  $atmp = mysqli_real_escape_string($db, $_POST['atmp']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
	  foreach($results as $row){
		$_SESSION['tahap'] = $row['tahap'];
		$_SESSION['name'] = $row['name'];
	  }
  	  $_SESSION['email'] = $username;
  	  $_SESSION['success'] = "Selamat datang ".$_SESSION['name']."";
  	  header('location: index.php');
  	}else {
		$atmp++;
		$_SESSION['msg'] = "Kombinasi email/katalaluan salah";
  		?><script type='text/javascript'>window.alert('Kombinasi email/katalaluan salah'); window.location.replace('login.php');</script><?php
  	}
}
}

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
	
		$query = "INSERT INTO projects (id, registeredby, nama_projek, tarikh_mula, tarikh_tamat,negeri,lokasi,penglibatan,bil_agensi,sumbangan,so,pemindahan,pendahuluan,latarbelakang,objektif,pelaksanaan,pra_penilaian, skop, skopt, sdg, penarafan,status, ptj,sixmnth, ketua, penglibatan_komuniti)
				VALUES('$id', '$registeredby', '$nama_projek', '$tarikh_mula', '$tarikh_tamat', '$negeri','$lokasi','$Penglibatan_Organisasi_Luar','$penglibatan','$sumbangan','$so','$pemindahan_ilmu','$pendahuluan','$latarbelakang','$objektif','$pelaksanaan','$pra_penilaian', '$skop', '$skopt', '$sdg', '$penarafan', '$status', '$ptj', '$sixmnth', '$name', '$yes')";
		if(mysqli_query($db, $query))
		{
			include 'sendmail.php';
			echo "<script>alert('Permintaan anda telah berjaya disimpan untuk disemak!');window.location.pathname = 'comet/index.php' </script>";
			
		}
	}

//CHANGE STATUS LULUS
IF(ISSET($_POST['lulus'])){
	$query = "UPDATE projects SET status = '".$_POST['lulus']."' WHERE id='".$_POST['id_lulus']."'";
	if(mysqli_query($db, $query))
	{
		include 'sendmail.php';
		echo "<script>alert('Projek telah berjaya diluluskan!');
			window.location.pathname = 'comet/index.php'</script>";
	}
}

//CHANGE STATUS TAMAT
IF(ISSET($_POST['sah_tamat'])){
	$query = "UPDATE projects SET status = '".$_POST['sah_tamat']."' WHERE id='".$_POST['id_tamat']."'";
	if(mysqli_query($db, $query))
	{
		include 'sendmail.php';
		echo "<script>alert('status projek telah berjaya dikemaskini!');window.location.pathname = 'comet/index.php' </script>";
		
	}
}



//LOGOUT USER
if(isset($_GET['logout']))
{
	session_destroy();
	header('location:login.php');
	exit;
}


?>