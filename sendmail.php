<?php
include_once('server.php');

$sqlp = "SELECT * FROM projects where id=".$_SESSION['id'];
	$result = mysqli_query($db, $sqlp);
	while($rows = mysqli_fetch_array($result)){
		$registeredby = $rows['registeredby'];
		$project_name = $rows['nama_projek'];
		$sqlu = "SELECT * FROM users WHERE email =".$registeredby;
		while($rows = mysqli_fetch_array($result)){
		$name = $rows['name'];
	}
	}
if(isset($_POST['save'])){
	$to = "nizam.yuseri@gmail.com";
	$subject = "Comet Admin";
	$txt = $name." telah mendaftar projek '".$_POST['nama_projek']."' dan memerlukan kelulusan daripada anda.";
	$headers = "From: CometAdmin@uum.edu.my";
	mail($to,$subject,$txt,$headers);
}else if(isset($_POST['lulus'])){
	$to = $registeredby;
	$subject = "Comet Admin";
	$txt = "Permintaan projek \"".$project_name."\" anda telah diluluskan. Anda boleh menghantar laporan projek ke dalam sistem comet setiap 6 bulan bermula dari tarikh mula projek anda.";
	$headers = "From: CometAdmin@uum.edu.my";
	mail($to,$subject,$txt,$headers);
}else if(isset($_POST['sah_tamat'])){
	$to = $registeredby;
	$subject = "Comet Admin";
	$txt = "Permintaan projek \"".$project_name."\" anda telah disahkan sebagai tamat. Anda boleh mencetak laporan projek anda";
	$headers = "From: CometAdmin@uum.edu.my";
	mail($to,$subject,$txt,$headers);
}

"Hi there, click on this <a href=\"localhost/comet/new_pass.php?token=" . $_SESSION['token'] . "\">link</a> to reset your password on our site";
?>