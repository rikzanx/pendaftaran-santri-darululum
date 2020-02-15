<?php
include '../koneksi.php';

$kode = $_REQUEST['kode'];
$sql=mysqli_query($koneksi,"select * from tb_pendaftar where kode_daftar ='$kode' ");
$data=mysqli_fetch_array($sql);

$nama=$data['nama'];
$email=$data['email'];
$no_telp=$data['no_telp'];

require('fpdf.php');


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('du.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(35,10,"Pondok Pesantren Darul 'Ulum Peterongan Jombang",2,0,'C');
    // Line break
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','BU',24);
$pdf->Cell(0,10,'Bukti Pendaftaran',0,1,'C');
$pdf->SetFont('Times','',14);
$pdf->Image('du.png',150,50,30);
$pdf->Cell(12,10,'Kode Pendafataran	: '.$kode.'11',0,1);
$pdf->Cell(0,10, 'Nama Lengkap		: '.$nama,0,1);
$pdf->Cell(12,10,'Email				: '.$email,0,1);
$pdf->Cell(12,10,'No HP				: '.$no_telp,0,1);

$pdf->Output('I','buktipendafataran.pdf');
?>