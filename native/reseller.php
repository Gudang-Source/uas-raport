<!doctype html>
<html lang="en">





<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
    <title> Form Pendaftaran - Yasui Store </title>    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"    />

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link href="main.cba69814a806ecc7945a.css" rel="stylesheet">
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-plum-plate" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('assets/images/originals/city.jpg');"></div>
                                        <div class="slider-content">
                                            <img src="assets/images/yasui.jpg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="text-center"><img src="assets/images/logo-inverse.png" style="max-height: 80px;"></div>
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label> Nama </label>
                                            <input type="text" name="biodata[nama]" class="form-control" placeholder="Nama Kamu">
                                        </div>
                                        <div class="form-group">
                                            <label> No WA </label>
                                            <input type="text" name="biodata[wa]" class="form-control" placeholder="08123456789">
                                        </div>
                                        <div class="form-group">
                                            <label> Sistem Resell </label>
                                            <br>
                                            <input type="checkbox" name="sistem" value="akun"> Akun &nbsp; &nbsp;
                                            <input type="checkbox" name="sistem" value="join"> Join
                                        </div>  
                                        <div class="form-group">
                                            <input type="submit" name="submit" value="Submit" class="btn btn-primary pull-right">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="assets/scripts/main.cba69814a806ecc7945a.js"></script>
</html>

<?php
if (isset($_POST["submit"])){
    $f = fopen(".htreseller", "a+");
    fwrite($f, json_encode($_POST)."\n");
    echo "<script>
    Swal.fire({
      title: 'Berhasil !',
      text: 'Berhasil Mendaftarkan Akun !!',
      icon: 'success',
      confirmButtonText: 'Okey'
    }).then((result) => {
        window.location.href='/';
    });
</script>";
}
?>