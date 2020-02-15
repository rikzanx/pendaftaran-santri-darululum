<?php 
session_start();
if( !isset($_SESSION["kode"]) ){
    header("location:index.php");
}
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
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <p>Prosedur Pendaftaran Online</p>
                <p>
                    1. Transfer biaya pendaftaran sebesar 200.000 ke Rek . BCA 92891891<br>
                    2. Pilih menu Pendafataran isi : Nama Lengkap, Email, dan Bukti Pembayaran. <br>
                    3. Tunggu untuk mendapatkan kode. <br>
                    4. Apabila sudah memiliki kode silahkan pilih menu login, kemudian mengisi formulir.
                </p>

            </div>
        </div>
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
                                    <input type="text" id="nama" class="form-control" name="nama" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="1">Laki-laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="asal_sekolah" class="col-md-4 col-form-label text-md-right">Asal Sekolah</label>
                                <div class="col-md-6">
                                    <input type="text" id="asal_sekolah" class="form-control" name="asal_sekolah" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <input type="text" id="alamat" class="form-control" name="alamat" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit_dituju" class="col-md-4 col-form-label text-md-right">Unit Yang Dituju</label>
                                <div class="col-md-6">
                                    <input type="text" id="unit_dituju" class="form-control" name="unit_dituju" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_telp" class="col-md-4 col-form-label text-md-right">No Hp</label>
                                <div class="col-md-6">
                                    <input type="text" id="no_telp" class="form-control" name="no_telp" required autofocus>
                                </div>
                            </div>
                    </form>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit-formulir">
                                    Submit Formulir
                                </button>
                                <a href="#" class="btn btn-link">
                                    Kembali
                                </a>
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
                data: $('#formulir').serialize(),
                success:function(responses){
                    window.location='view-formulir.php';
                },
            });

        }
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
                      text: 'Formulir sudah diisi!',
                      icon: 'success'
                    }).then(function() {
                      upload(); // <--- submit form programmatically
                    });
                  } else {
                    swal("Cancel", "Silahkan diperiksa kembali", "warning");
                  }
                })
            
        });
    });
</script>
</html>