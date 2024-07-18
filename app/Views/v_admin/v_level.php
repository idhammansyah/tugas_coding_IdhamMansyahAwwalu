<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h4 class="card-header fw-bold text-dark text-uppercase"><i class="fa-solid fa-people-line"></i>&nbsp; Job Level
        </h4>
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6><i class="fa-solid fa-people-line"></i>&nbsp; Level</h6>
            </li>

            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_level"><i
                  class="bi bi-plus-square"></i>&nbsp; Add New Level</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <table class="table table-striped table-hover" id="level_tables" style="width: 100%;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Job Level </th>
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

    dataTable = $('#level_tables').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_level');?>",
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
          "data": "level_name",
          orderable: true,
        }
        // {
        //   data: 'aksi',
        //   render: function (data, type, row) 
        //   {
        //     return `
        //       <button class="btn btn-primary btn-sm aksi-btn" data-bs-toggle="modal" data-id-user="">
        //         <i class="bi bi-pencil-square"></i>&nbsp; Action
        //       </button>
        //     `;
        //   },
        // }
      ]
    });
  });
</script>
<?= $this->endSection();?>