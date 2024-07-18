<?= $this->extend('v_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h4 class="card-header fw-bold text-dark">All Role</h4>
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6><i class="bi bi-journals"></i>&nbsp; Role</h6>
            </li>

            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_Role"><i
                  class="bi bi-plus-square"></i>&nbsp; Add New Role</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <table class="table table-hover table-striped" id="table_role" style="width: 100%;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Role</th>
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

    dataTable = $('#table_role').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_role');?>",
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
          "data": "role_name",
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