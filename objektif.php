<?php 
include('server.php');
$_SESSION['nama_projek'] = str_replace(' ', '_', $_POST['nama_projek']);
if(isset($_SESSION['id'])){
	$sql = 'SELECT * FROM projects WHERE id='.$_SESSION['id'].'';
	 if($result = mysqli_query($db, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$objektif = $row['objektif'];
				$pelaksanaan = $row['pelaksanaan'];
				$penilaian = $row['pra_penilaian'];
			}
		}
	}
}

if (strpos($_POST['pendahuluan'], "\"") !== false) {
    $_POST['pendahuluan'] = str_replace("\"", "'",$_POST['pendahuluan']);
	
}
if (strpos($_POST['latarbelakang'], "\"") !== false) {
    $_POST['latarbelakang'] = str_replace("\"", "'",$_POST['latarbelakang']);
}
?>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');  background-repeat: no-repeat;
  background-attachment: fixed;}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  
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
  border-radius: 20px;
  cursor: pointer;
}
</style>
<html>
	<head>
		<title>Comet</title>
		<link rel='stylesheet' type='text/css' href='style.css'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
 <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <script src='https://cdn.jsdelivr.net/npm/vue/dist/vue.js'></script>
  <script src='https://unpkg.com/axios/dist/axios.min.js'></script>
	</head>
	<body>
<div class='container'  style=' width: 1000px;' >
	<div class='modal-content' style='width: 100%; display: inline-block;'>
      <div class='px-6 py-4' style='margin:20px' ><p class='text-right' style ='font-family:verdana;margin:4px' >Pendaftaran Projek Baru</p>
          <div class='img'>
            <img  class='img2 border center ' src='<?php echo 'uploads/profil/'. $_SESSION['pic']; ?>' alt='profile picture' width='200' height='200'>  
			<span style ='font-family:verdana;margin:4px;'  class='text-left'>Name: <?php echo $_SESSION['name']; ?>
            <br/>Pusat Tanggungjawab: <?php echo $_SESSION['pusat']; ?>.</span>
          </div>
		  
		<p class='text-left ml-5' style ='margin-top:50px;'>
		<strong class='text-left ml-5' style ='width:100;%font-family:verdana;font:bold'>Nama Projek: &nbsp;</strong><?php echo $_POST['nama_projek']; ?></p>
        <div class='flex mt-2'>
        <form method='post' action='skop.php?id=<?php echo $_GET['id'] ?>'>
		<div type='hidden'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='penglibatan' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['penglibatan']; ?>'></td>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='nama_projek' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['nama_projek']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='negeri' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['negeri']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='lokasi' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['lokasi']; ?>'>
        <input type='hidden' style='height:35px' placeholder='project name' id='name' name='Penglibatan_Organisasi_Luar[]' class='border px-4 py-2 width' type='text' value='<?php foreach ($_POST['Penglibatan_Organisasi_Luar'] as $penglibatan){ echo $penglibatan;}?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='sumbangan' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['sumbangan']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='mula' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['mula']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='tamat' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['tamat']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='S/O_kod' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['S/O_kod']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='pemindahan_ilmu' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['pemindahan_ilmu']; ?>'>
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='pendahuluan' class='border px-4 py-2 width' type='text' value="<?php echo $_POST['pendahuluan']; ?>">
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='latarbelakang' class='border px-4 py-2 width' type='text' value="<?php echo $_POST['latarbelakang']; ?>">
		<input type='hidden' style='height:35px' placeholder='project name' id='name' name='penglibatan_komuniti' class='border px-4 py-2 width' type='text' value='<?php echo $_POST['penglibatan_komuniti']; ?>'></td>
		<label class='labelcss'  for='title'>Objektif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </label>
			<textarea name='objektif' style ='font-family:verdana;border-radius: 8px;width:90%;resize:none' align='right' class='border ml-3 '  rows='5' cols='100' id='title' name='objektif'required><?php if (isset($_SESSION['id'])){ echo $objektif; } ?></textarea>
			</div>
			<div>
            <label class='labelcss' for='ta'>Pelaksanaan:&nbsp;&nbsp;</label>
            <textarea name='pelaksanaan'  style ='font-family:verdana;border-radius: 8px;width:90%;resize:none' class='border ml-3 ' rows='5' cols='85' name='pelaksanaan' required><?php if (isset($_SESSION['id'])){ echo $pelaksanaan; } ?></textarea>
			</div>
			<div>
			<label class='labelcss' for='ta'>Pra-Penilaian:&nbsp;</label>
            <textarea name='penilaian'  style ='font-family:verdana;border-radius: 8px;width:90%;resize:none' class='border ml-3 ' rows='5' cols='85' name='pra-penilaian' required><?php if (isset($_SESSION['id'])){ echo $penilaian; } ?></textarea>
			</div>
			<div align='left'>
				AJK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <button type='button' name='add' id='add' class='btn btn-info'>Tambah</button>
			</div>
			<br/>
			<div id='result'></div>
		<div style='text-align:center'>
		<button style=' background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer; border-radius:4px'  type='submit' >Seterusnya</button>
		<a style='background-color:#00009D;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;display: inline-block;border-radius:4px' href='index.php'>Batal</a>
		</div>
		</form>
		</div>
		
		</div>
		</div>
		</div>
	</body>
</html>

<div id='dynamic_field_modal' class='modal fade' role='dialog'>
	<div class='modal-dialog' style='width:40%'>
		<div class='modal-content'>
			<form method='post' id='add_name'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal'>&times;</button>
					<h4 class='modal-title'>Tambah Staff</h4>
				</div>
				<div class='modal-body'>
					<div class='form-group'>
					<div class='table-responsive'>
		      			<table class='table' id='dynamic_field'>
							<input style='display:inline-block;width:20%;margin-right:10px' type='text' name='staff_no[]' id='name' class='form-control' placeholder='Staff no' required><input style='width:40%;margin-right:10px' type='text' id='nama' name='name[]' placeholder='Nama staff' class='form-control name_list' required><input style='width:30%' type='text' name='organisasi[]' placeholder='Organisasi staff' class='form-control name_list' required>
					  </table>
		      		</div>	
		      	  </div>
				</div>
				<div class='modal-footer'>
					<input type='hidden' name='hidden_id' id='hidden_id' />
					<input type='hidden' name='action' id='action' value='insert' />
					<input type='submit' name='submit' id='submit' class='btn btn-info' value='Simpan' />
				</div>
			</form>
		</div>
	</div>

</div>


<script>
$(document).ready(function(){

	load_data();

	var count = 1;

	function load_data()
	{
		$.ajax({
			url:'fetch.php',
			method:'POST',
			success:function(data)
			{
				$('#result').html(data);
			}
		})
	}

	function add_dynamic_input_field(count)
	{
		
		
	}

	$('#add').click(function(){
		$('#dynamic_field').html('');
		add_dynamic_input_field(1);
		$('.modal-title').text('Tambah Staff');
		$('#action').val('insert');
		$('#submit').val('Simpan');
		$('#add_name')[0].reset();
		$('#dynamic_field_modal').modal('show');
	});

	$(document).on('click', '#add_more', function(){
		count = count + 1;
		add_dynamic_input_field(count);
	});

	$(document).on('click', '.remove', function(){
		var row_id = $(this).attr('id');
		$('#row'+row_id).remove();
	});

	$('#add_name').on('submit', function(event){
		event.preventDefault();
		if($('#nama').val() == '')
		{
			alert('Sila masukkan nama staff');
			return false;
		}
		var total_languages = 0;
		$('.name_list').each(function(){
			if($(this).val() != '')
			{
				total_languages = total_languages + 1;
			}
		});

		if(total_languages > 0)
		{
			var form_data = $(this).serialize();

			var action = $('#action').val();
			$.ajax({
				url:'staff_list.php',
				method:'POST',
				data:form_data,
				success:function(data)
				{
					if(action == 'insert')
					{
						alert('Data Inserted');
					}
					if(action == 'edit')
					{
						alert('Data Edited');
					}
					add_dynamic_input_field(1);
					load_data();
					$('#add_name')[0].reset();
					$('#dynamic_field_modal').modal('hide');
				}
			});
		}
		else
		{
			alert('Please insert staff details');
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		$.ajax({
			url:'select.php',
			method:'POST',
			data:{id:id},
			dataType:'JSON',
			success:function(data)
			{
				$('#name').val(data.name);
				$('#dynamic_field').html(data.programming_languages);
				$('#action').val('edit');
				$('.modal-title').text('Edit Details');
				$('#submit').val('Edit');
				$('#hidden_id').val(id);
				$('#dynamic_field_modal').modal('show');
			}
		});
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr('staff_no');
		if(confirm('Are you sure want to remove this data?'))
		{
			$.ajax({
				url:'delete.php',
				method:'POST',
				data:{id:id},
				success:function(data)
				{
					load_data();
					alert('Data removed');
				}
			})
		}
	});

});
</script>




