<?= $this->extend('v_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <?= session_notif(); ?>
  <div class="row">
    <div class="card shadow">
      <h4 class="card-header fw-bold text-dark text-uppercase">
        <i class="bi bi-diagram-3-fill"></i> &nbsp; Items
      </h4>
      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6><i class="bi bi-diagram-3-fill"></i>&nbsp; Items</h6>
          </li>

          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_items"><i
                class="bi bi-diagram-3-fill"></i>&nbsp; Add New Items</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="items" style="width: 100%;">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="add_new_items" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Add New Items</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="add_items" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" for="">Item Name</label>
              <input type="text" name="nama_barang" class="form-control" placeholder="Item Name">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="submitFormItems()" class="btn btn-primary" id="save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach($items as $item) :?>

  <div edit-barang="<?= route_to('edit_items', $item['id_items']); ?>" style="display:none" id="edit-barang-<?= $item['id_items']?>" class="edit-barang"></div>

  <div delete-barang="<?= route_to('delete_items' ,$item['id_items']); ?>" style="display:none" id="delete-barang-<?= $item['id_items']?>" class="delete-barang"></div>

<?php endforeach;?>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    let dataTable;
    dataTable = $('#items').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_items');?>",
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
          data: 'aksi',
          orderable:false,
          render: function (data, type, row) 
          {
            let edit_barang = $(`#edit-barang-${row['id_items']}`).attr('edit-barang');
            let delete_barang = $(`#delete-barang-${row['id_items']}`).attr('delete-barang');
            return `
              <button class="btn btn-primary btn-sm aksi-btn" data-id-items="${row['id_items']}" data-bs-toggle="modal" data-bs-target="#editItems-${row['id_items']}">
                <i class="bi bi-eye"></i>&nbsp; Action
              </button>

              <div class="modal fade" id="editItems-${row['id_items']}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Items</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-center">Action for <b>${row['nama_barang']}</b></h5>
                      <div class="d-flex justify-content-center">
                        <a href="${edit_barang}" class="btn btn-warning me-3">
                          <i class="fa fa-edit"></i>&nbsp; Edit ${row['nama_barang']}
                        </a>
                        <a href="${delete_barang}" class="btn btn-danger">
                          <i class="fa fa-trash"></i>&nbsp; Delete ${row['nama_barang']}
                        </a>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            `;
          },
        },
      ]
    });
  });

  function submitFormItems() {
    let submitFormItems = $('#add_items').serialize();

    $.ajax({
      type: 'POST',
      url: '<?= route_to('add_item_stock'); ?>',
      data: submitFormItems,
      success: function(response) {
        $('#add_new_items').modal('hide');
        $('#add_items')[0].reset();

        alertify.set('notifier', 'position', 'bottom-right');
        let responseString = JSON.stringify(response);
        if(responseString.indexOf("failed") !== -1) {
          alertify.error(response.status);
        } else{
          alertify.success(response.status);
        }

        setTimeout(function(){
          window.location.reload();
        }, 1000);
      }
    });
  }

</script>
<?= $this->endSection();?>