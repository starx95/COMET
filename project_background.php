<?php 
include('server.php');
$_SESSION['nama_projek'] = str_replace(' ', '_', $_POST['nama_projek']);
if(isset($_SESSION['id'])){
$_SESSION['nama_projek_lama'] = str_replace(' ', '_', $_SESSION['nama_projek_lama']);
}
// sql to create table
if(isset($_SESSION['id'])){
$sql = "ALTER TABLE Staff_".$_SESSION['nama_projek_lama']." RENAME TO Staff_".$_SESSION['nama_projek'].";";
}else{
$sql = "CREATE TABLE IF NOT EXISTS Staff_".$_SESSION['nama_projek']." (
staff_no INT(6) UNSIGNED PRIMARY KEY NOT NULL,
name VARCHAR(30) NOT NULL,
organisasi VARCHAR(30) NOT NULL
)";
}

if ($db->query($sql) === TRUE ) {
  
} else {
  echo "Error creating table: " . $db->error;
}

if (isset($_SESSION['id'])){
	$sql = "SELECT * FROM projects WHERE id=".$_SESSION['id']."";
	 if($result = mysqli_query($db, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$pendahuluan = $row['pendahuluan'];
				$latarbelakang = $row['latarbelakang'];
				$penglibatan = $row['penglibatan'];
}}}
}

echo "test".$_POST['penglibatan_komuniti'];

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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');background-repeat: no-repeat;
  background-attachment: fixed;}

textarea {
	border-radius:8px;
}


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
  
/* Set a style for all buttons */
button {
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

</style>
	<title>Comet</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container" style="width:25%">
	<div class="modal-content" style="width: auto; display: inline-block;">
    <div class="border max-w rounded overflow-hidden shadow-lg" style="margin:20px">
      <div class="px-6 py-4" ><p class="text-right" style ='font-family:verdana;margin:4px' >Pendaftaran Projek Baru</p>
          <div class="img">
            <img  class="img2 border center " src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="200" height="200">  
			<span style ='font-family:verdana;margin:4px;'  class="text-left">Name: <?php echo $_SESSION['name']; ?>
            <br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></span>
          </div>
		<form method="post" action="objektif.php?id=<?php echo $_GET['id'] ?>">
		<input type="hidden"  style="height:35px" placeholder="project name" id="name" name="nama_projek" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['nama_projek']; ?>"></td>
		<input type="hidden"  style="height:35px" placeholder="project name" id="name" name="negeri" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['negeri']; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="lokasi" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['lokasi']; ?>"></td>
        <?php if (isset($_SESSION['id'])){ ?>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="Penglibatan Organisasi Luar[]" class="border px-4 py-2 width" type="text" value="<?php echo $penglibatan;  ?>"></td><?php } else {?>	
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="Penglibatan Organisasi Luar[]" class="border px-4 py-2 width" type="text" value="<?php $i=1;$count = count($_POST['Penglibatan_Organisasi_Luar']);$cnt=1; if ($count>1){foreach ($_POST['Penglibatan_Organisasi_Luar'] as $penglibatan){  if($cnt<$count){echo $penglibatan.","; $cnt++;}else{echo $penglibatan;}}}else{ foreach ($_POST['Penglibatan_Organisasi_Luar'] as $penglibatan){  echo $penglibatan." ";}}?>"></td>
		<?php }?>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sumbangan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['sumbangan']; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan" class="border px-4 py-2 width" type="text" value="<?php echo $cnt; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="mula" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['mula']; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="tamat" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['tamat']; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="S/O_kod" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['S/O_kod']; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pemindahan_ilmu" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['pemindahan_ilmu']; ?>"></td>
        <input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan_komuniti" class="border px-4 py-2 width" type="text" value="<?php echo $_POST['penglibatan_komuniti']; ?>"></td>
		</div  style ='width:100;'>
          <p class="text-left ml-5" style ='margin-top:50px'><strong class="text-left ml-5" style ='%font-family:verdana;font:bold'>Nama Projek: &nbsp;</strong> <?php echo $_POST['nama_projek']; $_SESSION['nama_projek']=$_POST['nama_projek']; ?></p>
			<div class="flex mt-2">
			<label class="labelcss" for="title">Pendahuluan:&nbsp; </label>
			<textarea style ='font-family:verdana;resize:none' class="border ml-3 "  rows="5" cols="80" id="title" name="pendahuluan" required><?php if (isset($_SESSION['id'])){ echo $pendahuluan; } ?></textarea>
			</div>
            <label class="labelcss" for="ta">Latarbelakang:</label>
            <textarea id="ta" style ='font-family:verdana;resize:none' class="border ml-3 " rows="5" cols="80" name="latarbelakang" required><?php if (isset($_SESSION['id'])){ echo $latarbelakang; } ?></textarea> 
		</div>
      <button style="border-radius:4px; background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;"  type="submit" >Seterusnya</button>
      <a style="border-radius:4px; background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;display: inline-block;" href="index.php">Batal</a>
      </div>
		</form>
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
    	                if(confirm('are you sure?'))this.$router.push("/objektif");
    
    }
         }
    }
    
</script>

<style>


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
