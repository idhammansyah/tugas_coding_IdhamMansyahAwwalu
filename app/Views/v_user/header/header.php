<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
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

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <!-- <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>-->

        <?php
          $db = \Config\Database::connect();
          $sessions = session()->get('user_data');
          if (empty($sessions)) {
              session()->setFlashdata('error', 'Please login first!');
              return redirect()->to('/');
          }

          $role_id = $sessions['role_id'];
          $query = $db->query('SELECT * FROM user_menu where is_active = 1 AND id_role = ' . $role_id . ' AND posisi = "navbar" ORDER BY urutan ASC');
          $menu = $query->getResultArray();

          foreach($menu as $m):
            // Query submenu based on parent menu id
            $query_submenu = $db->query('SELECT * FROM user_sub_menu where is_active = 1 AND menu_id = ' . $m['menu_id'] . ' ORDER BY urutan ASC');
            $submenu = $query_submenu->getResultArray();

            if (!empty($submenu)) {
        ?>
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex dropdown-toggle align-items-center pe-0" href="#"
              data-bs-toggle="dropdown">
              <img src="<?= base_url();?>/img/<?= session()->get('user_data')['avatar']?>" alt="Profile"
                class="rounded-circle" style="height:50px">
              <!-- <span class="d-none d-md-block dropdown-toggle ps-2"><?php // echo $m['menu_name']; ?></span> -->
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?php echo $m['menu_name']; ?></h6>
                <span><?php echo $sessions['username']; ?></span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php
                  foreach ($submenu as $sm):
                      ?>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url($sm['url_link']); ?>">
                  <i class="<?php echo $sm['icons']; ?>"></i>
                  <span><?php echo $sm['sub_menu_name']; ?></span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php } else { ?>
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="<?= base_url($m['url_link']);?>" data-bs-toggle="dropdown">
              <i class="bi bi-bell"></i>
              <span class="badge bg-danger badge-number d-none">4</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
              <li class="dropdown-header">
                You have 4 new notifications
                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>Lorem Ipsum</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>30 min. ago</p>
                </div>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              
              <li class="dropdown-footer">
                <a href="#">Show all notifications</a>
              </li>

            </ul>
          </li>
        <?php } endforeach;?>

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->


  <?= $this->include('v_admin/header/sidebar'); ?>

  <main id="main" class="main">
    <?= $this->renderSection('page-content'); ?>
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> | Develop by Idham Mansyah Awwalu
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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
  <?= $this->renderSection('scripts');?>

</body>

</html>