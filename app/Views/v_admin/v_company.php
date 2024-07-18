<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h4 class="card-header fw-bold text-dark text-uppercase"><i class="bi bi-briefcase"></i>&nbsp; Company
        </h4>
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6><i class="bi bi-briefcase"></i>&nbsp; Company</h6>
            </li>

            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_company"><i
                  class="bi bi-plus-square"></i>&nbsp; Add New Company</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <table class="table table-striped table-hover" id="Company" style="width: 100%;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Company Name</th>
                <th scope="col">Picture</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    let dataTable;
    let baseUrl = "<?= base_url(''); ?>/img/pt/";
    dataTable = $('#Company').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_company');?>",
        "type": "POST"
      },
      "columns": [{
          data: null,
          render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          orderable: true,
        },
        {
          "data": "company_name",
          orderable: true,
        },
        {
          "data": "company_picture",
          orderable:false,
          render: function (data, type, row) {
            if (data) {
              return '<img src="' + baseUrl + data + '" alt="Company Picture" style="width:150px; height:150px;"/>';
            } else {
              return 'No Image';
            }
          },
        }
      ]
    });
  });
</script>
<?= $this->endSection();?>