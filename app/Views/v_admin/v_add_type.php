<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <?= session_notif(); ?>
  <div class="row">
    <div class="card shadow">
      <h4 class="card-header fw-bold text-dark text-uppercase">
        <i class="bi bi-diagram-3-fill"></i> &nbsp; Items Type
      </h4>
      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6><i class="bi bi-diagram-3-fill"></i>&nbsp; Items Type</h6>
          </li>

          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_type"><i
                class="bi bi-diagram-3-fill"></i>&nbsp; Add New Items Type</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="items" style="width: 100%;">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item Type</th>
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

<div class="modal fade" id="add_new_type" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Add New Items Type</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="add_items_type" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label" for="">Item Type Name</label>
            <input type="text" name="item_type_name" class="form-control" placeholder="Item Type Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="submitFormItemsType()" class="btn btn-primary" id="save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach($items as $item) :?>

  <div edit-type="<?= route_to('edit_item_type', $item['id_items_type']); ?>" style="display:none" id="edit-type-<?= $item['id_items_type']?>" class="edit-type"></div>

  <div delete-type="<?= route_to('delete_items_type' ,$item['id_items_type']); ?>" style="display:none" id="delete-type-<?= $item['id_items_type']?>" class="delete-type"></div>

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
        "url": "<?= route_to('datatables_type_items');?>",
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
          "data": "item_type_name",
          orderable: true,
        },
        {
          data: 'aksi',
          orderable:false,
          render: function (data, type, row) 
          {
            let edit_type = $(`#edit-type-${row['id_items_type']}`).attr('edit-type');
            let delete_type = $(`#delete-type-${row['id_items_type']}`).attr('delete-type');
            return `
              <button class="btn btn-primary btn-sm aksi-btn" data-id-items="${row['id_items_type']}" data-bs-toggle="modal" data-bs-target="#editItems-${row['id_items_type']}">
                <i class="bi bi-eye"></i>&nbsp; Action
              </button>

              <div class="modal fade" id="editItems-${row['id_items_type']}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Items</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 class="text-center">Action for <b>${row['item_type_name']}</b></h5>
                      <div class="d-flex justify-content-center">
                        <a href="${edit_type}" class="btn btn-warning me-3">
                          <i class="fa fa-edit"></i>&nbsp; Edit
                        </a>
                        <a href="${delete_type}" class="btn btn-danger">
                          <i class="fa fa-trash"></i>&nbsp; Delete
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

  function submitFormItemsType() {
    let submitFormItemsType = $('#add_items_type').serialize();

    $.ajax({
      type: 'POST',
      url: '<?= route_to('add_item_type'); ?>',
      data: submitFormItemsType,
      success: function(response) {
        $('#add_new_type').modal('hide');
        $('#add_items_type')[0].reset();

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