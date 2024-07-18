<?= $this->extend('v_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="dashboard">
  <?= session_notif(); ?>
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow">
        <h4 class="card-header fw-bold text-dark text-uppercase">Edit Items - <?= $items['item_type_name']; ?></h4>
        <form action="<?= route_to('update_items_type', $items['id_items_type']); ?>" method="post" enctype="multipart/form-data">
          <div class="card-body">
            <input type="hidden" name="id_items_type" value="<?= $items['id_items_type']; ?>">
            <div class="mb-3">
              <label class="form-label" for="">Item Name</label>
              <input type="text" name="item_type_name" class="form-control" placeholder="Item Type Name"
                value="<?= $items['item_type_name']?>">
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