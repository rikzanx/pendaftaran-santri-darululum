<?php
include '../koneksi.php';

$kode = $_REQUEST['kode'];
$sql=mysqli_query($koneksi,"select * from tb_pendaftar where kode_daftar ='$kode' ");
$data=mysqli_fetch_array($sql);

require_once("phpqrcode/qrlib.php");

//create a QR Code and save it as a png image file named test.png
QRcode::png("coded number here","test.png");
$nama=$data['nama'];
$email=$data['email'];
$no_telp=$data['no_telp'];
$tanggal = $data['tanggal_daftar'];
$dateTime = new DateTime($tanggal);
$tanggal = $dateTime->format('d M Y H:m');

require('fpdf.php');


class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('du.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',30);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(35,10,"Asrama Ar-Risalah PPDU",2,0,'C');
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
    $this->Cell(0,10,'Pendafataran Online Asrama Ar-Risalah- Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','BU',24);
$pdf->Cell(0,10,'Bukti Pendaftaran Online',0,1,'C');
$pdf->SetFont('Times','',14);
$pdf->Image("test.png",150,50,30,30,'png');
$pdf->Cell(12,10,'Kode Registrasi',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$kode,0,1);
$pdf->Cell(12,10,'Nama Lengkap',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$nama,0,1);
$pdf->Cell(12,10,'Email',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$email,0,1);
$pdf->Cell(12,10,'No HP',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$no_telp,0,1);
$pdf->Cell(12,10,'Tanggal Pendaftaran',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$tanggal.' WIB',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->SetFont('Times','BU',16);
$pdf->Cell(0,10,'Syarat dan Tata Cara Pendafataran selanjutnya :',0,1,'C');
$pdf->SetFont('Times','',14);
$pdf->Cell(0,10,'1. Mengisi data email dan nomor telepon yang benar.',0,1);
$pdf->Cell(0,10,'2. Sudah mendaftar dan mendapatkan kode registrasi.',0,1);
$pdf->Cell(0,10,'3. Melunasi biaya pendafataran sebesar Rp 200.000,00.-',0,1);
$pdf->Cell(0,10,'   dengan tranfer ke rekening BCA 38-218291-212 a/n Muhammad Rikzan.',0,1);
$pdf->Cell(0,10,'4. Mengirim bukti pendaftaran di website.',0,1);
$pdf->Cell(0,10,'5. Melengkapi pengisian formulir.',0,1);

$pdf->Output('I','buktipendafataran.pdf');
?>