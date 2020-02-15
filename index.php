
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="sweetalert/sweetalert.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">

    <title>Pendaftaran Santri Baru</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel bg-primary">
    <div class="container">
         <p>
             <img src="images/du.png" width="50" height="50">
         <img src="images/logo-arrisalah.png" width="50" height="50">
         </p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daftar.php" >Pendaftaran</a>
                </li>
                
            </ul>

        </div>
    </div>
</nav>

<div class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center tulisan-header">
                <h1>Pendaftaran Santri Baru Asrama Ar-Risalah</h1>
                <h1>Pondok Pesantren Darul 'Ulum Jombang</h1>
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
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form id="formkode">
                            <div class="form-group row">
                                <label for="kode-pendaftaran" class="col-md-4 col-form-label text-md-right">Kode Pendaftaran</label>
                                <div class="col-md-6">
                                    <input type="text" id="kode-pendaftaran" class="form-control" name="kode-pendaftaran" required autofocus>
                                </div>
                            </div>
                    </form>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="cekkode">
                                    Cek
                                </button>
                                <a href="#" id="lupa" class="btn btn-link">
                                    Lupa kode pendaftaran?
                                </a>
                                    
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                
            </div>
        </div>
    </div>
</div>

</div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#lupa").click(function(){
            swal("Lupa Kode", "Silahkan menghubungi admin!", "warning")
        });
        $("#cekkode").click(function(){
            var data = $("#formkode").serialize();
            $.ajax({
                url:'cek-kode.php',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success:function(responses){
                    if(responses.status == 'ok')
                    {
                        swal("Sukses!", "Kode Pendaftaran Lunas!", "success")
                        window.location.href = 'formulir.php';
                    }else if(responses.status == 'belum')
                    {
                        swal("Gagal!", "Kode Pendaftaran Belum Lunas!", "warning")
                        
                    }else if(responses.status == 'sudah')
                    {
                        swal("Sukses!", "Anda sudah mengisi formulir!", "success")
                        window.location.href = 'view-formulir.php';
                        
                    }else{
                        swal("Gagal!", "Kode Pendaftaran Tidak Ada!", "warning")
                    }
                }
            });
        });
    });
</script>
</html>