<?php
include '../koneksi.php';

$kode = mysqli_real_escape_string($koneksi,$_GET['kode']);
$sql=mysqli_query($koneksi,"select * from tb_formulir where kode_daftar ='$kode' ");
$data=mysqli_fetch_array($sql);

require_once("phpqrcode/qrlib.php");

//create a QR Code and save it as a png image file named test.png
QRcode::png("coded number here","test.png");
$nama=$data['nama'];
$jenis_kelamin=$data['jenis_kelamin'];
if($jenis_kelamin == '1')
{
    $jenis_kelamin="Laki-laki";
}else{
    $jenis_kelamin="Perempuan";
}
$alamat= $data['alamat'];
$asal_sekolah=$data['asal_sekolah'];
$tujuan_sekolah = $data['tujuan_sekolah'];
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
$pdf->Cell(0,10,'Formulir Online',0,1,'C');
$pdf->SetFont('Times','',14);
$pdf->Image("test.png",150,50,30,30,'png');
$pdf->Cell(12,10,'Kode Registrasi',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$kode,0,1);
$pdf->Cell(12,10,'Nama Lengkap',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$nama,0,1);
$pdf->Cell(12,10,'Jenis Kelamin',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$jenis_kelamin,0,1);
$pdf->Cell(12,10,'Alamat',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$alamat,0,1);
$pdf->Cell(12,10,'Asal Sekolah',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$asal_sekolah,0,1);
$pdf->Cell(12,10,'Unit Pilihan',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$tujuan_sekolah,0,1);
$pdf->Cell(12,10,'Nomor Telepon',0,0);
$pdf->Cell(30);
$pdf->Cell(0,10,': '.$no_telp,0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Times','',14);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);

$pdf->Output('D','formulir_online.pdf');
?>