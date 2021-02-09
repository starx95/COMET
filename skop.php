<?php 
include('server.php');

if(isset($_SESSION['id'])){
	$sql = 'SELECT * FROM projects WHERE id='.$_SESSION['id'].'';
	 if($result = mysqli_query($db, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$sdg = $row['sdg'];
				$skop= $row['skop'];
				$skopt = $row['skopt'];			
			}
		}
	}
}

if (strpos($_POST['objektif'], "\"") !== false) {
    $_POST['objektif'] = str_replace("\"", "'",$_POST['objektif']);
}
if (strpos($_POST['pelaksanaan'], "\"") !== false) {
    $_POST['pelaksanaan'] = str_replace("\"", "'",$_POST['pelaksanaan']);
}
if (strpos($_POST['penilaian'], "\"") !== false) {
    $_POST['penilaian'] = str_replace("\"", "'",$_POST['penilaian']);
}

?>
<html>
<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
  <script src='https://unpkg.com/axios/dist/axios.min.js'></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');  background-repeat: no-repeat;
  background-attachment: fixed;}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  
  padding: 6px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  width: 80%;
}

td{
	text-align:center;
	width: 26%;
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
  font-family:  'arial black';
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
  margin: 8px 0;
  border: none;
  cursor: pointer;
}

</style>
<title>Comet</title>
	<link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
<div class='container'  style=' width: 1100px;'>
<div class='modal-content'>
     <div class='px-6 py-4' style='margin:20px' ><p class='text-right' style ='font-family:verdana;margin:4px' >Pendaftaran Projek Baru</p>
      <div class='px-6 py-4' style='margin:20px' >
          <div class='img'>
            <img class='img2 border' src='<?php echo 'uploads/profil/'. $_SESSION['pic']; ?>' alt='profile picture' width='200' height='200'> 
            <span class='text-left'>Nama:<?php echo $_SESSION['name']; ?>
            <br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></span>
          </div>
          <p class='text-left ml-5' style='font-weight:bold'>Nama Projek: &nbsp; <?php echo $_POST['nama_projek']; ?>
		
		<div class='flex mt-2'>
		<form onSubmit="return handleData()" method="post" action="semak.php?id=<?php echo $_GET["id"] ?>">
		<div style="visibility:hidden; color:red; " id="chk_option_error">Please select at least one option.</div>
		<div >
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["penglibatan"]; ?>"></td>
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="nama_projek" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["nama_projek"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="null" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["null"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="negeri" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["negeri"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="lokasi" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["lokasi"]; ?>">
        <input type="hidden" style="height:35px" placeholder="project name" id="name" name="Penglibatan_Organisasi_Luar[]" class="border px-4 py-2 width" type="text" value="<?php foreach ($_POST["Penglibatan_Organisasi_Luar"] as $penglibatan){ echo $penglibatan;}?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="sumbangan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["sumbangan"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="mula" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["mula"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="tamat" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["tamat"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="S/O_kod" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["S/O_kod"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pemindahan_ilmu" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["pemindahan_ilmu"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pendahuluan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["pendahuluan"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="latarbelakang" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["latarbelakang"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="objektif" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["objektif"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="pelaksanaan" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["pelaksanaan"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penilaian" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["penilaian"]; ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="staff" class="border px-4 py-2 width" type="text" value="<?php  {echo  $list;} ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="nama" class="border px-4 py-2 width" type="text" value="<?php  {echo $nama;} ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="organisasi" class="border px-4 py-2 width" type="text" value="<?php foreach ($_POST["organisasi"] as $organisasi){ echo $organisasi;} ?>">
		<input type="hidden" style="height:35px" placeholder="project name" id="name" name="penglibatan_komuniti" class="border px-4 py-2 width" type="text" value="<?php echo $_POST["penglibatan_komuniti"]; ?>"></td>
		
		</div>
            <span class="left">
            <label for="myTable"  style="display: inline-block;text-align:left;vertical-align: top; float:left">Skop:&nbsp;</label>
            <table style="margin:20px;width:95%; text-align:left" id="myTable" class="table table-bordered table-striped" >
          <tbody>
            <tr class="text-left">
			  <td style="text-align:left" class="border px-4 py-2 "><input name="skop[]" type="checkbox" value="Pendidikan" class="mr-2 center" id="Pendidikan" <?php if(isset($_SESSION["id"])){ if (strpos($skop,"Pendidikan")){echo "checked";}} ?>>
              <label for="Pendidikan">Pendidikan</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox" class="mr-2" value="Ekonomi Komuniti" id="Ekonomi Komuniti" <?php if(isset($_SESSION["id"])){ if (strpos($skop,"Ekonomi")){echo "checked";}} ?>>
              <label for="Ekonomi Komuniti">Ekonomi Komuniti</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox" class="mr-2 center" value="Kelestarian & Teknologi Hijau" id="Kelestarian & Teknologi Hijau" <?php if(isset($_SESSION["id"])){ if (strpos($skop,"Hijau")){echo "checked";}} ?>>
              <label for="Kelestarian & Teknologi Hijau">Kelestarian & <br> Teknologi Hijau</label</td>
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox" class="mr-2" value="Keterangkuman" id="Keterangkuman"<?php if(isset($_SESSION["id"])){ if (strpos($skop,"Keterangkuman")){echo "checked";}} ?>>
              <label for="Keterangkuman">Keterangkuman</label></td>
            </tr>
            <tr class="bg-gray-100 text-left">
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox"  value="Pembangunan Kemahiran" id="Pembangunan Kemahiran"<?php if(isset($_SESSION["id"])){ if (strpos($skop,"Kemahiran")){echo "checked";}} ?>>
              <label for="Pembangunan Kemahiran">Pembangunan Kemahiran</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox" class="mr-2" value="Kesejahteraan Sosial" id="Kesejahteraan Sosial"<?php if(isset($_SESSION["id"])){ if (strpos($skop,"Kesejahteraan")){echo "checked";}} ?>>
              <label for="Kesejahteraan Sosial">Kesejahteraan Sosial</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox" class="mr-2" value="Perubahan Iklim & Persekitaran" id="Perubahan Iklim & Persekitaran"<?php if(isset($_SESSION["id"])){ if (strpos($skop,"Perubahan")){echo "checked";}} ?>>
              <label for="Perubahan Iklim & Persekitaran">Perubahan Iklim<br> & Persekitaran</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="skop[]" type="checkbox" class="mr-2" value="SULAM" id="Sulam"<?php if(isset($_SESSION["id"])){ if (strpos($skop,"Sulam")){echo "checked";}} ?>>
              <label for="Sulam">SULAM</label></td>
            </tr style="text-align:center" class="border px-4 py-2">
			<tr><td colspan="4"><label for="skopt">Lain-Lain:&nbsp;</label><input name="skopt" type="text"  id="skopt" value="<?php if(isset($_SESSION["id"])){ if (isset($skopt)){echo $skopt;}} ?>">
              </td></tr>
			
          </tbody>
        </table>
        </div>
        <div class="flex mt-2">

            <label for="myTable" style="display: inline-block;text-align:left;vertical-align: top; float:left">SDG:&nbsp;&nbsp;</label>
            <table style="margin:20px;width:95%" id="myTable" class="table table-bordered table-striped" >
          <tbody>
            <tr class="text-left">
              <td style="text-align:left" class="border px-4 py-2 "><input name="sdg[]" type="checkbox" class="mr-2 center" value="No Poverty" id="No Poverty"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Poverty")){echo "checked";}} ?>>
              <label for="No Poverty">No Poverty</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="No Hunger" id="No Hunger"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Hunger")){echo "checked";}} ?>>
              <label for="No Hunger">No Hunger</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2 center" value="Good Health & Well being" id="Good Health & Well being"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Health")){echo "checked";}} ?>>
              <label for="Good Health & Well being">Good Health &<br> Well being</label</td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Quality Education" id="Quality Education"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Quality")){echo "checked";}} ?>>
              <label for="Quality Education">Quality Education</label></td>
            </tr>
            <tr class="bg-gray-100 text-left">
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Gender Equality" id="Gender Equality"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Gender")){echo "checked";}} ?>>
              <label for="Gender Equality">Gender Equality</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Clean Water & Sanitation" id="Clean Water & Sanitation"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Sanitation")){echo "checked";}} ?>>
              <label for="Clean Water & Sanitation">Clean Water &<br> Sanitation</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Affordable & Clean Energy" id="Affordable & Clean Energy"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Affordable")){echo "checked";}} ?>>
              <label for="Affordable & Clean Energy">Affordable &<br> Clean Energy</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Decent Work & Economic Growth" id="Decent Work & Economic Growth"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Decent")){echo "checked";}} ?>>
              <label for="Decent Work & Economic Growth">Decent Work &<br> Economic Growth</label></td>
            </tr>
            <tr class="text-left">
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Responsible Production & Consumption" id="Responsible Production & Consumption"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Responsible")){echo "checked";}} ?>>
              <label for="Responsible Production & Consumption">Responsible Production &<br> Consumption</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Industry, Innovation & Infrastructure" id="Industry, Innovation & Infrastructure"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Innovation")){echo "checked";}} ?>>
              <label for="Industry, Innovation & Infrastructure">Industry, Innovation &<br> Infrastructure</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Reduced Inequality" id="Reduced Inequality"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Inequality")){echo "checked";}} ?>>
              <label for="Reduced Inequality">Reduced Inequality</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Sustainable Cities & Communities" id="Sustainable Cities & Communities"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Cities")){echo "checked";}} ?>>
              <label style="text-align-last:left" for="Sustainable Cities & Communities">Sustainable Cities & <br/> Communities</label></td>
            </tr>
            <tr class="bg-gray-100 text-left">
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Climate Action" id="Climate Action"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Climate")){echo "checked";}} ?>>
              <label for="Climate Action">Climate Action</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Life Below Water" id="Life Below Water"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Below")){echo "checked";}} ?>>
              <label for="Life Below Water">Life Below Water</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Live on Land" id="Live on Land"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Live")){echo "checked";}} ?>>
              <label for="Live on Land">Live on Land</label></td>
              <td style="text-align:left" class="border px-4 py-2"><input name="sdg[]" type="checkbox" class="mr-2" value="Peace & Justice Strong Institution" id="Peace & Justice Strong Institution"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Peace")){echo "checked";}} ?>>
              <label for="Peace & Justice Strong Institution">Peace & Justice<br> Strong Institution</label></td>
            </tr>
            <tr >
                <td  colspan="4" class="border px-4 py-2"><input name="sdg[]" style="vertical-align: top;display: inline-block;" type="checkbox" class="mr-2" value="Partnerships to Achieve the Goal" id="Partnerships to Achieve the Goal"<?php if(isset($_SESSION["id"])){ if (strpos($sdg,"Goal")){echo "checked";}} ?>>
              <label for="Partnerships to Achieve the Goal">Partnerships to Achieve the Goal</label></td>
            </tr>
          </tbody>
        </table>
        </div>
        </div>
		<button style=" background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer; border-radius:4px"  type="submit" >Seterusnya</button>
		<a style="background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;display: inline-block;border-radius:4px" href="index.php">Batal</a>
       </form>
      </div>
	  </div>
    </div>
</body>
</html>

<script>

	function handleData()
	{
		var form_data = new FormData(document.querySelector('form'));
		
		if(!form_data.has('skop[]'))
		{
			document.getElementById('chk_option_error').style.visibility = 'visible';
		return false;
		}
		else
		{
			document.getElementById('chk_option_error').style.visibility = 'hidden';
		return true;
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
    font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    display: block;
    font-weight: 300;
    font-size: 80px;
    color: #35495e;
    letter-spacing: 1px;
  }
</style>
