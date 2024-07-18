<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>
<section class="section dashboard">
  <ol class="breadcrumb">
    <?php foreach($breadcrumb as $crumb): ?>
      <li class="breadcrumb-item active"><a class="<?= $crumb['url_link']?>"><?= $crumb['sub_menu_name']?></a></li>
    <?php endforeach;?>
  </ol>
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          Menu Category
          <a class="icon float-end" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Menu Category Management</h6>
            </li>
            <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_menu_category">Add New Menu Category</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <ul id="categoriesMenu" class="list-group mt-3">
            <?php foreach($menu_category as $m):?>
              <a href="#" class="text-white menu-categories-item" data-category="<?= $m['id_menu_category']?>">
                <li class="list-group-item bg-<?= $m['is_active'] == 1 ? 'success' : 'danger' ?> text-white">
                  <div class="float-end" role="group" aria-label="Basic example" style="margin:-3px;">
                    <button type="button" class="btn btn-sm btn-warning me-2"><i class="bi bi-pencil-square"></i></button>
                    <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                  </div>
                  <?= $m['nama_menu_category']?>
                </li>
              </a>
              <!-- <a href="#" class="text-white menu-item" data-menu="<?php // $m['menu_id']?>">
                <li class="list-group-item bg-<?php // $m['is_active'] == 1 ? 'success' : 'danger' ?> text-white">
                  <div class="float-end" role="group" aria-label="Basic example" style="margin:-3px;">
                    <button type="button" class="btn btn-sm btn-warning me-2"><i class="bi bi-pencil-square"></i></button>
                    <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                  </div>
                  <i class="<?php // $m['icons']?>"></i>&nbsp; <?php // $m['menu_name']?>
                </li>
              </a> -->
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          Menu
          <a class="icon float-end" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Menu Management</h6>
            </li>
            <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_menu">Add Menu</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <ul id="sortableMenu" class="list-group mt-3">
            <!-- Submenu akan ditampilkan di sini -->
            <p>klik menu category di sebelah kiri, akan muncul menu disini</p>
          </ul>
        </div>

      </div>
    </div>

    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          Sub Menu
          <a class="icon float-end" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Menu Management</h6>
            </li>
            <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_sub_menu">Add Sub Menu</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <ul id="sortableSubMenu" class="list-group mt-3">
            <!-- Submenu akan ditampilkan di sini -->
            <p>klik menu di sebelah kiri, akan muncul sub menunya disini</p>
          </ul>
        </div>

      </div>
    </div>

  </div>
</section>

<div class="modal fade" id="add_menu_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" id="categories_menu_add" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Menu Category Name</label>
              <input type="text" class="form-control" name="menu_category_name" placeholder="Learning, Settings, or etc">
            </div>
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Description</label>
              <input type="text" class="form-control" name="desc" placeholder="Description The Menu">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Active</label>
              <select name="is_active" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Queue</label>
              <input type="number" name="urutan" class="form-control" placeholder="1/2/3">
            </div>
          </div>

          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Role</label>
            <select name="role_name" class="form-select">
              <?php foreach($role as $r): ?>
                <option value="<?= $r['id_role']?>"><?= $r['role_name']; ?></option>
              <?php endforeach;?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="submitFormCategories()" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="add_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" id="menu_add" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Menu Name</label>
              <input type="text" class="form-control" name="menu_name" placeholder="Learning, Settings, or etc">
            </div>
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Icons</label>
              <input type="text" class="form-control" name="icons" placeholder="bi bi-gear">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">URL Link</label>
              <input type="text" class="form-control" name="url_link" placeholder="ex. 4[page]/menu-management[menu name]">
            </div>
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Position</label>
              <select name="position_menu" class="form-select">
                <option value="sidebar">Sidebar</option>
                <option value="navbar">Navbar</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Role</label>
              <select name="role_name" class="form-select">
                <?php foreach($role as $r): ?>
                  <option value="<?= $r['id_role']?>"><?= $r['role_name']; ?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Active</label>
              <select name="is_active" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Choose Menu Category</label>
              <select name="categories" class="form-select">
                <option value="">-- Choose One --</option>
                <?php foreach($menu_category as $c): ?>
                  <option value="<?= $c['id_menu_category']?>"><?= $c['nama_menu_category']?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Queue</label>
              <input type="number" name="queue" class="form-control" placeholder="1/2/3">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="submitForm()" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="add_sub_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sub Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="sub_menu" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Sub Menu Name</label>
              <input type="text" name="sub_menu_name" class="form-control" placeholder="View users, Add New, etc">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Menu Parents</label>
              <select name="menu_id" id="" class="form-select">
                <?php foreach($menu as $m): ?>
                  <option value="<?= $m['menu_id']?>"><?= $m['menu_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">URL Link</label>
              <input type="text" class="form-control" name="url_link" placeholder="ex. 4[page]/menu-management[menu name]">
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">Role</label>
              <select name="role_name" class="form-select">
                <?php foreach($role as $r): ?>
                  <option value="<?= $r['id_role']?>"><?= $r['role_name']; ?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Active</label>
              <select name="is_active" class="form-select">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Icons</label>
              <input type="text" class="form-control" name="icons" placeholder="bi bi-gear">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Queue</label>
              <input type="number" name="queue" class="form-control" placeholder="1/2/3">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="submitFormSub()" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    getMenu();
    move_menu();
  });

  function move_menu() {
    $("#sortableMenu").sortable({
      connectWith: ".connectedSortable",
      update: function (event, ui) {
        let menuOrder = [];
        let submenuOrder = [];

        $("#sortableMenu a li").each(function () {
          let c = menuOrder.push($(this).data('menu'));
          // $.ajax({
          //   url: '<?= route_to('move_menu')?>',
          //   type: 'post',
          //   data: {
          //     menu_order: c
          //   },
          //   success: function (response) {
          //     alertify.set('notifier', 'position', 'bottom-right');
          //     let responseString = JSON.stringify(response);
          //     if(responseString.indexOf("gagal") !== -1) {
          //       alertify.error(response.status);
          //     } else{
          //       alertify.success(response.status);
          //     }
          //   }
          // });
        });
      }
    }).disableSelection();
  }
  
  function getMenu() {
    // Tangani klik pada menu utama
    $(".menu-categories-item").click(function () {
      let category = $(this).data('category');
      $.ajax({
        url: '<?= route_to('load_menu')?>',
        type: 'post',
        data: {
          categories: category
        },
        success: function (response) {
          // Tampilkan spinner
          $('#sortableMenu').empty();
          $('#sortableMenu').html('<div class="spinner-border text-primary" role="status">\
            <span class="visually-hidden">Loading...</span>\
          </div>');

          // Set timeout untuk menunggu sedikit sebelum menambahkan data ke dalam daftar
          setTimeout(function(){
            // Sembunyikan spinner dan tambahkan data ke dalam daftar
            $('#sortableMenu').empty();
            $.each(response, function (index, menu) {
              let backgroundClass = (menu.is_active == 1) ? 'bg-success' : 'bg-danger';
              $('#sortableMenu').append('\
              <a href="#" class="text-white menu-item" data-menu="' + menu.menu_id + '">\
                <li class="list-group-item  ' + backgroundClass + ' text-white"><i class="'+menu.icons+'"></i>&nbsp; ' + menu.menu_name + '</li>\
              </a>');
            });

            // Panggil fungsi getSubMenu setelah menu utama ditambahkan
            getSubMenu();
          }, 1000); // 1000 milidetik = 1 detik delay untuk simulasi loading
        }
      });
    });
  }

  function getSubMenu() {
    // Tangani klik pada item menu
    $(".menu-item").click(function () {
      let menuId = $(this).data('menu');
      $.ajax({
        url: '<?= route_to('load_sub_menu')?>',
        type: 'post',
        data: {
          menu: menuId
        },
        success: function (response) {
          // Tampilkan spinner
          $('#sortableSubMenu').empty();
          $('#sortableSubMenu').html('<div class="spinner-border text-primary" role="status">\
            <span class="visually-hidden">Loading...</span>\
          </div>');

          // Set timeout untuk menunggu sedikit sebelum menambahkan data ke dalam daftar
          setTimeout(function(){
            // Sembunyikan spinner dan tambahkan data ke dalam daftar
            $('#sortableSubMenu').empty();
            $.each(response, function (index, submenu) {
              let backgroundClass = (submenu.is_active == 1) ? 'bg-success' : 'bg-danger';
              $('#sortableSubMenu').append('\
              <a href="#" class="text-white">\
                <li class="list-group-item ' + backgroundClass + ' text-white"><i class="'+submenu.icons+'"></i>&nbsp; ' + submenu.sub_menu_name + '</li>\
              </a>');
            });
          }, 1000); // 1000 milidetik = 1 detik delay untuk simulasi loading
        }
      });
    });
  }

  function submitFormCategories() {
    let formDataCategories = $('#categories_menu_add').serialize();

    $.ajax({
      type: 'POST',
      url: '<?= route_to('add_new_menu_categories'); ?>',
      data: formDataCategories,
      success: function(response) {
        $('#add_menu_category').modal('hide');
        $('#categories_menu_add')[0].reset();

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

  // get data from form input menu
  function submitForm() {
    let formData = $('#menu_add').serialize();
    
    $.ajax({
      type: 'POST',
      url: '<?= route_to('add_new_menu'); ?>',
      data: formData,
      success: function(response) {
        $('#add_menu').modal('hide');
        $('#menu_add')[0].reset();

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

  // get data from form input sub menu
  function submitFormSub() {
    let formDataSubs = $('#sub_menu').serialize();
    
    $.ajax({
      type: 'POST',
      url: '<?= route_to('add_new_submenu'); ?>',
      data: formDataSubs,
      success: function(response) {
        $('#add_sub_menu').modal('hide');
        $('#sub_menu')[0].reset();

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
<?= $this->endSection(); ?>