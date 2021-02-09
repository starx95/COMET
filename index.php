<?php 
include('server.php');
if($result = mysqli_query($db, "SELECT * FROM users WHERE email='".$_SESSION['email']."'")){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
			$_SESSION['pusat'] = $row['pusat_tanggungjawab'];
			$_SESSION['tahap'] = $row['tahap'];
			$_SESSION['pic'] = $row['img'];
			$ext = $row['ext'];
			$id = $row['id'];
		}
	}
}

if($ext == ''){
	$_SESSION['msg'] = "Sila kemaskini butiran anda terlebih dahulu";
	//header('location:edit_profile.php');
}
	
	if($_SESSION['tahap'] == 2){
		$sql = "SELECT * FROM projects WHERE ptj='".$_SESSION['pusat']."'";
	} else {
		$sql = "SELECT * FROM projects WHERE registeredby='".$_SESSION['email']."'";
	}
	
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
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
    <link rel="stylesheet"
        href="https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
    @media screen and (max-width: 481px) {}


    body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: url('bg.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password],
    input[type=email] {
        width: 97%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    .logoutbutton {
        background-color: #00009D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border-radius: 30px;
        height: 20px border: none;
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
        align-items: center;
        margin: 10px;
    }

    .container {
        padding: 1px;
    }

    span.psw {
        float: right;
        padding-top: 4px;
        padding-right: 40px;
    }

    .forgot {
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

    .forgot .psw {
        float: right;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        /* 5% from the top, 5% from the bottom and centered */
        width: 100%;
        /* Could be more or less, depending on screen size */
    }

    .title {
        font-family: "arial black";
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

    a:link,
    a:visited {
        color: (internal value);
        text-decoration: underline;
        text-align: center;
        cursor: auto;
    }

    a:link:active,
    a:visited:active {
        color: (internal value);
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
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

        a.menu_links {
            cursor: pointer;
        }
    }

    th {
        text-align: center;
        valign: middle;

    }

    td {
        text-align: center;
        valign: middle
    }

    .btn {
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
    }

    .star-rating {
        font-size: 0;
    }

    .star-rating__wrap {
        display: inline-block;
        font-size: 2rem;
    }

    .star-rating__wrap:after {
        content: "";
        display: table;
        clear: both;
    }

    .star-rating__ico {
        float: right;
        padding-left: 2px;
        cursor: pointer;
        color: #FFB300;
    }

    .star-rating__ico:last-child {
        padding-left: 0;
    }

    .star-rating__input {
        display: none;
        height: 25px;
        width: 25px;
    }

    .star-rating__input:checked~.star-rating__ico:before {
        content: "\f005";
    }

    @media print {
        @page {
            size: landscape;
            margin: 0;
        }

        body * {
            visibility: hidden;
        }

        .hides * {
            display: none;
        }

        .div2 * {
            visibility: visible;
        }

        .div2 * {
            visibility: visible;
        }

        a[href]:after {
            content: none !important;
        }
    }

    a:hover {
        opacity: 0.8;
    }
    </style>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="crudApp" class="container" style=" width: 80%;">
        <div class="modal-content">
            <div type="hidden" class="content" style="display: inline-block;width: auto ">
                <!-- notification message -->
                <?php if (isset($_SESSION['success'])) : ?>
                <div type="hidden" class="error success">
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
                <button @click="logout" v-if="loggedIn">Log Keluar</button>
                <?php endif ?>

            </div>

            <div class="hides" style=";margin-top: -20px;">
                <a id="logout" href="server.php?logout=true" class="btn btn-info btn-lg"
                    style="font-size:12px;cursor:pointer; position:absolute;top:4px;right:4px;  text-decoration: none;"><span
                        style="margin-right:2px" class="glyphicon glyphicon-log-out"></span>Log Keluar</a>

                <div id="div" align="center" class="img hides">

                    <img style="display:inline-block" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>"
                        alt="profile picture" width="215px" height="220px" style="margin-left:20px" id="img"></img>
                    <p id="detail" style="margin-left:20px" class="text-left">Name:
                        <?php echo $_SESSION['name']; ?></br>Pusat Tanggungjawab:
                        <?php echo $_SESSION['pusat'];?></br><a style="cursor:pointer;text-decoration:none"
                            href='edit_profile.php?id=<?php echo $id; ?>'>Ubahsuai Profil</a></p>
                </div>
                <div id="divhead"></div>

                <div>
                    <br>
                    <br>
                    <div class="containers" id="tambah">
                        <?php if ($_SESSION['tahap'] == 1) { ?>
                        <a style=" cursor: pointer;display:inline-block;text-decoration:none" href='add.php'><img
                                style="margin:10px; width:35px; height:35px; cursor: pointer;" src="plus.png"
                                class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full image"
                                clickable>Tambah program baru</img></a>
                        <?php } else if ($_SESSION['tahap'] == 2) { ?>
                        <a style=" cursor: pointer;display:inline-block;text-decoration:none" href='dashboard.php'><img
                                style="margin:10px; width:35px; height:35px; cursor: pointer;" src="dashboard.png"
                                class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full image"
                                clickable>Dashboard</img></a>
                        <a style="float:right;margin-top:4px;cursor: pointer;margin-right:6px;text-decoration:none"
                            href='searchform.php'>Carian<img
                                style="align-items:right;margin:8px; width:35px; height:35px; cursor: pointer;"
                                src="search.png"
                                class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full image"
                                clickable></img></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--<transition name="model">-->
            <div align="center" class="div2"><b>SENARAI PROJEK</b></div>
            <div class="modal-body div2" id="crudApp">
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th id="projek_id">Projek ID</th>
                                <th>Nama Projek</th>
                                <th id="tarikh_mula">Tarikh Mula</th>
                                <th id="tarikh_tamat">Tarikh Tamat</th>
                                <th>Penarafan</th>
                                <th>Status</th>
                                <th colspan="2" id="tindakan">Tindakan</th>
                            </tr>
                            <tr>
                                <?php

      if($result = mysqli_query($db, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
			if(isset($row['nama_projek'])){ ?>
                            <tr>
                                <td id='projek_id'> <?php echo $row['id']; ?> </td>
                                <td><?php echo $row['nama_projek']; ?></td>
                                <td id='tarikh_mula'><?php echo $row['tarikh_mula']; ?> </td>
                                <td id='tarikh_tamat'><?php echo $row['tarikh_tamat']; ?></td>
                                <td>
                                    <div class="star-rating">
                                        <div class="star-rating__wrap">
                                            <?php 
									$ratings = $row['penarafan'];
									if (strpos($ratings,"5") !== false){
									?>
                                            <input disabled class="star-rating__input" id="star-rating-5" type="radio"
                                                value="5" style="pointer-events:none"
                                                <?php if (strpos($ratings,"5") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5"
                                                title="5 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-4" type="radio"
                                                value="4" style="pointer-events:none"
                                                <?php if (strpos($ratings,"4") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4"
                                                title="4 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-3" type="radio"
                                                value="3" style="pointer-events:none"
                                                <?php if (strpos($ratings,"3") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3"
                                                title="3 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-2" type="radio"
                                                value="2" style="pointer-events:none"
                                                <?php if (strpos($ratings,"2") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2"
                                                title="2 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-1" type="radio"
                                                value="1" style="pointer-events:none"
                                                <?php if (strpos($ratings,"1") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1"
                                                title="1 out of 5 stars" disabled></label><label
                                                style="fa fa-star-o fa-lg float: right;color: #FFB300;">5</label>
                                            <?php } else if (strpos($ratings,"4") !== false){
									?>
                                            <input disabled class="star-rating__input" id="star-rating-4" type="radio"
                                                value="4" style="pointer-events:none"
                                                <?php if (strpos($ratings,"4") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4"
                                                title="4 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-3" type="radio"
                                                value="3" style="pointer-events:none"
                                                <?php if (strpos($ratings,"3") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3"
                                                title="3 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-2" type="radio"
                                                value="2" style="pointer-events:none"
                                                <?php if (strpos($ratings,"2") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2"
                                                title="2 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-1" type="radio"
                                                value="1" style="pointer-events:none"
                                                <?php if (strpos($ratings,"1") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1"
                                                title="1 out of 5 stars" disabled></label><label
                                                style="fa fa-star-o fa-lg float: right;color: #FFB300;">4</label>
                                            <?php } else if (strpos($ratings,"3") !== false){
									?>
                                            <input disabled class="star-rating__input" id="star-rating-3" type="radio"
                                                value="3" style="pointer-events:none"
                                                <?php if (strpos($ratings,"3") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3"
                                                title="3 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-2" type="radio"
                                                value="2" style="pointer-events:none"
                                                <?php if (strpos($ratings,"2") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2"
                                                title="2 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-1" type="radio"
                                                value="1" style="pointer-events:none"
                                                <?php if (strpos($ratings,"1") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1"
                                                title="1 out of 5 stars" disabled></label><label
                                                style="fa fa-star-o fa-lg float: right;color: #FFB300;">3</label>
                                            <?php } else if (strpos($ratings,"2") !== false){
									?>
                                            <input disabled class="star-rating__input" id="star-rating-2" type="radio"
                                                value="2" style="pointer-events:none"
                                                <?php if (strpos($ratings,"2") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2"
                                                title="2 out of 5 stars" disabled></label>
                                            <input disabled class="star-rating__input" id="star-rating-1" type="radio"
                                                value="1" style="pointer-events:none"
                                                <?php if (strpos($ratings,"1") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1"
                                                title="1 out of 5 stars" disabled></label><label
                                                style="fa fa-star-o fa-lg float: right;color: #FFB300;">2</label>
                                            <?php }if (strpos($ratings,"1") !== false){
									?>
                                            <input disabled class="star-rating__input" id="star-rating-1" type="radio"
                                                value="1" style="pointer-events:none"
                                                <?php if (strpos($ratings,"1") !== false){ echo "checked";} ?>>
                                            <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1"
                                                title="1 out of 5 stars" disabled></label><label
                                                style="fa fa-star-o fa-lg float: right;color: #FFB300;">1</label>
                                            <?php }?>
                                        </div>
                                    </div>
                                </td>
                                <?php if ($row['status'] == 'Pending'){$style="orange";} else if ($row['status'] == 'Aktif') { $style="green";} else { $style="blue";} ?>
                                <td style='color:<?php echo $style ?>'><?php echo $row['status']; ?> </td>

                                <?php if($_SESSION['tahap'] == 2){
						$user ="<td><a id='btn2' name='btn1' style='cursor: pointer; display:block;text-decoration:none' href='view.php?id=".$row['id']."'>Lihat<i class='fa fa-eye menu-links'  onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' clickable></i></a></td>";
						echo $user;
					} else {
						if($row['status'] == "Pending"){
							echo "<td><a id='btn1' name='btn1' style='cursor: pointer; display:block;text-decoration:none' href='add.php?id=".$row['id']."'>Kemaskini<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' disabled></i></a></td>";
							echo "<td><a id='btn1' name='buang' style='cursor: pointer; display:block;text-decoration:none' href='buang.php?id=".$row['id']."'>Buang<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' clickable></i></a></td>";

						} else if($row['status'] == "Aktif"){
						if(strtotime($row['tarikh_tamat']) < strtotime("now")){
							echo "<td><a id='btn1' name='btn1' style='cursor: pointer; display:block;text-decoration:none' href='output.php?id=".$row['id']."'>Kemaskini<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' disabled></i></a></td>";
							echo "<td><a id='btn1' name='buang' style='cursor: pointer; display:block;text-decoration:none' href='buang.php?id=".$row['id']."'>Buang<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' clickable></i></a></td>";

						}else{
							echo "<td><a id='btn1' name='btn1' style='cursor: pointer; display:block;text-decoration:none' href='laporan.php?id=".$row['id']."'>Kemaskini<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' clickable></i></a></td>";
							echo "<td><a id='btn1' name='buang' style='cursor: pointer; display:block;text-decoration:none' href='buang.php?id=".$row['id']."'>Buang<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' clickable></i></a></td>";
						}
						} else if($row['status'] == "Tamat"){
							echo "<td><a id='btn1' name='btn1' style='cursor: pointer; display:block;text-decoration:none' href='generate_pdf.php?id=".$row['id']."' value='".$row['id']."'>Cetak<i class='fa fa-print menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' disabled></i></a></td>";
							echo "<td><a id='btn1' name='buang' style='cursor: pointer; display:block;text-decoration:none' href='buang.php?id=".$row['id']."'>Buang<i class='fa fa-pencil-square-o menu-links' onmouseover='' style='font-size:18px; margin-left:5px; cursor: pointer;' clickable></i></a></td>";

						}
						}
			}
		echo "</tr>";
      }
      echo "</table>";
	} else {
				echo "<tr><td colspan='7'>Tiada projek didaftarkan</td></tr></table>";
			}
      // Free result set
      mysqli_free_result($result);
	  }?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <center><div id="cetak" class=" hides"><a class="btn btn-info btn-lg " style="font-size:14px;cursor:pointer; margin:4px; float:right;  text-decoration: none;background-color:#0c7cd5;" onClick="window.print()"><span style="margin-right:2px;font-size: 15px;"  class="glyphicon glyphicon-print lg "></span>cetak</a></div></center>
                </div>
                <br />
            </div>
        </div>
    </div>
</body>
<script>
window.onload = function() {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        var img = document.getElementById("img");
        var detail = document.getElementById("detail");
        var div = document.getElementById("div");
        var divhead = document.getElementById("divhead");
        var logout = document.getElementById("logout");
        var col = document.getElementById("projek_id");
        var btn = document.getElementsByName("btn1");
        document.getElementById("detail").style.display = "none";
        document.getElementById("tambah").style.display = "none";
        document.getElementById("cetak").style.display = "none";
        document.getElementById("img").style.marginTop = "50px";
        document.getElementById("crudApp").style.width = "90%";
        img.style.height = "180px";
        img.style.width = "170px";
        div.className = "";
        div.innerHTML = "<div align='center'>" + div.innerHTML + "</div>";
        detail.innerHTML = "<p style='text-align:center' >" + detail.innerHTML;
        divhead.innerHTML += "<br>" + "\n" + detail.innerHTML + "</br>";
        detail.style.width = "100%";
        document.getElementById("star-rating-5").disabled = true;
        document.getElementById("star-rating-4").disabled = true;
        document.getElementById("star-rating-3").disabled = true;
        document.getElementById("star-rating-2").disabled = true;
        document.getElementById("star-rating-1").disabled = true;

        console.log("mobile");
    } else {
        var detail = document.getElementById("detail").style.display = "block";
    }
}

var application = new Vue({
    el: '#crudApp',
    data: {
        allDatas: '',
        myModel: false,
        actionButton: 'Insert',
        dynamicTitle: 'Add Data',
    },
    methods: {
        fetchAllData: function() {
            axios.post('action.php', {
                action: 'fetchall'
            }).then(function(response) {
                application.allDatas = response.data;
            });
        },
        openModel: function() {
            application.first_name = '';
            application.last_name = '';
            application.actionButton = "Insert";
            application.dynamicTitle = "Add Data";
            application.myModel = true;
        },
        submitData: function() {
            if (application.nama_projek != '' && application.penarafan != '') {
                if (application.actionButton == 'Insert') {
                    axios.post('action.php', {
                        action: 'insert',
                        nama_projek: application.nama_projek,
                        penarafan: application.penarafan
                    }).then(function(response) {
                        application.myModel = false;
                        application.fetchAllData();
                        application.nama_projek = '';
                        application.penarafan = '';
                        alert(response.data.message);
                    });
                }
                if (application.actionButton == 'Update') {
                    axios.post('action.php', {
                        action: 'update',
                        firstName: application.first_name,
                        lastName: application.last_name,
                        hiddenId: application.hiddenId
                    }).then(function(response) {
                        application.myModel = false;
                        application.fetchAllData();
                        application.first_name = '';
                        application.last_name = '';
                        application.hiddenId = '';
                        alert(response.data.message);
                    });
                }
            } else {
                alert("Fill All Field");
            }
        },
        fetchData: function(id) {
            axios.post('action.php', {
                action: 'fetchSingle',
                id: id
            }).then(function(response) {
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
        deleteData: function(id) {
            if (confirm("Are you sure you want to remove this data?")) {
                axios.post('action.php', {
                    action: 'delete',
                    id: id
                }).then(function(response) {
                    application.fetchAllData();
                    alert(response.data.message);
                });
            }
        }
    },
    created: function() {
        this.fetchAllData();
    }
});

// Get the modal

var modal = document.getElementById('id01');

$(window).on('load', function() {
    $('#id01').modal('show');
});
</script>

</html>