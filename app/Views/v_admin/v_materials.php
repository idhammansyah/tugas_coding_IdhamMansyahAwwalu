<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="section dashboard">
  <?php echo session_notif(); ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header"><i class="bi bi-journals"></i>&nbsp; Learning Materials</div>
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6><i class="bi bi-journals"></i>&nbsp; Learning Materials</h6>
            </li>

            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_materials"><i
                  class="bi bi-plus-square"></i>&nbsp; Add New Learning Materials</a>
            </li>
          </ul>
        </div>

        <div class="card-body">

          <!-- learning materials -->
          <div class="row" id="materi">
            <?php if(! empty($materi)) {?>
              <?php foreach($materi as $m) : ?>
                <div class="col-xl-6 mt-2">
                  <div class="card shadow">
                    <div class="card-header bg-<?= $m['publish'] == 0 ? 'danger' : 'success'?> text-white">
                      <span class="fw-bold text-uppercase"><?= $m['publish'] == 0 ? 'Not Publish Yet' : 'Publish'?></span>
                    </div>
                    <div class="row g-0">
                      <div class="col-md-4">
                        <?php $files = $m['file_materi']; $cek_files = cek_extension_file($files); ?>
                        <?php if($cek_files == 'pdf' || $cek_files == 'xls' || $cek_files == 'xlsx' || $cek_files == 'doc' || $cek_files == 'docx') {?>
                          <!-- style="margin:40px 80px 40px 80px;" -->
                          <svg class="img-fluid" xmlns="http://www.w3.org/2000/svg" width="10rem" height="10rem" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus mt-12"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                        <?php } else {?>
                          <img src="<?= base_url()?>/<?=$m['path_file']?>/<?= $m['file_materi']?>" class="img-fluid rounded-start">
                          <?php }?>
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title text-uppercase fw-bold"><?= $m['judul']; ?></h5>
                          <p class="card-text fst-italic">Pemateri : <?= $m['nama_lengkap']?></p>
                          <?php if(!empty($m['link_materi'])) :?>
                            <p>Link : <a href="<?= $m['link_materi']?>" class="card-text"><?= $m['link_materi']?></a></p>
                          <?php endif;?>
                          <div class="kalimat">
                            <p>
                              <span id="kalimat_potong" data-id="<?= $m['id_materi']?>"><?= potongKalimat($m['konten'], 100); ?></span>
                              <span class="selengkapnya" data-id="<?= $m['id_materi']?>" style="display:none;">
                                <?php echo $m['konten']; ?>
                              </span>
                              <a href="#" class="tampilkan" data-id="<?= $m['id_materi'] ?>">Read more</a>
                            </p>
                          </div>
                          <p class="card-text"><small class="text-muted"> <?= view_cell('App\Libraries\TimeFormats::human', ['date_time' => $m['tgl_posting'], 'timezone' => 'Asia/Jakarta']); ?> | posted by : <?= $m['posted_by']?></small></p>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <?php if($m['publish'] == 0) {?>
                        <button type="button" class="btn btn-primary" data-materi="<?= $m['id_materi']?>" id="publish">Publish</button>
                        <button type="button" data-materi="<?= $m['id_materi']?>" class="btn btn-danger" data-materi="<?= $m['id_materi'] ?>" id="delete">Delete</button>
                      <?php } else {?>
                        <button type="button" class="btn btn-danger" data-materi="<?= $m['id_materi']?>" id="close_publish">Close Publish</button>
                      <?php }?>
                    </div>
                  </div>
                </div>
              <?php endforeach;?>
            <?php } else {?>
              <div class="col-xl-12 mt-3">
                <h4 class="text-center card-text fw-bold text-danger m-5">No learning materials found!</h4>
              </div>
            <?php }?>
          </div>
          <!-- learning materials -->

        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="add_new_materials" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Materials</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="<?= route_to('save-materi')?>" enctype="multipart/form-data">
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="judul">Title</label>
            <input type="text" class="form-control" id="judul" placeholder="Insert title" name="title">
          </div>

          <div class="mb-3">
            <label for="judul">Content Information</label>
            <textarea id="content" name="contents" class="form-control" placeholder="Explain the content here"></textarea>
          </div>
          <!-- <script>
            CKEDITOR.replace('content', {
              extraPlugins: 'editorplaceholder',
              editorplaceholder: 'Explain the content here',
              toolbar: [{
                  name: 'basicstyles',
                  groups: ['basicstyles', 'cleanup'],
                  items: ['Bold', 'Italic', 'Underline', 'Strike']
                },
                {
                  name: 'paragraph',
                  items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'Blockquote', ,
                    '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'BidiLtr', 'BidiRtl', 'Language'
                  ]
                },
                {
                  name: 'styles',
                  items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                  name: 'colors',
                  items: ['TextColor', 'BGColor']
                }
              ]
            });
          </script> -->

          <div class="mb-3">
            <label for="basic-url" class="form-label">Your URL (optional)</label>
            <input type="text" class="form-control" name="link" id="basic-url" aria-describedby="basic-addon3" placeholder="Input link here">
          </div>

          <div class="mb-3">
            <label>Upload file (Optional)</label>
            <input type="file" class="form-control" id="file" placeholder="Insert file" name="file_upload">
            <small class="text-danger">Upload file if there's material's file.</small>
          </div>

          <div class="mb-3">
            <label for="pemateri">Pemateri</label>
            <!-- <select class="form-select select2-hidden-accessible" name="pemateri[]" multiple="multiple" tabindex="-1" aria-hidden="true" id="pemateri" style="width: 100%;"> -->
            <select class="form-select select2-hidden-accessible" name="pemateri" tabindex="-1" aria-hidden="true" id="pemateri" style="width: 100%;">
              <?php foreach($pemateri as $pm) :?>
                <option value="<?= $pm['id_user']?>"><?= $pm['nama_lengkap']?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <script>
            $(document).ready(function () {
              $('#pemateri').select2({
                placeholder: "Pilih pemateri",
                theme: "bootstrap-5",
                // allowClear: true,
              });
            });
          </script>

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
$(document).ready(function () {
  $(document).on('click', '[data-id]', function(e) {
    e.preventDefault();
    let id_materi = $(this).attr('data-id');
    let selengkapnya =$(".selengkapnya[data-id='" + id_materi + "']"); 
    let potong_kalimat = $("#kalimat_potong");
    
    $(this).prev(selengkapnya).slideToggle();
    selengkapnya.show(); // Tampilkan konten yang sesuai dengan data-id
    $(this).text(function(i, text){
      return text == "Read more" ? "Read less" : "Read more";
    });
  });

  $(document).on('click', '#publish', function(e) {
    e.preventDefault();
    let data_materi = $(this).attr('data-materi');
    let dataToSend = { 'data-materi': data_materi };

    $.ajax({
      method: "post",
      url: "<?= route_to('publish-materi')?>",
      data: dataToSend,
      success: function (response) {
        alertify.set('notifier', 'position', 'bottom-right');
        let responseString = JSON.stringify(response);
        if(responseString.indexOf("Failed") !== -1) {
          alertify.error(response.status);
        } else{
          alertify.success(response.status);
        }

        setTimeout(function(){
          window.location.reload();
        }, 1000);
      }
    });

  });

  $(document).on('click', '#close_publish', function(e) {
    e.preventDefault();
    let data_materi = $(this).attr('data-materi');
    let dataToSend = { 'data-materi': data_materi };

    $.ajax({
      method: "post",
      url: "<?= route_to('close-materi')?>",
      data: dataToSend,
      success: function (response) {
        alertify.set('notifier', 'position', 'bottom-right');
        let responseString = JSON.stringify(response);
        if(responseString.indexOf("Failed") !== -1) {
          alertify.error(response.status);
        } else{
          alertify.success(response.status);
        }

        setTimeout(function(){
          window.location.reload();
        }, 1000);
      }
    });

  });

  $(document).on('click', '#delete', function(e) {
    e.preventDefault();
    let data_materi = $(this).attr('data-materi');
    let dataToSend = { 'data-materi': data_materi };

    $.ajax({
      method: "post",
      url: "<?= route_to('delete-materi')?>",
      data: dataToSend,
      success: function (response) {
        alertify.set('notifier', 'position', 'bottom-right');
        let responseString = JSON.stringify(response);
        if(responseString.indexOf("Failed") !== -1) {
          alertify.error(response.status);
        } else{
          alertify.success(response.status);
        }

        setTimeout(function(){
          window.location.reload();
        }, 1000);
      }
    });

  });

});

</script>
<?= $this->endSection();?>