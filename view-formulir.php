<?php 
session_start();
if( !isset($_SESSION["kode"]) ){
    header("location:index.php");
}
include 'koneksi.php';
$kode = $_SESSION['kode'];
$sql=mysqli_query($koneksi,"select * from tb_formulir where kode_daftar ='$kode' ");
$data=mysqli_fetch_array($sql);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="sweetalert/sweetalert.css" type="text/css" rel="stylesheet">

    <title>Pendaftaran Santri Baru</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <img src="images/du.png" width="100" height="100">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulir Pendaftaran</div>
                    <div class="card-body">
                        <form id="formulir">
                            <div class="form-group row">
                                <label for="kode-pendaftaran" class="col-md-4 col-form-label text-md-right">Kode Pendaftaran</label>
                                <div class="col-md-6">
                                    <input type="text" id="kode" class="form-control" name="kode-pendaftaran" value="<?php echo $_SESSION["kode"]; ?>" autofocus disabled>
                                    <input type="hidden" id="kode-pendaftaran" class="form-control" name="kode-pendaftaran" value="<?php echo $_SESSION["kode"]; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Santri</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" required autofocus disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" disabled>
                                        <option value="1"
                                        <?php 
                                            if($data['jenis_kelamin']=='1')
                                            {
                                                ?>
                                                selected="selected";
                                                <?php
                                            }else{

                                            }
                                         ?>
                                    >Laki-laki</option>
                                    <option value="2" 
                                        <?php 
                                            if($data['jenis_kelamin']=='2')
                                            {
                                                ?>
                                                selected="selected";
                                                <?php
                                            }else{

                                            }
                                         ?>
                                    >Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="asal-sekolah" class="col-md-4 col-form-label text-md-right">Asal Sekolah</label>
                                <div class="col-md-6">
                                    <input type="text" id="asal-sekolah" class="form-control" name="asal-sekolah" value="<?php echo $data['asal_sekolah']; ?>" required autofocus disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <input type="text" id="alamat" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>"required autofocus disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit_dituju" class="col-md-4 col-form-label text-md-right">Unit Yang Dituju</label>
                                <div class="col-md-6">
                                    <input type="text" id="unit_dituju" class="form-control" name="unit_dituju" value="<?php echo $data['tujuan_sekolah']; ?>" required autofocus disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_telp" class="col-md-4 col-form-label text-md-right">No Hp</label>
                                <div class="col-md-6">
                                    <input type="text" id="no_telp" class="form-control" name="no_telp" value="<?php echo $data['no_telp']; ?>" required autofocus disabled>
                                </div>
                            </div>
                    </form>
                            <div class="col-md-6 offset-md-4">
                                <h5>Anda Sudah mengisi formulir</h5>
                                <p>
                                    <button type="submit" class="btn btn-success" id="download-formulir">
                                        Cetak Bukti Pendaftaran
                                    </button>
                                </p>
                                <button type="submit" class="btn btn-primary" id="edit-formulir">
                                    Edit Formulir
                                </button>
                                
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        function goBack() {
             window.history.back();
        }
        function upload(){
            var a= $('#formulir').serialize();
            $.ajax({
                url:'submit-formulir.php',
                type: 'POST',
                dataType: 'JSON',
                data: $('#userform').serialize(),
                success:function(responses){
                    window.location='view-formulir.php';
                },
            });

        }
        $('#download-formulir').click(function(){
            var kode=$('#kode-pendaftaran').val();
            
            var url="pdf/formulir.php?kode=";
            var urldownload=url+kode;
            window.open(urldownload,"_blank");
        });
        $("#submit-formulir").click(function(){
            swal({
                  title: "Apakah kamu yakin?",
                  text: "Pastikan data anda benar!",
                  icon: "warning",
                  buttons: [
                    'Tidak',
                    'Ya, Saya Yakin!'
                  ],
                  dangerMode: true,
                }).then(function(isConfirm) {
                  if (isConfirm) {
                    swal({
                      title: 'Sukses!',
                      text: 'Formulir Berhasil Di Edit!',
                      icon: 'success'
                    }).then(function() {
                      upload(); // <--- submit form programmatically
                    });
                  } else {
                    swal("Cancel", "Silahkan diperiksa kembali", "warning");
                  }
                })
            
        });
        $('#edit-formulir').click(function(){
            window.location='edit-formulir.php';
        });
    });
</script>
</html>