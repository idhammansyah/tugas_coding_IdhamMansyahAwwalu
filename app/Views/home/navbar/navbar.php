<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url();?>/img/favicon.png" rel="icon">
  <link href="<?= base_url();?>/img/apple-touch-icon.png" rel="apple-touch-icon">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url();?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url();?>/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url();?>/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <!-- Default theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body>
<main>
  <div class="container">
    <?= $this->renderSection('content'); ?>
  </div>
</main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <?= $this->renderSection('scripts')?>
  <!-- Vendor JS Files -->
  <script src="<?= base_url();?>/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url();?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url();?>/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url();?>/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url();?>/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url();?>/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url();?>/vendor/php-email-form/validate.js"></script>

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url();?>/js/main.js"></script>

</body>

</html>