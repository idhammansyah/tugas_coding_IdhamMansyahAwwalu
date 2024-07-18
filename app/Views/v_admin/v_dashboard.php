<?= $this->extend('v_admin/header/header');?>

<?= $this->section('page-content');?>

<div class="pagetitle">
  <?php echo session_notif(); ?>
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <?php foreach($breadcrumb as $crumb): ?>
        <li class="breadcrumb-item active"><a class="<?= $crumb['url_link']?>"><?= $crumb['sub_menu_name']?></a></li>
      <?php endforeach;?>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Sales <span>| Today</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                  <h6>145</h6>
                  <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Revenue <span>| This Month</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6>$3,264</h6>
                  <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Customers <span>| This Year</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>1244</h6>
                  <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Users -->
        <div class="col-12">
          <div class="card recent-sales">

            <div class="card-body">
              <h5 class="card-title">User Account</h5>

              <table class="table table-striped table-hover" id="users" style="width: 100%;">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Verified</th>
                    <th scope="col">Username</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Department</th>
                  </tr>
                </thead>
                <tbody>
                <div class="spinner-border" id="status" role="status" style="display:none;">
                  <span class="visually-hidden">Loading...</span>
                </div>

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Users -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Reports <span>/Today</span></h5>

              <!-- Line Chart -->
              <div id="reportsChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{
                      name: 'Sales',
                      data: [31, 40, 28, 51, 42, 82, 56],
                    }, {
                      name: 'Revenue',
                      data: [11, 32, 45, 32, 34, 52, 41]
                    }, {
                      name: 'Customers',
                      data: [15, 11, 32, 18, 9, 24, 11]
                    }],
                    chart: {
                      height: 350,
                      type: 'area',
                      toolbar: {
                        show: false
                      },
                    },
                    markers: {
                      size: 4
                    },
                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                    fill: {
                      type: "gradient",
                      gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'smooth',
                      width: 2
                    },
                    xaxis: {
                      type: 'datetime',
                      categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                    },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy HH:mm'
                      },
                    }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>

          </div>
        </div><!-- End Reports -->

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

      <!-- News & Updates Traffic -->
      <div class="card">
        <div class="card-body pb-0">
          <h5 class="card-title">News &amp; Updates</h5>

          <div class="news">
            <div class="post-item clearfix">
              <img src="<?= base_url()?>/img/news-1.jpg" alt="">
              <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
              <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
            </div>

          </div><!-- End sidebar recent posts-->

        </div>
      </div><!-- End News & Updates -->

      <!-- Recent Activity -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Recent Activity 
            <!-- <span>| Today</span> -->
          </h5>

          <div class="activity">
            <?php foreach($activities_log as $logs) :?>
              <div class="activity-item d-flex">
                <div class="activite-label" style="width: 100px;">
                  <?= view_cell('App\Libraries\TimeFormats::human', ['date_time' => $logs['created'], 'timezone' => 'Asia/Jakarta']); ?>
                </div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content">
                  <?= $logs['username'] . ' ' . $logs['activity_user'] ?>
                </div>
              </div>
            <?php endforeach;?>
          </div>
          <!-- End activity item-->

        </div>
      </div><!-- End Recent Activity -->

    </div><!-- End Right side columns -->

  </div>
</section>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#users').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_dashboard');?>",
        "type": "POST"
      },
      columnDefs: [{
        targets: 1,
        render: function (data, type, row) {
          let color = '';
          if (data === 'verified') {
            color = 'success';
          }
          if (data === 'activate account') {
            color = 'warning';
          }
          return '<span class="badge bg-' + color + '">' + data + '</span>';
        }
      }],
      "columns": [
        {data: null,render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          orderable: true,
        },
        {"data": "status", orderable: true, },
        {"data": "username", orderable: true, },
        {"data": "nama_lengkap",orderable: true, },
        {"data": "company_name",orderable: true, },
        {"data": "department_name", orderable: true,},
      ],
      "preXhr": function () {
        setTimeout(function() {
          // Tampilkan pesan proses di sini
          $('#status').show();
        }, 1000);
      },
      "xhr": function () {
        var xhr = $.ajaxSettings.xhr();
        xhr.onload = function () {
        // Sembunyikan pesan proses di sini
          $('#status').hide();
        };
        return xhr;
      }
    });
  });
</script>
<?= $this->endSection();?>