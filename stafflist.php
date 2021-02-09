<?php 
include('server.php');

	$nama_projek = $_GET['name'];
	
  $sql = "SELECT * FROM Staff_".$nama_projek;
	
	$name = str_replace('_', ' ', $_GET['name']);
	
  if (!isset($_SESSION['email'])) {
  	
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
  
  if(isset($_SESSION['id'])){
	  unset($_SESSION['id']);
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
@media screen and (max-width: 481px){
}


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
	valign:middle;
	
}

td{
	text-align:center;
	valign:middle
}
.btn{
  background-color: red;
  border: none;
  color: white;

  text-align: center;
  font-size: 10px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}

.btn:hover {
	opacity: 1
	background-color: red;
}


</style>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="crudApp" class="container"  style=" width: 1000px;">
  <div class="modal-content">
	<div type="hidden" class="content"  style="display: inline-block;width: auto ">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div type="hidden" class="error success" >
      	<h3>
          <script> 
		   window.alert("<?php echo $_SESSION['success']; ?>");
           <?php unset($_SESSION['success']);?>;
          </script>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['email'])) : ?>
    	<button @click="logout"v-if="loggedIn">Log out</button>
    <?php endif ?>
	
</div>


      <a  href="server.php?logout=true" class="btn btn-info btn-lg" style="font-size:12px;cursor:pointer; margin:4px; float:right"><span style="margin-right:2px"  class="glyphicon glyphicon-log-out"></span>Logout</a>

 <div class="img">

  <img src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="215px" height="220px" style="margin-left:20px"  id="img"><br>
		<span style="margin-left:20px" class="text-left">Name: <?php echo $_SESSION['name']; ?></br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></br></span>
		</div>
		
		
		
		<div class="containers">
	
	
			
		 
		
		  </div>
    <!--<transition name="model">-->
         <div align="center"><b>SENARAI AJK <?php echo $name;?></b></div> 
         <div class="modal-body" id="crudApp">
          <div class="form-group">
            <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
	    <th>Staff ID</th>
        <th>Nama</th>
        <th>Organisasi</th>
		
       </tr>
	   <tr>
	   <?php

      if($result = mysqli_query($db, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
			if(isset($row['staff_no'])){
				echo "<tr>";
				echo "<td>" . $row['staff_no'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['organisasi'] . "</td>";			 
			}
		echo "</tr>";
      }
      echo "</table>";
	} else {
				echo "<tr><td colspan='7'>Tiada staff didaftarkan</td></tr></table>";
			}
      // Free result set
      mysqli_free_result($result);
	  }?>
			
	   </tr>
    </table>
	
   </div>
       </div>
       
       </div>
      
	  <a style=" cursor: pointer;" onClick="javascript:history.go(-1)" ><img style="margin-left:10px; width:55px; height:55px; cursor: pointer;" src="back.png" 
            class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full image" ></img></a>	
		</div>
     </div>

</body>
</html>
<script>
function myFunction() {
  document.getElementById("demo").innerHTML = "Iframe is loaded.";
}

var application = new Vue({
 el:'#crudApp',
 data:{
  allDatas:'',
  myModel:false,
  actionButton:'Insert',
  dynamicTitle:'Add Data',
 },
 methods:{
  fetchAllData:function(){
   axios.post('action.php', {
    action:'fetchall'
   }).then(function(response){
    application.allDatas = response.data;
   });
  },
  openModel:function(){
   application.first_name = '';
   application.last_name = '';
   application.actionButton = "Insert";
   application.dynamicTitle = "Add Data";
   application.myModel = true;
  },
  submitData:function(){
   if(application.nama_projek != '' && application.penarafan != '')
   {
    if(application.actionButton == 'Insert')
    {
     axios.post('action.php', {
      action:'insert',
      nama_projek:application.nama_projek, 
      penarafan:application.penarafan
     }).then(function(response){
      application.myModel = false;
      application.fetchAllData();
      application.nama_projek = '';
      application.penarafan = '';
      alert(response.data.message);
     });
    }
    if(application.actionButton == 'Update')
    {
     axios.post('action.php', {
      action:'update',
      firstName : application.first_name,
      lastName : application.last_name,
      hiddenId : application.hiddenId
     }).then(function(response){
      application.myModel = false;
      application.fetchAllData();
      application.first_name = '';
      application.last_name = '';
      application.hiddenId = '';
      alert(response.data.message);
     });
    }
   }
   else
   {
    alert("Fill All Field");
   }
  },
  fetchData:function(id){
   axios.post('action.php', {
    action:'fetchSingle',
    id:id
   }).then(function(response){
    application.nama_projek = response.data.nama_projek;
	application.tarikh_mula = response.data.tarikh_mula;
	application.tarikh_tamat = response.data.tarikh_tamat;
    application.penarafan = response.data.penarafan;
	application.status = response.data.status;
    application.hiddenId = response.data.id;
    application.myModel = true;
    application.actionButton = 'Update';
    application.dynamicTitle = 'Edit Data';
   });
  },
  deleteData:function(id){
   if(confirm("Are you sure you want to remove this data?"))
   {
    axios.post('action.php', {
     action:'delete',
     id:id
    }).then(function(response){
     application.fetchAllData();
     alert(response.data.message);
    });
   }
  }
 },
 created:function(){
  this.fetchAllData();
 }
});

// Get the modal

var modal = document.getElementById('id01');

    $(window).on('load',function(){
        $('#id01').modal('show');
    });
</script>
