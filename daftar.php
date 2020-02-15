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
         </p>        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daftar.php">Pendaftaran</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center tulisan-header">
                <h1>Pendaftaran Santri Baru Asrama Ar-Risalah</h1>
                <h1>Pondok Pesantren Darul 'Ulum Jombang</h1>
                <p>Prosedur Pendaftaran Online</p>
                <p>
                    1. Transfer biaya pendaftaran sebesar 500.000 ke Rek . BCA<br>
                    2. Pilih menu Pendafataran isi : Nama Lengkap, Email, dan Bukti Pembayaran. <br>
                    3. Tunggu untuk mendapatkan kode. <br>
                    4. Apabila sudah memiliki kode silahkan pilih menu login, kemudian mengisi formulir.
                </p>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pendaftaran</div>
                    <div class="card-body">
                        <form id="formdaftar">
                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">Nama Santri</label>
                                <div class="col-md-6">
                                    <input type="text" id="nama" class="form-control" name="nama" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email/No Hp</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-6">
                                    <img id="img" height="150" src="images/gambar.png">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="buktipendaftaran" class="col-md-4 col-form-label text-md-right">Bukti Pembayaran</label>
                                <div class="col-md-6">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="buktipendaftaran">
                                    <label class="custom-file-label" for="buktipendaftaran">Choose <fieldset></fieldset></label>
                                  </div>
                                </div>
                            </div>
                         </form>
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" id="daftar">
                                    Daftar
                                </button>
                                <a href="index.php" class="btn btn-default">Login</a>
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
    var gambar="0";
    function readFile() {
  
          if (this.files && this.files[0]) {
            
            var FR= new FileReader();
            
            FR.addEventListener("load", function(e) {
              document.getElementById("img").src       = e.target.result;
              
              gambar= e.target.result;

            }); 
            
            FR.readAsDataURL( this.files[0] );
          }
          
        }

        document.getElementById("buktipendaftaran").addEventListener("change", readFile);
    $(document).ready(function(){
        
        $("#daftar").click(function(){
            var data= $('#formdaftar').serialize();

            if(gambar=="0")
            {
                alert('gambar kosong');
            }else{
                data=data+"&image="+encodeURIComponent(gambar);
                console.log(data);
                $.ajax({
                url:'aksi-daftar.php',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success:function(responses){
                    if(responses.status == "ok")
                    {
                        swal({
                            title: "Sukses!",
                            text: "Pendaftaran tunggu untuk mendapatkan kode yang dikirim melali email/nomor telepon!",
                            type: "success"
                        }).then(function() {
                            window.location="index.php";
                        });
                        
                    }else{
                        alert('Gagal Daftar hub admin');
                    }
                    
                },
            });
            }
        });
    });
</script>
</html>