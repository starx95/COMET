<?php
include_once("server.php");
require('wordwrap.php');
$connect = new PDO("mysql:host=localhost;dbname=starxdev_comet", "starxdev", "01Gaidl!9[EM0Y");
$id = $_GET['id'];
$sql = "SELECT * FROM projects WHERE id='".$id."'";
$result = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($result)){
	$pendahuluan = $row['pendahuluan'];
}
class PDFS extends PDF{
function headerTables($connect,$sql){
	   $stmt = $connect->query($sql);
		while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$pendahuluan = $data->pendahuluan;
			WordWrap($pendahuluan);
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'ID',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->id,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Nama Projek',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->nama_projek,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Tarikh Mula',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->tarikh_mula,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Tarikh Tamat',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->tarikh_tamat,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'negeri',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->negeri,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'lokasi',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->lokasi,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'penglibatan',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->penglibatan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Bilangan Agensi',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->bil_agensi,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Sumbangan',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->sumbangan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'S/O kod',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->so,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Pemindahan Ilmu',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->pemindahan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Pendahuluan',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$pendahuluan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Latarbelakang',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->latarbelakang,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Objektif',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->objektif,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Pelaksanaan',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->pelaksanaan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Pra-Penilaian',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->pra_penilaian,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Skop',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->skop,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'skopt',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->skopt,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'SDG',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->sdg,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'status',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->status,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Penarafan',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->penarafan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Penilaian',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->penilaian,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Cabaran',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->cabaran,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Pusat Tanggungjawab',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->ptj,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Output',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->output,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Impak',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->impak,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Kesimpulan',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->kesimpulan,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Ketua',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->ketua,1,0,'L');
			$this->Ln();
   }
   }
}

$pdf=new PDFS();
$pdf->AddPage();
$pdf->headerTables($connect, $sql);
$pdf->SetFont('Arial','',12);
$nb=$pdf->WordWrap($pendahuluan,140);
$pdf->Write(5,"This paragraph has $nb lines:\n\n");
$pdf->Write(5,$pendahuluan);
$pdf->Output();
?>