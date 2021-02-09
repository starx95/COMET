<?php 
include('server.php');
$_SESSION['delete'] = "delete";
if(isset($_SESSION['id'])){
if(isset($_SESSION['nama_projek'])){
	$name = str_replace(' ', '_', $_SESSION['nama_projek']);
}}
if (isset($_GET['id']) && $_GET['id'] != ""){
	$_SESSION['update'] = "update";
	$_SESSION['id']=$_GET['id'];
	$sql = "SELECT * FROM projects WHERE id=".$_GET['id']."";
	 if($result = mysqli_query($db, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
	
			$_SESSION['nama_projek_lama'] = $row['nama_projek'];
			$nama_projek = $row['nama_projek'];
			$lokasi = $row['lokasi'];
			$sumbangan = $row['sumbangan'];
			$tarikh_mula = $row['tarikh_mula'];
			$tarikh_tamat = $row['tarikh_tamat'];
			$sokod = $row['so'];
			$pemindahan = $row['pemindahan'];
			$negeri = $row['negeri'];
			$penglibatan_komuniti = $row['penglibatan_komuniti'];
}}}}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;background-image: url('bg.jpg');  background-repeat: no-repeat;
  background-attachment: fixed;}

td,th {
text-align: center;
} 

.modal-backdrop {
  z-index: -1;
}

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
	background-color: 		#00009D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
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

.ui-helper-center {
    text-align: center;
}

</style>
	<title>Comet</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <div class="container"  style=" width: 1100px;">
	<div class="modal-content">
    <div class="border max-w rounded overflow-hidden shadow-lg" style="margin:20px">
      <div class="px-6 py-4" ><p class="text-right" style ='font-family:verdana;margin:4px' >Pendaftaran Projek Baru</p>
          <div class="img">
            <img class="img2 border" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="200" height="200">  <span style ='font-family:verdana;margin:4px'  class="text-left">Name: <?php echo $_SESSION['name']; ?>
            <br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></span>
          </div>

        </div>
		<form method="post" action="project_background.php?id=<?php if(isset($_GET['id'])){ echo $_GET['id']; } else {} ?>">
        <table  id="myTable" class="table table-bordered table-striped" >
          <thead>
          <tr class="bg-gray-100">
            <th  class="border text-center">Nama Projek</th>
            <td class="border  width center">
			<input style="height:35px;" value="<?php if(isset($_GET['id'])){echo $nama_projek;}?>" placeholder="project name" id="name" name="nama_projek" class="border  width" type="text" required></td>
            <th class="border  text-center">Negeri</th>
            <td class="border  dropdown"> 
			<select name="negeri" style="height:35px;border-radius:5px;" class="border px-13 py-2" id = "myList" required>
              <option value = "Perak">Perak</option>
              <option value = "Melaka">Melaka</option>
              <option value = "Kedah">Kedah</option>
              <option value = "Pulau Pinang">Pulau Pinang</option>
              <option value = "Terengganu">Terengganu</option>
              <option value = "Perlis">Perlis</option>
              <option value = "Sarawak">Sarawak</option>
              <option value = "Negeri Sembilan">Negeri Sembilan</option>
              <option value = "Pahang">Pahang</option>
              <option value = "Selangor">Selangor</option>
              <option value = "Johor">Johor</option>
              <option value = "Kelantan">Kelantan</option>
              <option value = "Sabah">Sabah</option>
            </select></td>
			<script>
				const myList = document.querySelector('#myList');
				myList.value = "<?php echo $negeri; ?>";
			</script>
          </tr>
          </thead>
          <tbody>
          <tr class="bg-gray-100">
            <th class="border text-center">Lokasi</th>
            <td colspan="3" class="border ">
			<input name="lokasi" value="<?php if(isset($_GET['id'])){echo $lokasi;}?>" style="height:35px" placeholder="Location" class="border  width"  type="text " required></td>
          </tr>
          <tr class="bg-gray-100">
            <th class="border " >Penglibatan Organisasi Luar</th>
            <td class="border"><?php if (isset($_GET['id'])){?><div id="result"></div><button type="button" name="adds" id="adds" class="btn btn-info">Tambah</button><?php } else { ?><input name="Penglibatan_Organisasi_Luar[]" style="height:35px;width:82%" placeholder="External Organizational Involvement" class="border" type="text " required>
			<a style="border-radius:4px" class="btn add">+</a><a style="margin-left:4px" class="btn remove">-</a>
			<div id="new_chq"></div>
			<input type="hidden" value="1" id="total_chq">
			<?php } ?>
            <th  class="border " valign="center">Sumbangan (jika ada)</th>
            <td  class="border "><input value="<?php if(isset($_GET['id'])){echo $sumbangan;}?>" name="sumbangan" style="margin-top:17px;height:35px" placeholder="Donations" class="border  width" type="text "></td>
          </tr>
          <tr class="bg-gray-100">
            <th class="border text-center">Tarikh mula</th>
            <td class="border "><input value="<?php if(isset($_GET['id'])){echo $tarikh_mula;}?>" style="height:35px" class="border " type="date" id="mula" name="mula" required>
            <th class="border  text-center">Tarikh Tamat</th>
            <td class="border "><input value="<?php if(isset($_GET['id'])){echo $tarikh_tamat;}?>" style="height:35px" class="border " type="date" id="tamat" name="tamat" required></td>
          </tr>
          <tr class="bg-gray-100">
            <th class="border  text-center">S/O Kod (jika ada)</th>
            <td colspan="3" class="border "><input value="<?php if(isset($_GET['id'])){echo $sokod;}?>" name="S/O_kod" style="height:35px" class="border  width" type="text "></td>

          </tr>
          <tr class="bg-gray-100">
            <th class="border  text-center">Pemindahan Ilmu</th>
            <td colspan="3" class="border px-1 py-1">
			<form required>
			  <input type="radio" id="ya" name="pemindahan_ilmu" value="ya" <?php if(isset($_GET['id'])){if($pemindahan == "ya"){echo "checked";}} ?> required>
			  <label for="ya">Ya</label>
			  <input style="margin-left:6px" type="radio" id="tidak" name="pemindahan_ilmu" value="tidak" <?php if(isset($_GET['id'])){if($pemindahan == "tidak"){echo "checked";}} ?>>
			  <label for="tidak">Tidak</label><br>
			</td>
          </tr>
		  <tr class="bg-gray-100">
            <th class="border  text-center">Penglibatan Komuniti</th>
            <td colspan="3" class="border px-1 py-1">
		
			  <input type="radio" name="penglibatan_komuniti" value="ya" <?php if(isset($_GET['id'])){if($penglibatan_komuniti == "ya"){echo "checked";}} ?> required>
			  <label for="ya">Ya</label>
			  <input style="margin-left:6px" type="radio" name="penglibatan_komuniti" value="tidak" <?php if(isset($_GET['id'])){if($penglibatan_komuniti == "tidak"){echo "checked";}} ?>>
			  <label for="tidak">Tidak</label><br>
			</form>
			</td>
          </tr>
          </tbody>
        </table>

      <tr></tr>
      <tr></tr>
      <button type="submit" style="border-radius:4px">Simpan</button>
      <a style="border-radius:4px;cursor:pointer" href="index.php">Batal</a>
	  </form>
      </div>
    </div>
	</div>
</body>
</html>
<div id="dynamic_field_modal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:40%">
		<div class="modal-content">
			<form method="post" id="add_name">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Organisasi</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
					<div class="table-responsive">
		      			<table class="table" id="dynamic_field">
							<label for="penglibatan" >Nama Organisasi:</label><input style="margin-left:2px;display:inline-block;width:80%;margin-right:10px;align:center" type="text" name="penglibatan" id="penglibatan" class="form-control name_list" placeholder="Masukkan nama organisasi" required>
					  </table>
		      		</div>	
		      	  </div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
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
			url:"fetch_organisasi.php",
			method:"POST",
			success:function(data)
			{
				$('#result').html(data);
			}
		})
	}

	function add_dynamic_input_field(count)
	{
			
	}

	$(document).on('click', '#add_more', function(){
		count = count + 1;
		add_dynamic_input_field(count);
	});

	$(document).on('click', '.remove', function(){
		var row_id = $(this).attr("id");
		count = count - 1;
		$('#row'+row_id).remove();
	});

	$('#add_name').on('submit', function(event){
		event.preventDefault();
		if($('#penglibatan').val() == '')
		{
			alert("Enter Your Name");
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
				url:"organisasi_list.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					if(action == 'insert')
					{
						
					}
					if(action == 'edit')
					{
						
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
			alert("Sila masukkan nama organisasi");
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr("id");
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{id:id},
			dataType:"JSON",
			success:function(data)
			{
				$('#name').val(data.name);
				$('#dynamic_field').html(data.programming_languages);
				$('#action').val('edit');
				$('.modal-title').text("Edit Details");
				$('#submit').val("Edit");
				$('#hidden_id').val(id);
				$('#dynamic_field_modal').modal('show');
			}
		});
	});

	$('#adds').click(function(){
		$('#dynamic_field').html('');
		add_dynamic_input_field(1);
		$('.modal-title').text('Tambah Organisasi');
		$('#action').val("insert");
		$('#submit').val('Submit');
		$('#add_name')[0].reset();
		$('#dynamic_field_modal').modal('show');
	});

});

	

    $('.add').on('click', add);
    $('.remove').on('click', remove);

function add() {
  var new_chq_no = parseInt($('#total_chq').val()) + 1;
  var new_input = "<input name='Penglibatan_Organisasi_Luar[]' style='height:35px;width:82%;margin-bottom:4px;margin-right:74px' placeholder='External Organizational Involvement' class='border' type='text' id='new_" + new_chq_no + "'>";

  $('#new_chq').append(new_input);
  
  $('#total_chq').val(new_chq_no);
}

function remove() {
  var last_chq_no = $('#total_chq').val();

  if (last_chq_no > 1) {
    $('#new_' + last_chq_no).remove();
    $('#total_chq').val(last_chq_no - 1);
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
  
  th {
    white-space: nowrap;
}
</style>