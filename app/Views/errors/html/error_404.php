<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Not Found 404 - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

   <!-- Favicons -->
   <link href="<?= base_url();?>/img/favicon.png" rel="icon">
  <link href="<?= base_url();?>/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- jquery ui -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <!-- Vendor CSS Files -->
  <link href="<?= base_url();?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url();?>/vendor/simple-calendar/css/dncalendar-skin.css">

  <!-- Template Main CSS File -->
  <link href="<?= base_url();?>/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <!-- Default theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

  <!-- CKEditor -->
  <script src="<?= base_url();?>/vendor/ckeditor/ckeditor.js"></script>

  <!-- select2 -->
  <link rel="stylesheet" href="<?= base_url();?>/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url();?>/vendor/select2/bootstrap-5/select2-bootstrap-5-theme.min.css" />
  <script src="<?= base_url();?>/vendor/select2/js/select2.min.js"></script>
</head>

<body>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>The page you are looking for doesn't exist.</h2>
        <a class="btn" href="<?= $_SERVER['HTTP_REFERER'];?>">Back to home</a>
        <img src="<?= base_url()?>/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
        <!-- <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div> -->
      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url();?>/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url();?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url();?>/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url();?>/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url();?>/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url();?>/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url();?>/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url();?>/vendor/simple-calendar/js/dncalendar.js"></script>

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url();?>/js/main.js"></script>

</body>

</html>