<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
 <meta content="width=device-width, initial-scale=1.0" name="viewport">
 <title>SI PEMAS</title>
 <meta name="robots" content="noindex, nofollow">
 <meta content="" name="description">
 <meta content="" name="keywords">
 <link href="assets/img/favicon.png" rel="icon">
 <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
 <link href="https://fonts.gstatic.com" rel="preconnect">
 <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/bootstrap-icons.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/boxicons.min.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/quill.snow.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/quill.bubble.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/remixicon.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/simple-datatables.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/style.css" rel="stylesheet">
 <link href="<?= base_url('vendor/template/') ?>assets/css/me.css" rel="stylesheet">
</head>

<body>
 <main>
  <div class="container">
   <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
     <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
       <div class="d-flex justify-content-center py-4"> <a href="<?= base_url('auth/regestrasi') ?>" class="logo d-flex align-items-center w-auto"><span class="d-none d-lg-block">SI PEMAS</span> </a></div>
       <div class="card mb-3">
        <div class="card-body">
         <div class="pt-4 pb-2">
          <h5 class="card-title text-center pb-0 fs-4">Registrasi</h5>
          <p class="text-center small">Masukan data akun dibawah ini</p>
         </div>
         <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash') ?>"></div>
         <form class="row g-3" method="POST">

          <div class="col-12">
           <label for="yourEmail" class="formlabel">Email</label> <input type="email" name="email" class="form-control" id="yourEmail">
           <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-12">
           <label for="yourPassword1" class="form-label">Password</label> <input type="password" name="password" class="form-control" id="yourPassword1">
           <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-12">
           <label for="yourPassword" class="form-label">Konfirmasi Password</label> <input type="password" name="password2" class="form-control" id="yourPassword">
           <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="col-12"> <button class="btn btn-primary w-100" type="submit">Registrasi</button></div>
          <div class="col-12">
           <p class="small mb-0">Sudah punya akun? <a href="<?= base_url('auth') ?>">silahkan login</a></p>
          </div>
         </form>
        </div>
       </div>
      </div>
      <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">
       <img src="<?= base_url('vendor/template/') ?>assets/img/login.svg" width="400" class="logo-login">
      </div>
     </div>
    </div>
   </section>
  </div>
 </main>
 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 <script src="<?= base_url('vendor/template/') ?>assets/js/apexcharts.min.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/bootstrap.bundle.min.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/chart.min.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/echarts.min.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/quill.min.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/simple-datatables.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/tinymce.min.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/validate.js"></script>
 <script src="<?= base_url('vendor/template/') ?>assets/js/main.js"></script>
 <script src="<?= base_url('vendor/package/') ?>sweetalert2/sweetalert2.all.min.js"></script>
 <script src="<?= base_url('vendor/package/') ?>js/jquery.js"></script>
 <script src="<?= base_url('vendor/package/') ?>js/me.js"></script>
</body>

</html>