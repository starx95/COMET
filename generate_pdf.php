<?php //include connection file 
include_once("server.php");

require('wordwrap.php');

$connect = new PDO("mysql:host=localhost;dbname=starxdev_comet", "starxdev", "01Gaidl!9[EM0Y");
$id = $_GET['id'];
$sql = "SELECT * FROM projects WHERE id='".$id."'";
$result = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($result)){
	$namaprojek = $row['nama_projek'];
}
if(isset($namaprojek)){
	class PDF extends FPDF
{

function WordWrap(&$text, $maxwidth)
{
    $text = trim($text);
    if ($text==='')
        return 0;
    $space = $this->GetStringWidth(' ');
    $lines = explode("\n", $text);
    $text = '';
    $count = 0;

    foreach ($lines as $line)
    {
        $words = preg_split('/ +/', $line);
        $width = 0;

        foreach ($words as $word)
        {
            $wordwidth = $this->GetStringWidth($word);
            if ($wordwidth > $maxwidth)
            {
                // Word is too long, we cut it
                for($i=0; $i<strlen($word); $i++)
                {
                    $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                    if($width + $wordwidth <= $maxwidth)
                    {
                        $width += $wordwidth;
                        $text .= substr($word, $i, 1);
                    }
                    else
                    {
                        $width = $wordwidth;
                        $text = rtrim($text)."\n".substr($word, $i, 1);
                        $count++;
                    }
                }
            }
            elseif($width + $wordwidth <= $maxwidth)
            {
                $width += $wordwidth + $space;
                $text .= $word.' ';
            }
            else
            {
                $width = $wordwidth + $space;
                $text = rtrim($text)."\n".$word.' ';
                $count++;
            }
        }
        $text = rtrim($text)."\n";
        $count++;
    }
    $text = rtrim($text);
    return $count;
}

// Page header
function header(){ 
	global $namaprojek;
	
    // Logo
    $this->Image('cuic.png',10,6,70,25);
    $this->SetFont('Arial','B',14);
	$this->Cell(276,5,'PROJECT REPORT',0,0,'C');
	$this->Ln();
	$this->SetFont('Times','',12);
    $this->Cell(276,10, $namaprojek ,0,0,'C');
    $this->Ln(20);
}

// Page footer
function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',8);
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
   }
   
   function headerTable($connect,$sql){
	   $stmt = $connect->query($sql);
		while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$pendahuluan = $data->pendahuluan;
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
			$this->Cell(42,10,'Pusat Tanggungjawab',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->ptj,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(42,10,'Ketua',1,0,'C');
			$this->SetFont('Times', '',12);
			$this->Cell(145,10,$data->ketua,1,0,'L');
			$this->Ln();
			$this->SetFont('Times','B',12);
			$this->Cell(187, 10, 'Pendahuluan', 1, 0, 'C', FALSE);
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($pendahuluan,145,"\n"),1,'C',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Latarbelakang',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->latarbelakang,145,"\n"),1,'L',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Objektif',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->objektif,145,"\n"),1,'C',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Pelaksanaan',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->pelaksanaan,145,"\n"),1,'C',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Pra-Penilaian',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->pra_penilaian,145,"\n"),1,'C',FALSE);
		
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Penilaian',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->penilaian,145,"\n"),1,'C',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Cabaran',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->cabaran,145,"\n"),1,'C',FALSE);
			
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Output',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->output,145,"\n"),1,'C',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Impak',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->impak,145,"\n"),1,'C',FALSE);
			
			$this->SetFont('Times','B',12);
			$this->Cell(187,10,'Kesimpulan',1,0,'C');
			$this->Ln();
			$this->SetFont('Times', '',12);
			$this->MultiCell(187,6,wordwrap($data->kesimpulan,145,"\n"),1,'C',FALSE);
			
			
   }
   
  
}
}
$db = new DBObj();
$connString =  $db->getConnstring();
$display_heading = array('id'=>'ID', 'nama_projek'=> 'Nama Projek', 'lokasi'=> 'Lokasi','objektif'=> 'Objektif',);
 
$result = mysqli_query($connString, "SELECT id, nama_projek, lokasi, objektif FROM projects") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM projects");
 
$pdf = new PDF();
$pdf->AddPage('P','A4',0);
$pdf->SetFont('Arial','',14);
$nb=$pdf->WordWrap($pendahuluan,140);
$pdf->headerTable($connect,$sql);
$pdf->Output();
}

?>