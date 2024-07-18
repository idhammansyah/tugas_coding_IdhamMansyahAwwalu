<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <?= session_notif(); ?>
  <div class="row">
    <div class="card shadow">
      <h4 class="card-header fw-bold text-dark text-uppercase">
        <i class="bi bi-box-seam-fill"></i> &nbsp; Items Transaction
      </h4>
      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6><i class="bi bi-box-seam-fill"></i>&nbsp; Transaction</h6>
          </li>

          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_transaction"><i
                class="bi bi-box-seam-fill"></i>&nbsp; Add New Transaction</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="items_transaction" style="width: 100%;">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Items Name</th>
              <th scope="col">Stock</th>
              <th scope="col">Total Sell</th>
              <th scope="col">Transaction Date</th>
              <th scope="col">Items Type</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="add_new_transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Take Item Stock</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="add_items_type" action="<?= route_to('take_item')?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label" for="">Item Name</label>
            <select id="id_items" name="id_items" class="form-select" required>
              <option value="" disabled selected>Select an item</option>
              <?php foreach ($items as $item): ?>
                <option value="<?= $item['id_items'] ?>"><?= $item['nama_barang'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="jumlah">Jumlah:</label>
            <input class="form-control" type="number" id="jumlah" name="jumlah" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
    document.getElementById('jumlah').addEventListener('input', function (e) {
    var input = e.target;
    var feedback = document.getElementById('feedback');

    // Remove non-numeric characters
    input.value = input.value.replace(/[^0-9]/g, '');

    // Show feedback if input is invalid
    if (input.value === '' || isNaN(input.value)) {
      feedback.style.display = 'block';
    } else {
      feedback.style.display = 'none';
    }
  });

  $(document).ready(function () {
    let dataTable;
    dataTable = $('#items_transaction').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_items_transaction');?>",
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
          "data": "nama_barang",
          orderable: true,
        },
        {
          "data": "stock",
          orderable: false,
        },
        {
          "data": "banyaknya_jual",
          orderable: false,
        },
        {
          "data": "tanggal_transaction",
          orderable: true,
        },
        {
          "data": "item_type_name",
          orderable: false,
        },
      ]
    });
  });
</script>
<?= $this->endSection();?>