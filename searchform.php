<?php
include('server.php');
$output = '';
$query = mysqli_query($db,"SELECT * FROM projects") or die("could not search!");
//collect
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	
	if($_POST['category']=="skop"){
		$query = mysqli_query($db,"SELECT * FROM projects WHERE skop LIKE '%$searchq%'") or die("could not search!");
	} else if($_POST['category']=="penarafan"){
		$query = mysqli_query($db,"SELECT * FROM projects WHERE penarafan LIKE '%$searchq%'") or die("could not search!");
	} else if($_POST['category']=="SDG"){
		$query = mysqli_query($db,"SELECT * FROM projects WHERE sdg LIKE '%$searchq%'") or die("could not search!");
	} else if($_POST['category']=="tahun"){
		$query = mysqli_query($db,"SELECT * FROM projects WHERE tarikh_mula LIKE '%$searchq%'") or die("could not search!");
	} else if($_POST['category']=="agensi"){
		$query = mysqli_query($db,"SELECT * FROM projects WHERE penglibatan LIKE '%$searchq%'") or die("could not search!");
	} else if($_POST['category']=="semua"){
		$query = mysqli_query($db,"SELECT * FROM projects") or die("could not search!");
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
@media print
{
@page {size: landscape;
    margin: 0;
}
body * { visibility:hidden; }
.hides * { display:none; }
.div2 * { visibility: visible; }
 a[href]:after {
    content: none !important;
  }
}

@media screen and (max-width: 481px){
}
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');  background-repeat: no-repeat;
  background-attachment: fixed;}

/* Style the submit button */
form.example button {
  width: 4%;
  padding: 6px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  
  padding: 12px 20px;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Style the search field */
form.example input[type=text] {
  height:40px;
  font-size: 14px;
  border: 1px solid grey;
 
  width: 20%;
  background: white;
}

select{
  height:41px;
  border-radius:5px;
  font-size: 14px;
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
  
/* Set a style for all buttons */
button {
  background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border-radius: 20px;
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
<title>Comet</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="crudApp" class="container " style=" width: 80%;" >
<div class="modal-content" >
<div class="hides" style="margin-top: -13px;display:block;">
<div class="hides">
          <div id="div " align="center" style="margin-top:20px" class="img">
            <img style="display:inline-block" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="215px" height="220px" style="margin-left:20px"  id="img"></img>  
			<p id="detail" style="margin-left:20px" class="text-left">Name: <?php echo $_SESSION['name']; ?>
            <br/>Pusat Tanggungjawab: <?php echo $_SESSION['pusat']?></p>
          </div>
		  </div>
		  <br>
<div align="center"><label>Search</label></div>
<form align="center" id="myForm" class="example" action="searchform.php" method="post">
<select id="mySelect" name="category" class="border px-12 py-2" id = "myList">
              <option value = "semua">Semua</option>
              <option value = "skop">Skop</option>
              <option value = "PTJ">PTJ</option>
              <option value = "penarafan">STAR-Rating</option>
              <option value = "SDG">SDG</option>
              <option value = "tahun">Tahun</option>
              <option value = "agensi">Agensi</option>
            </select>
<input type="text" id="key" placeholder="kata kunci" name="search" required>
<button id="btns" style="border-radius:8px;width:40px" type="submit"><i class="fa fa-search"></i></button>
</form>
</div>
<div class="modal-body div2" id="crudApp">
<div align="center"><h2>Senarai Projek</h2></div>

          <div class="form-group">
            <div class="table-responsive">
<table  id="tbl" style="width:97%;margin-left:auto;margin-right:auto" id="myselect" class="table table-striped table-bordered center">
<tr>
<th>Nama Projek</th>
<th>Tarikh Mula</th>
<th>Tarikh Tamat</th>
<th>Penarafan</th>
<th>Status</th>
<th>Ketua</th>
</tr>
<?php 

	$count = mysqli_num_rows($query);
	if($count > 0){
		while($row = mysqli_fetch_array($query)){
			echo "<tr>";
			echo "<td>"; echo $row['nama_projek']; echo "</td>";
			echo "<td>"; echo $row['tarikh_mula']; echo "</td>";
			echo "<td>"; echo $row['tarikh_tamat']; echo "</td>";
			echo "<td>"; echo $row['penarafan']; echo "</td>";
			echo "<td>"; echo $row['status']; echo "</td>";
			echo "<td>"; echo $row['ketua']; echo "</td>";
			echo "</tr>";
		}
	}else{ 
	echo "<tr><td colspan='7'>Tiada di dalam pengakalan data!</td></tr>";			
} ?>

</table>
</div>
<div class="hides">
<a  href="index.php"><img style=" width:55px; height:55px; cursor: pointer;" src="back.png" class=" bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full image" ></img></a>
<a class="btn btn-info btn-lg " style="font-size:14px;cursor:pointer; margin:4px; float:right;  text-decoration: none;background-color:#0c7cd5;" onClick="print()"><span style="margin-right:2px;font-size: 15px;"  class="glyphicon glyphicon-print lg "></span>cetak</a>
</div>
</div>
</div>
</div>
</body>
</html>
<script>
var counter = 1;
var dynamicInput = [];

window.onload = function() {
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
		var img = document.getElementById("img");
		var detail = document.getElementById("detail");
		var div = document.getElementById("div");
		var divhead = document.getElementById("divhead");
		var tbl = document.getElementById("tbl");
		var key = document.getElementById("key");
		key.style.width = "50%";
		document.getElementById("detail").style.display = "none";
		document.getElementById("crudApp").style.width = "90%";
		img.style.height = "180px";
		img.style.width = "170px";
		tbl.style.width = "90px";
		div.className = "";
		div.innerHTML = "<div align='center'>"+div.innerHTML+"</div>";
		detail.innerHTML = "<p style='text-align:center' >"+detail.innerHTML;
		divhead.innerHTML += "<br>"+"\n"+detail.innerHTML+"</br>";
		detail.style.width = "100%";
		
	//document.write("mobile");
	} else {
		var detail = document.getElementById("detail").style.display = "block";
	}
	}

function addInput(){
    var newinput = document.createElement('div');
    newinput.id = dynamicInput[counter];
    newinput.innerHTML =  " <br ><label for='myInputs[]'>AJK:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input  style='padding: 12px 20px; 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box; width:224px;border-radius: 8px;border:solid' type='text' placeholder='Staff no.' name='staff[]'> <input style='width:24' type='button' value='-' onClick='removeInput("+dynamicInput[counter++]+");'><input style='padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;margin-left:4px;width:225px;border-radius: 8px;border:solid;width:224px' type='text' placeholder='Nama' name='nama[]'><input style='width:224px;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;margin-left:4px;border-radius: 8px;border:solid' type='text' placeholder='Organisasi' name='organisasi[]'>";
    document.getElementById('formulario').appendChild(newinput);
    
}
  
  function removeInput(id){
    var elem = document.getElementById(id);
	counter--;
    return elem.parentNode.removeChild(elem);
  }
  
</script>