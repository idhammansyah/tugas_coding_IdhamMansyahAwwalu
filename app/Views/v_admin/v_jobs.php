<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="section dashboard">
  <?php echo session_notif(); ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <h4 class="card-header text-dark fw-bold text-uppercase"><i class="bi bi-briefcase"></i>&nbsp; Jobs</h4>
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6><i class="bi bi-journals"></i>&nbsp; Jobs</h6>
            </li>

            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_new_jobs"><i
                  class="bi bi-plus-square"></i>&nbsp; Add New Jobs</a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <button id="cardViews" class="btn btn-primary mt-3 mb-3">Card View</button>
          <div id="cardView" class="row"></div>

          <table class="table table-hover table-striped" id="table_job" style="width: 100%; text-align: center;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">Company</th>
                <th scope="col">Department</th>
                <th scope="col">Level</th>
                <th scope="col">Position</th>
                <th scope="col">Contracts</th>
                <th scope="col">Location</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <!-- end Jobs -->

        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="add_new_jobs" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Add New Jobs</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="<?= route_to('post-a-job')?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col">  
              <label for="Company">Company</label>
              <select class="form-select select2-hidden-accessible" name="company" tabindex="-1" aria-hidden="true" id="company" style="width: 100%;">
                <option value="">-- Pilih Salah Satu --</option>
                <?php foreach($company as $c) : ?>
                  <option value="<?= $c['id_company']?>"><?= $c['company_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
            
            <div class="col">
              <label for="department">Department</label>
              <select class="form-select select2-hidden-accessible" name="department" tabindex="-1" aria-hidden="true" id="department" style="width: 100%;">
                <option value="">-- Pilih Salah Satu --</option>
                <?php foreach($dept as $dep) :?>
                  <option value="<?= $dep['id_dept']?>"><?= $dep['department_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">  
              <label for="level">Level</label>
              <select class="form-select select2-hidden-accessible" name="level" tabindex="-1" aria-hidden="true" id="level" style="width: 100%;">
                <option value="">-- Pilih Salah Satu --</option>
                <?php foreach($level as $lvl) :?>
                  <option value="<?= $lvl['id_level']?>"><?= $lvl['level_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
            
            <div class="col">
              <label for="position">Position</label>
              <select class="form-select select2-hidden-accessible" name="position" tabindex="-1" aria-hidden="true" id="position" style="width: 100%;">
                <option value="">-- Pilih Salah Satu --</option>
                <?php foreach($position as $pos) :?>
                  <option value="<?= $pos['id_position']?>"><?= $pos['position_name']?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">  
              <label for="contract">Contract Type</label>
              <select class="form-select select2-hidden-accessible" name="contract" tabindex="-1" aria-hidden="true" id="contract" style="width: 100%;">
                <option value="">-- Pilih Salah Satu --</option>
                <?php foreach($contract as $cr) :?>
                  <option value="<?= $cr['id_contract']?>"><?= $cr['contract_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
            
            <div class="col">
              <label for="location">Location</label>
              <select class="form-select select2-hidden-accessible" name="location" tabindex="-1" aria-hidden="true" id="location" style="width: 100%;">
                <option value="">-- Pilih Salah Satu --</option>
                <?php foreach($location as $loc) :?>
                  <option value="<?= $loc['id_location']?>"><?= $loc['location_name']?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="judul">Job Description Information</label>
            <textarea id="content" name="content" class="form-control" placeholder="Explain the content here"></textarea>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="">Open Job</label>
              <input type="text" id="openjob" class="form-control" placeholder="Start date open this job" name="opening">
            </div>

            <div class="col">
              <label for="">Closed Job</label>
              <input type="text" id="closedjob" class="form-control" placeholder="End date close this job" name="closed">
            </div>
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
$(document).ready(function () {

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

<script type="text/javascript">
  $(document).ready(function () {
    $('#company').select2({
      placeholder: "Choose Company",
      theme: "bootstrap-5",
      allowClear: true,
    });

    $('#department').select2({
      placeholder: "Choose Department",
      theme: "bootstrap-5",
      allowClear: true,
    });

    $('#level').select2({
      placeholder: "Choose Level",
      theme: "bootstrap-5",
      allowClear: true,
    });

    $('#position').select2({
      placeholder: "Choose Position",
      theme: "bootstrap-5",
      allowClear: true,
    });

    $('#contract').select2({
      placeholder: "Choose Contract Type",
      theme: "bootstrap-5",
      allowClear: true,
    });

    $('#location').select2({
      placeholder: "Choose Location",
      theme: "bootstrap-5",
      allowClear: true,
    });

    $("#openjob").datepicker({
      dateFormat: "dd-mm-yy", // Format tanggal
      minDate: 0, // Tanggal minimum (hari ini)
      changeMonth: true, // Izinkan perubahan bulan
      changeYear: true // Izinkan perubahan tahun
      // tambahkan opsi lain sesuai kebutuhan
    });
    
    $("#closedjob").datepicker({
      dateFormat: "dd-mm-yy", // Format tanggal
      minDate: 0, // Tanggal minimum (hari ini)
      maxDate: "+10M", // Tanggal maksimum (1 bulan dari sekarang)
      changeMonth: true, // Izinkan perubahan bulan
      changeYear: true // Izinkan perubahan tahun
      // tambahkan opsi lain sesuai kebutuhan
    });

  });
  
  CKEDITOR.replace('content', {
    extraPlugins: 'editorplaceholder',
    editorplaceholder: 'Explain the job description here',
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

  let dataTable;

  dataTable = $('#table_job').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_jobs');?>",
        "type": "POST"
      },
      columnDefs: [{
        targets: 1,
        render: function (data, type, row) {
          let color = '';
          if (data === '1') {
            status = 'active';
            color = 'success';
          }
          if (data === '0') {
            status = 'inactive';
            color = 'danger';
          }
          return '<span class="badge bg-' + color + '">' + status + '</span>';
        }
      }],
      "columns": [
        {data: null,render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          orderable: true,
        },
        { "data": "active", orderable: false, },
        { "data": "company_name", orderable: true, },
        { "data": "department_name", orderable: true, },
        { "data": "level_name", orderable: true, },
        { "data": "position_name", orderable: true, },
        { "data": "contract_name", orderable: true, },
        { "data": "contract_name", orderable: true, },
        {
          data: 'aksi',
          orderable:false,
          render: function (data, type, row) 
          {
            return `
              <button class="btn btn-primary btn-sm aksi-btn" data-bs-toggle="modal" data-id-user="${row.id_user}">
                <i class="bi bi-eye"></i>&nbsp; Action
              </button>
            `;
          },
        }
      ],
  });

    let searchBox = $('#table_job_filter').detach();
    let filtersbyNumber = $('#table_job_length').detach();

    // Append to their new container
    $('#searchContainer').append(searchBox);
    $('#filtersbyNumber').append(filtersbyNumber);

    $('#cardViews').click(function () {
      let isTableVisible = $('#table_job').is(':visible');
      $(this).text(isTableVisible ? "Table View" : "Card View");
      if (isTableVisible) {
        $('#table_job').hide();
        $('.dataTables_scroll').hide();
        $('#cardView').show();
        renderCards();
      } else {
        $('#cardView').hide();
        $('#table_job').show();
        $('.dataTables_scroll').show();
      }
    });

    function renderCards() {
      $('#cardView').empty();
      dataTable.rows({
        search: 'applied'
      }).every(function () {
        let rowData = this.data();
        let card = createCard(rowData);
        let modal = createModalAction(rowData);
        $('#cardView').append(card);
        $('body').append(modal);
      });
    }

    function createCard(rowData) {
      return `
        <div class="col-xl-6 mt-2">
					<div class="card shadow">
						<div class="card-header fw-bold text-dark">
              <img src="" class="img-thumbnail" style="height:50px">
              
						</div>
						<div class="card-body"><br>
							<p class="card-text fw-bold">
                Company :  <br>
                Department : <br>
                Status Job :  <br>
                Job Opening To : -  <br>
              </p>
						</div>
						<div class="card-footer">
              <button type="button" class="btn btn-primary btn-sm float-end btns" data-bs-toggle="modal" data-bs-target="#myModal-" id="post_data" data-post-uid="">
                  <i class="bi bi-eye"></i>&nbsp; Action
              </button>
						</div>
					</div>
				</div>`;
    }

    function createModalAction(rowData) 
    {
      return `
        <div class="modal fade" id="myModal-" tabindex="-1" aria-labelledby="myModalLabel-" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel-">Details for Job - <b></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-xl-12">
                    <div class="card">
                      <div class="card-body">
                        <h6 class="card-text mt-3">Open job at : <b class="fw-bold"></b></h6>
                        <h6 class="card-text mt-3">Open job at : <b class="fw-bold text-danger"></b></h6>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-xl-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="text-danger fw-bold text-center mt-3">Action</h4>
                        <a class="btn btn-primary d-grid" href="">
                          <i class="bi bi-person-vcard"></i>See who's applied
                        </a>
                        <hr>
                        <div class="d-flex justify-content-center">
                          <a href="" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>&nbsp; Edit Job
                          </a>
                          
                          <form action="" method="post">
                            <input type="hidden" value="" name="job">
                            <button type="submit" class="btn btn-danger ms-3">
                              <i class="bi bi-x-octagon-fill"></i>&nbsp; Close Job
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      `;
    }

    dataTable.on('draw', function () {
      if (!$('#table_job').is(':visible')) {
        renderCards();
      }
    });
</script>
<?= $this->endSection();?>