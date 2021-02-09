<?php
require "server.php";// Database connection

?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="http://example.com/favicon.png">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<title>Dashboard</title>
<style>
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
  background-color: #1669ee;
  border: none;
  color: white;

  text-align: center;
  font-size: 10px;
  margin: 4px 2px;
  transition: 0.3s;
}

.btn:hover {
	opacity: 1
	background-color: #2874ef;
}


</style>
</head>
<body>
<div class='container' style='width:80%'>
<div class='modal-content' style='height:1400px;'>
<div class="img" >
	<img style="margin-left:20px;margin-top:20px" class="img2 border" src="<?php echo "uploads/profil/". $_SESSION['pic']; ?>" alt="profile picture" width="200" height="200"> 
		<span class="text-left" style="margin-left:20px">Name: <?php echo $_SESSION['name']; ?></br>Pusat Tanggungjawab: <?php echo $_SESSION['pusat'];?></span>
		</div>
<?php
if($stmt= $db->query("SELECT * FROM projects")){
	$php_data_array_program = Array();
	$php_data_array_agensi = Array();
	$php_data_array_dana = Array();// create PHP array
	$php_data_array_skop = Array();
	$php_data_array_sdg = Array();
	$num_program = mysqli_num_rows($stmt);
	$no = 0;
	$dana = 0;
	$pending = 0;
	$aktif = 0;
	$tamat = 0;
	$pusat = "init";
	$php_data_array_program=array(array("",""));
	$pendidikan = 0;$ekonomi=0;$kelestarian=0;$keterangkuman=0;$pembangunan=0;$kesejahteraan=0;$perubahan=0;$sulam=0;$poverty=0;$hunger = 0;$health= 0;$education = 0;$equality = 0;$water = 0;$clean = 0;$work = 0;$production = 0;$industry= 0;$reduced = 0;$sustainable = 0;$climate = 0;$life = 0;$live = 0;$peace = 0;$partnerships = 0;
	$str_pendidikan="Pendidikan";$str_kelestarian="Kelestarian";$str_keterangkuman="Keterangkuman";$str_sulam="Sulam";$str_perubahan="Perubahan";$str_ekonomi="Ekonomi";$str_pembangunan="Pembangunan";$str_kesejahteraan="Kesejahteraan";
	$str_poverty="Poverty";$str_hunger = "No hunger";$str_health="Good Health & Well being" ;$str_education = "Quality Education";$str_equality = "Gender Equality";$str_water = "Clean Water & Sanitation";$str_clean = "Affordable & Clean Energy";$str_work = "Decent Work & Economic Growth";$str_production = "Responsible Production & Consumption";$str_industry= "Industry, Innovation & Infrastructure";$str_reduced = "Reduced Inequality";$str_sustainable = "Sustainable Cities & Communities";$str_climate = "Climate Action";$str_life = "Life Below Water";$str_live = "Live on Land";$str_peace = "Peace & Justice Strong Institution";$str_partnerships = "Partnerships to Achieve the Goal";
	$str_pending="Pending";$str_tamat="Tamat";$str_aktif="Aktif";
	while ($row = mysqli_fetch_array($stmt)) {
		
		if($row['status']=="Pending"){
			$pending += 1;	
		}if($row['status']=="Tamat"){
			$tamat += 1;
		}if($row['status']=="Aktif"){
			$aktif += 1;
		}if (strpos($row['sdg'],"Poverty")){
			$poverty += 1;
		}if (strpos($row['sdg'],"Hunger")){
			$hunger += 1;
		}if (strpos($row['sdg'],"Health")){
			$health += 1;
		}if (strpos($row['sdg'],"Education")){
			$education += 1;
		}if (strpos($row['sdg'],"Equality")){
			$equality += 1;
		}if (strpos($row['sdg'],"Water")){
			$water += 1;
		}if (strpos($row['sdg'],"Clean")){
			$clean += 1;
		}if (strpos($row['sdg'],"Work")){
			$work += 1;
		}if (strpos($row['sdg'],"Production")){
			$production += 1;
		}if (strpos($row['sdg'],"Industry")){
			$industry += 1;
		}if (strpos($row['sdg'],"Reduced")){
			$reduced += 1;
		}if (strpos($row['sdg'],"Sustainable")){
			$sustainable += 1;
		}if (strpos($row['sdg'],"Climate")){
			$climate += 1;
		}if (strpos($row['sdg'],"life")){
			$life += 1;
		}if (strpos($row['sdg'],"Live")){
			$live += 1;
		}if (strpos($row['sdg'],"Peace")){
			$peace += 1;
		}if (strpos($row['sdg'],"Partnerships")){
			$partnerships += 1;
		} 
		$no += (int)$row['penglibatan'];
		if (strpos($row['skop'],"Pendidikan")){
			$pendidikan += 1;
		} if (strpos($row['skop'],"Ekonomi")){
			$ekonomi += 1;
		} if (strpos($row['skop'],"Kelestarian")){
			$kelestarian += 1;
		} if (strpos($row['skop'],"Keterangkuman")){
			$keterangkuman += 1;
		}if (strpos($row['skop'],"Pembangunan")){
			$pembangunan += 1;
		}if (strpos($row['skop'],"Kesejahteraan")){
			$kesejahteraan += 1;
		}if (strpos($row['skop'],"Perubahan")){
			$perubahan += 1;
		}if (strpos($row['skop'],"Sulam")){
			$sulam += 1;
		}
		
		$php_data_array_agensi[] = $no;
		$res = preg_replace("/[^0-9]/", "", $row['sumbangan'] );
		$dana += (int)$res;
		$php_data_array_dana[] = $dana; // Adding to array
	}
		$php_data_array_program = array(array($str_pending,$pending),array($str_aktif,$aktif),array($str_tamat,$tamat));
		$php_data_array_skop = array(array($str_pendidikan,$pendidikan),array($str_ekonomi,$ekonomi),array($str_kelestarian,$kelestarian),array($str_keterangkuman,$keterangkuman),array($str_pembangunan,$pembangunan),array($str_kesejahteraan,$kesejahteraan),array($str_perubahan,$perubahan),array($str_sulam,$sulam));
		$php_data_array_sdg = array(array($str_poverty,$poverty),array($str_hunger,$hunger),array($str_health,$health),array($str_education,$education),array($str_equality,$equality),array($str_water,$water),array($str_clean ,$clean),array($str_work,$work),array($str_production,$production),array($str_industry,$industry),array($str_reduced,$reduced),array($str_sustainable,$sustainable),array($str_climate,$climate),array($str_life,$life),array($str_live,$live),array($str_peace,$peace),array($str_partnerships,$partnerships));
}

if($query = $db->query("SELECT ptj FROM projects")){
	
$iptdmm = 0;
$ipkk = 0;
$yab = 0;
$trade = 0;
$tm =0;
$sme = 0;
$sd = 0;
$proton = 0;
$petro = 0;
$misc = 0;
$may = 0;
$mas = 0;
$grantt = 0;
$bsn =0;
$rakyat = 0;
$muamalat = 0;
$gsgsg = 0;
$ahsgsas = 0;
$agnu = 0;
$pip = 0;
$phek = 0;
$pbs = 0;
$pap = 0;
$pa = 0;
$psb = 0;
$oyagsob = 0;
$ncrc = 0;
$mdu = 0;
$jspp = 0;
$cas = 0;
$ua = 0;
$ps = 0;
$pppi = 0;
$pppp = 0;
$ppp = 0;
$pku = 0;
$cuic = 0;
$koko = 0;
$pi = 0;
$ipk = 0;
$ippp = 0;
$ipiz = 0;
$jpp = 0;
$jb = 0;
$jc = 0;
$jhea = 0;
$jhep = 0;
$jp = 0;
$jk = 0;
$str_pi = "Pusat Islam"; $str_koko = "Pusat Kokurikulum"; $str_cuic = "Pusat Kerjasama Universiti-Industri (CUIC)"; $str_pku = "Pusat Kesihatan Universiti"; $str_ppp = "Pusat Pengajaran Pembelajaran"; $str_pppp = "Pusat Pengujian, Pengukuran, Dan Penilaian"; $str_pppi = "Pusat Pengurusan Penyelidikan Dan Inovasi";
$str_ps = "Pusat Sukan"; $str_ua = "U-ASSIST"; $str_cas = "UUM College of Art And Sciences"; $str_jspp = "Jabatan Strategik Dan Pembangunan Perniagaan"; $str_mdu = "Medical Diagnostik UUM";
$str_ncrc = "Northern Corridor Research Centre"; $str_oyagsob = "Othman Yeop Abdullah Graduate School of Business"; $str_psb = "Perpustakaan Sultanah Bahiyah"; $str_pa = "Pusat Alumni";
$str_pap = "Pusat Asasi Pengurusan"; $str_pbs = "Pusat Budaya Dan Seni"; $str_phek = "Pusat Hal ehwal Dan Kerja"; $str_pip = "Pusat Inovasi Dan Pengkomersilan"; $str_agnu = "Akademi Golf Nasional UUM"; $str_ahsgsas = "Awang Had Salleh Graduate School of Art And Sciences";
$str_gsgsg = "Ghazali Shafie Graduate School of Government"; $str_muamalat = "INASIS Bank Muamalat"; $str_rakyat = "INASIS Bank Rakyat"; $str_bsn = "INASIS Bank BSN"; $str_grantt = "INASIS GRANTT";
$str_mas = "INASIS MAS"; $str_may = "INASIS Maybank"; $str_misc = "INASIS MISC"; $str_petro = "INASIS Petronas"; $str_proton = "INASIS Proton"; $str_sd = "INASIS Sime Darby"; $str_sme = "INASIS SME Bank";
$str_tm = "INASIS TM"; $str_trade = "INASIS Tradewinds"; $str_yab = "INASIS Yayasan Al-Bukhary"; $str_ipkk = "Institut Pembangunan Keusahawanan Dan Koperasi"; $str_iptdmm = "Institut Pemikiran Tun Dr Mahathir Mohamad";
$str_ipk = "Institut Pengurusan Kualiti"; $str_ippp = "Institut Penyelidikan Pengurusan Dan Perniagaan"; $str_ipiz = "Institut Penyelidikan dan Inovasi Zakat (IPIZ)";
$str_jpp = "Jabatan Pembangunan dan Penyenggaraan (JPP)"; $str_jb = "Jabatan bendahari"; $str_jc = "Jabatan Canselori"; $str_jhea = "Jabatan Hal Ehwal Akademik";
$str_jhep = "Jabatan Hal Ehwal Pelajar"; $str_jp = "Jabatan Pendaftar"; $str_jk = "Jabatan Keselamatan";
$php_data_array = Array(); // create PHP array
while ($row = mysqli_fetch_array($query)){
	if(strpos(json_encode($row),"Pusat Islam")){
		$pi += 1;
	} if (strpos(json_encode($row), "Pusat Kokurikulum")){
		$koko += 1;
	} if(strpos(json_encode($row),"Pusat Kerjasama Universiti-Industri (CUIC)")){
		$cuic += 1;
	} if(strpos(json_encode($row),"Pusat Kesihatan Universiti")){
		$pku += 1;
	} if(strpos(json_encode($row),"Pusat Pengajaran Pembelajaran")){
		$ppp += 1;
	} if(strpos(json_encode($row),"Pusat Pengujian, Pengukuran, Dan Penilaian")){
		$pppp += 1;
	} if(strpos(json_encode($row),"Pusat Pengurusan Penyelidikan Dan Inovasi")){
		$pppi += 1;
	} if(strpos(json_encode($row),"Pusat Sukan")){
		$ps += 1;
	} if(strpos(json_encode($row),"U-ASSIST")){
		$ua += 1;
	} if(strpos(json_encode($row),"UUM College of Art And Sciences")){
		$cas += 1;
	} if(strpos(json_encode($row),"UUM College of Business")){
		$cas += 1;
	} if(strpos(json_encode($row),"UUM College of Law,Government And International Studies")){
		$cas += 1;
	} if(strpos(json_encode($row),"UUM Information technology")){
		$cas += 1;
	} if(strpos(json_encode($row),"UUM Kampus Kuala Lumpur")){
		$cas += 1;
	} if(strpos(json_encode($row),"UUM Press")){
		$cas += 1;
	} if(strpos(json_encode($row),"Unifilm Studio UUM")){
		$cas += 1;
	} if(strpos(json_encode($row),"Jabatan Strategik Dan Pembangunan Perniagaan")){
		$jspp += 1;
	} if(strpos(json_encode($row),"Medical Diagnostik UUM")){
		$mdu += 1;
	} if(strpos(json_encode($row),"Northern Corridor Research Centre")){
		$ncrc += 1;
	} if(strpos(json_encode($row),"Othman Yeop Abdullah Graduate School of Business")){
		$oyagsob += 1;
	} if(strpos(json_encode($row),"Perpustakaan Sultanah Bahiyah")){
		$psb += 1;
	} if(strpos(json_encode($row),"Pusat Alumni")){
		$pa += 1;
	} if(strpos(json_encode($row),"Pusat Asasi Pengurusan")){
		$pap += 1;
	} if(strpos(json_encode($row),"Pusat Budaya Dan Seni")){
		$pbs += 1;
	} if(strpos(json_encode($row),"Pusat Hal ehwal Dan Kerja")){
		$phek += 1;
	} if(strpos(json_encode($row),"Pusat Inovasi Dan Pengkomersilan")){
		$pip += 1;
	} if(strpos(json_encode($row),"Akademi Golf Nasional UUM")){
		$agnu += 1;
	} if(strpos(json_encode($row),"Awang Had Salleh Graduate School of Art And Sciences")){
		$ahsgsas += 1;
	} if(strpos(json_encode($row),"Ghazali Shafie Graduate School of Government")){
		$gsgsg += 1;
	} if(strpos(json_encode($row),"INASIS Bank Muamalat")){
		$muamalat += 1;
	} if(strpos(json_encode($row),"INASIS Bank Rakyat")){
		$rakyat += 1;
	} if(strpos(json_encode($row),"INASIS Bank BSN")){
		$bsn += 1;
	} if(strpos(json_encode($row),"INASIS GRANTT")){
		$grantt += 1;
	} if(strpos(json_encode($row),"INASIS MAS")){
		$mas += 1;
	} if(strpos(json_encode($row),"INASIS Maybank")){
		$may += 1;
	} if(strpos(json_encode($row),"INASIS MISC")){
		$misc += 1;
	} if(strpos(json_encode($row),"INASIS Petronas")){
		$petro += 1;
	} if(strpos(json_encode($row),"INASIS Proton")){
		$proton += 1;
	} if(strpos(json_encode($row),"INASIS Sime Darby")){
		$sd += 1;
	} if(strpos(json_encode($row),"INASIS SME Bank")){
		$sme += 1;
	} if(strpos(json_encode($row),"INASIS TNB")){
		$tnb += 1;
	} if(strpos(json_encode($row),"INASIS TM")){
		$tm += 1;
	} if(strpos(json_encode($row),"INASIS Tradewinds")){
		$trade += 1;
	} if(strpos(json_encode($row),"INASIS Yayasan Al-Bukhary")){
		$yab += 1;
	} if(strpos(json_encode($row),"Institut Pembangunan Keusahawanan Dan Koperasi")){
		$ipkk += 1;
	} if(strpos(json_encode($row),"Institut Pemikiran Tun Dr Mahathir Mohamad")){
		$iptdmm += 1;
	} 
	if(strpos(json_encode($row),"Institut Pengurusan Kualiti")){
		$ipk += 1;
	} 
	if(strpos(json_encode($row),"Institut Penyelidikan Pengurusan Dan Perniagaan")){
		$ippp += 1;
	} 
	if(strpos(json_encode($row),"Institut Penyelidikan dan Inovasi Zakat (IPIZ)")){
		$ipiz += 1;
	} 
	if(strpos(json_encode($row),"Jabatan Pembangunan dan Penyenggaraan (JPP)")){
		$jpp += 1;
	} 
	if(strpos(json_encode($row),"Jabatan bendahari")){
		$jb += 1;
	} 
	if(strpos(json_encode($row),"Jabatan Canselori")){
		$jc += 1;
	} 
	if(strpos(json_encode($row),"Jabatan Hal Ehwal Akademik")){
		$jhea += 1;
	} 
	if(strpos(json_encode($row),"Jabatan Hal Ehwal Pelajar")){
		$jhep += 1;
	} 
	 if(strpos(json_encode($row),"Jabatan Pendaftar")){
		$jp += 1;
	} if(strpos(json_encode($row),"Jabatan Keselamatan")){
		$jk += 1;
	} 
$php_data_array = array(array($str_iptdmm,$iptdmm),array($str_ipkk,$ipkk),array($str_yab,$yab),array($str_trade,$trade),array($str_tm,$tm),array($str_sme,$sme),array($str_sd,$sd),
array($str_proton,$proton),array($str_proton,$proton),array($str_petro,$petro),array($str_misc,$misc),array($str_may,$may),array($str_mas,$mas),array($str_grantt,$grantt),array($str_bsn,$bsn),
array($str_rakyat,$rakyat),array($str_muamalat,$muamalat),array($str_gsgsg,$gsgsg),array($str_ahsgsas,$ahsgsas),array($str_agnu,$agnu),array($str_pip,$pip)
,array($str_phek,$phek),array($str_pbs,$pbs),array($str_pap,$pap),array($str_pa,$pa),array($str_psb,$psb),array($str_oyagsob,$oyagsob),array($str_ncrc,$ncrc)
,array($str_mdu,$mdu),array($str_jspp,$jspp),array($str_cas,$cas),array($str_ua,$ua),array($str_ps,$ps),array($str_pppi,$pppi),array($str_ppp,$ppp),array($str_pppp,$pppp)
,array($str_pku,$pku),array($str_cuic,$cuic),array($str_koko,$koko),array($str_pi,$pi),array($str_jk,$jk),array($str_jp,$jp),array($str_jhep,$jhep),array($str_jhea,$jhea),array($str_jc,$jc)
,array($str_jb,$jb),array($str_jpp,$jpp),array($str_ipiz,$ipiz),array($str_ippp,$ippp),array($str_ipk,$ipk)); // Adding to array
}


	$query = "SELECT SUM(bil_agensi) FROM projects";
	$result = mysqli_query($db, $query);
	foreach($result as $row){
		$num_agensi = $row['SUM(bil_agensi)'];
	}

echo "<table class='table table-bordered' style='margin-top:90px;margin-left:30px; width:18%'>
<tr> <th>Bilangan Program</th><td>".$num_program."</td></tr>
<tr><th>Bilangan Agensi</th><td>".$num_agensi."</td></tr>
<tr><th>Jumlah Dana</th><td>".$dana."</td></tr>";

echo "</table>";
}else{
echo $db->error;
}

// Transfer PHP array to JavaScript two dimensional array 
echo "<script>
		var program =".json_encode($php_data_array_program)."
        var ptj = ".json_encode($php_data_array)."
		var skop = ".json_encode($php_data_array_skop)."
		var sdg = ".json_encode($php_data_array_sdg)."
</script>";
?>

<div style="display:inline-block;align:right;position:absolute; right:-120px; top:180px;z-index: 1" id="chart_divptj"></div>
<div style="display:inline-block;align:right;position:absolute; right:400px; top:180px;" id="chart_divskop"></div><br>
<div style="display:inline-block;align:right;position:absolute; right:-120px; top:680px;z-index: 1" id="chart_divsdg"></div>
<div style="display:inline-block;align:right;position:absolute; right:400px; top:680px;" id="chart_divprogram"></div>
<div style="text-align: left;">

<a style=" position: absolute;bottom: 10px;cursor: pointer;display:inline-block" onClick="javascript:history.go(-1)" ><img style="margin:10px; width:65px; height:65px; cursor: pointer;" src="back.png" 
            class="bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full image" ></img></a>
</div>
</div>
</div>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart_ptj);
	  google.charts.setOnLoadCallback(draw_my_chart_skop);
	   google.charts.setOnLoadCallback(draw_my_chart_sdg);
	   google.charts.setOnLoadCallback(draw_my_chart_program);
      // Callback that draws the pie chart
      function draw_my_chart_ptj() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Bilangan Program');
        data.addColumn('number', '');
		for(i = 0; i < ptj.length; i++)
    data.addRow([ptj[i][0], parseInt(ptj[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'PTJ', width:900, height:900,  backgroundColor: 'transparent', responsive: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_divptj'));
        chart.draw(data, options);
      }
	  function draw_my_chart_skop() {
		  // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Bilangan Program');
        data.addColumn('number', '');
		for(i = 0; i < skop.length; i++)
    data.addRow([skop[i][0], parseInt(skop[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'SKOP',
                       width:900,
                       height:900, backgroundColor: 'transparent', responsive: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_divskop'));
        chart.draw(data, options);
      }
	  function draw_my_chart_sdg() {
        // Create the data table .
		// Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Bilangan Program');
        data.addColumn('number', '');
		for(i = 0; i < sdg.length; i++)
    data.addRow([sdg[i][0], parseInt(sdg[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'SDG',
                       width:900,
                       height:900, backgroundColor: 'transparent', responsive: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_divsdg'));
        chart.draw(data, options);
      }
	  function draw_my_chart_program() {
        // Create the data table .
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Bilangan Program');
        data.addColumn('number', '');		
		for(i = 0; i < program.length; i++)
    data.addRow([program[i][0], parseInt(program[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'PROGRAM',
                       width:900,
                       height:900, backgroundColor: 'transparent', responsive: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_divprogram'));
        chart.draw(data, options);
      }
</script>
</html>







