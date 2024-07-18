<?= $this->extend('v_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <?= session_notif(); ?>
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow">
        <h4 class="card-header fw-bold text-dark text-uppercase">Edit Items - <?= $items['nama_barang']; ?></h4>
        <form action="<?= route_to('update_items', $items['id_items']); ?>" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <input type="hidden" name="id_items" value="<?= $items['id_items']; ?>">
            <div class="mt-3">
              <div class="mb-3">
                <label class="form-label" for="">Item Name</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Item Name"
                  value="<?= $items['nama_barang']?>">
              </div>
              <!-- <div class="col-md-6 mb-3">
                <label class="form-label" for="stock_quantity">Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control" value="<?php // $items['stock_quantity']; ?>"
                  placeholder="Enter stock quantity" id="stock_quantity" min="0">
                <div class="invalid-feedback" id="feedback" style="display:none;">
                  Please enter a valid stock quantity.
                </div>
              </div> -->
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  // document.getElementById('stock_quantity').addEventListener('input', function (e) {
  //   var input = e.target;
  //   var feedback = document.getElementById('feedback');

  //   // Remove non-numeric characters
  //   input.value = input.value.replace(/[^0-9]/g, '');

  //   // Show feedback if input is invalid
  //   if (input.value === '' || isNaN(input.value)) {
  //     feedback.style.display = 'block';
  //   } else {
  //     feedback.style.display = 'none';
  //   }
  // });
</script>
<?= $this->endSection();?>