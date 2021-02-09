<?php 
session_start();
if (isset($_SESSION['email'])) {
  	header('location: index.php');
  }
 
if(isset($_SESSION['pic'])){
	unset($_SESSION['pic']);
}
 
 if(isset($_SESSION['msg']) && $_SESSION['msg'] == "Kombinasi email/katalaluan salah"){
	 ?><script>
	 window.alert("Kombinasi email/katalaluan salah");
	</script>
	<?php unset($_SESSION['msg']); 
} else if(isset($_SESSION['msg']) && $_SESSION['msg'] == "Anda telah melibihi 3 kali cubaan untuk log masuk sila tunggu 5 minit sebelum cuba untuk log masuk semula") {
	?><script>
	 window.alert("Anda telah melibihi 3 kali cubaan untuk log masuk sila tunggu 5 minit sebelum cuba untuk log masuk semula");
	</script><?php
}
$atmp = 0;

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="http://example.com/favicon.png">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
@media screen and (max-width: 481px){
}
body {
	font-family: Arial, Helvetica, sans-serif;
	background-image: url('bg.jpg');
	}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin-left: 8px 0;
  margin-right: 8px 0;
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
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

input:hover {
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
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
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
}
</style>
</head>
<body>
<h3>
<script>
<?php
if(isset($_SESSION['msg'])){ ?>
window.alert("<?php echo $_SESSION['msg'] ?>");
<?php unset($_SESSION['msg']);} ?>
?>
</script></h3>
<?php if (isset($_SESSION['success'])) { ?>
      <div type="hidden" class="error success" >
      	<h3>
          <script> 
		   window.alert("<?php echo $_SESSION['success']; ?>");
           <?php unset($_SESSION['success']);?>;
          </script>
      	</h3>
      </div>
  	<?php } ?>
<div id="id01" class="container" width="100%">
  
  <form  class="modal-content " style="width:100%" action="server.php" method="post">
    <div class="imgcontainer">
      <img src="cuic.png"  alt="Avatar" class="avatar">
	  <h1 style="color:#00009D;font-size:60px;" class="title">COMET</h1>
    </div>

	<input type="hidden" value="<?php echo $atmp; ?>" name="atmp"/>
	<div style="margin-left:20px;margin-right:20px;">
      <label for="uname"><b>Email</b></label>
      <input type="email" placeholder="Masukkan Email" name="email" required>

      <label for="psw" style="margin-top:20px"><b>Kata Laluan</b></label>
      <input type="password" placeholder="Masukkan kata laluan" name="psw" required>
        
      <button onclick="<?php $atmp++; ?>" type="submit" name="login_user">Log Masuk</button>
      <input style="background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;" type="button" value="Daftar" id="reg" onclick="window.location.href='register.php'"></input>
	  
      <br>
        <input style="cursor: pointer;" id="chkbox" type="checkbox" checked="checked" name="remember">
		<label style="cursor: pointer;display:inline-block" for="chkbox">Remember me</label>
		<p style="text-align:right;display:inline-block;float:right">Lupa <a style="cursor: pointer;text-align:right;text-decoration:none" class="text" href="enter_email.php">katalaluan?</a></p>
    </div>
  </form>
</div>



<script type="text/javascript">
window.onload = function() {
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
	document.getElementById("reg").style.display = "none";
	} else {
	//document.write("not mobile");
	}
	}
	
// Get the modal
var modal = document.getElementById('id01');

    $(window).on('load',function(){
        $('#id01').modal('show');
    });

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>