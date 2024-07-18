<?= $this->extend('v_admin/header/header');?>
<?= $this->section('page-content');?>
<section class="section dashboard">
  <div class="row">
    <div class="col-12">
      <div class="card">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>List Account</h6>
            </li>

            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_accounts">Add Account</a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">List Account</h5>
          <table class="table table-striped table-hover" id="users" style="width: 100%;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Verified</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Company</th>
                <th scope="col">Department</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <div class="spinner-border" id="status" role="status" style="display:none;">
                <span class="visually-hidden">Loading...</span>
              </div>

            </tbody>
          </table>
        </div>

      </div>
    </div><!-- End Reports -->
  </div>
</section>

<div class="modal fade" id="add_accounts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data" id="nambah_akun">
        <div class="modal-body">
          <div class="row g-3">
            
            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <input type="email" class="form-control email" id="floatingInput" placeholder="Email" name="email" required>
                <label for="floatingInput">Email address</label>
                <span id="emailFeedback"></span>
              </div>
            </div>
            
            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control username" id="floatingInput" placeholder="Username" name="username" required>
                <label for="floatingInput">Username</label>
                <span id="usernameFeedback"></span>
              </div>
            </div>

          </div>

          <div class="row g-3">
            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="nama_lengkap" placeholder="Name" required>
                <label for="floatingInput">Full Name</label>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <select class="form-select company" name="role" id="floatingSelect" aria-label="Floating label select example" required>
                  <option selected>-- Choose Role --</option>
                  <?php foreach($role as $r) :?>
                  <option value="<?= $r['id_role']?>"><?= $r['role_name']?></option>
                  <?php endforeach; ?>
                </select>
                <label for="floatingSelect">Choose Role</label>
              </div>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <select class="form-select company" name="company" id="floatingSelect" aria-label="Floating label select example" required>
                  <option selected>-- Choose Company --</option>
                  <?php foreach($company as $cp) :?>
                  <option value="<?= $cp['id_company']?>"><?= $cp['company_name']?></option>
                  <?php endforeach; ?>
                </select>
                <label for="floatingSelect">Choose company</label>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <select class="form-select dept" id="floatingSelect"  name="department" aria-label="Floating label select example" required>
                  <option selected>-- Choose Department --</option>
                  <?php foreach($dept as $dp) :?>
                  <option value="<?= $dp['id_dept']?>"><?= $dp['department_name']?></option>
                  <?php endforeach; ?>
                </select>
                <label for="floatingSelect">Choose department</label>
              </div>
            </div>
          </div>

          <div class="row g-3">
            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <select class="form-select gender" name="gender" id="floatingSelect" aria-label="Floating label select example" required>
                  <option selected>-- Choose one --</option>
                  <option value="1">Man</option>
                  <option value="0">Woman</option>
                </select>
                <label for="floatingSelect">Choose gender</label>
              </div>
            </div>

            <div class="col-xl-6">
              <div class="form-floating mb-3">
                <select class="form-select gender" name="status_akun" id="floatingSelect" aria-label="Floating label select example" required>
                  <option selected>-- Account Set --</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
                <label for="floatingSelect">Account Set</label>
              </div>
            </div>
          </div>

          <div class="form-floating mb-3">
            <input type="password" class="form-control password" id="floatingInput" placeholder="Password" name="password" required>
            <label for="floatingInput">Password</label>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary saves">Create Account</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="aksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" data-id-user="">
  <div class="modal-dialog modal-dialog-centered modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5">User Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="data_user">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#users').DataTable({
      "processing": true,
      "serverSide": true,
      "orderable": true,
      'searching': true,
      "ajax": {
        "url": "<?= route_to('datatables_dashboard');?>",
        "type": "POST"
      },
      columnDefs: [{
        targets: 1,
        render: function (data, type, row) {
          let color = '';
          if (data === 'verified') {
            color = 'success';
          }
          if (data === 'activate account') {
            color = 'warning';
          }
          return '<span class="badge bg-' + color + '">' + data + '</span>';
        }
      }],
      "columns": [
        {data: null,render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          },
          orderable: true,
        },
        { "data": "status", orderable: true, },
        { "data": "username", orderable: true, },
        { "data": "nama_lengkap",orderable: true, },
        { "data": "company_name",orderable: true, },
        { "data": "department_name", orderable: true,},
        {
          data: 'aksi',
          render: function (data, type, row) 
          {
            return `
              <button class="btn btn-primary btn-sm aksi-btn" data-bs-toggle="modal" data-id-user="${row.id_user}">
                <i class="bi bi-eye"></i>&nbsp; Action
              </button>
            `;
          },
        }
      ]
    });

    $('.email').on('input', function () {
      let email = $(this).val();
      if (email.includes('@') && (email.includes('.com') || email.includes('.co.id'))) {
        $.post('check-email', {
          email: email
        }, function (data) {
          let result = JSON.parse(data);

          // Menampilkan feedback
          $('#emailFeedback').text(result.message);

          // Mengubah warna teks berdasarkan status
          if (result.status === 'success') {
            $('#emailFeedback').css('color', 'green');
            $('.email').addClass('is-valid');
          } else {
            $('#emailFeedback').css('color', 'red');
            $('.email').addClass('is-invalid');
          }
        });
      }
    });

    $('.username').on('input', function () {
      let username = $(this).val();
      if (username === '') {
        $('#usernameFeedback').css('', '');
        $('.username').removeClass('is-invalid');
        $('.username').removeClass('is-valid');
      } else {
        $.post('check-username', {
          username: username
        }, function (data) {
          let result = JSON.parse(data);

          // Menampilkan feedback
          $('#usernameFeedback').text(result.message);

          // Mengubah warna teks berdasarkan status
          if (result.status === 'success') {
            $('#usernameFeedback').css('color', 'green');
            $('.username').addClass('is-valid');
          } else {
            $('#usernameFeedback').css('color', 'red');
            $('.username').addClass('is-invalid');
          }
        });
      }
    });

    $(document).on('click', '.saves', function () {
      let data = $('#nambah_akun').serialize();

      $.ajax({
        method: "POST",
        url: "<?= route_to('create-account'); ?>",
        data: data,
        success: function (response) {

          $('#add_accounts').modal('hide');
          $('#nambah_akun')[0].reset();

          alertify.set('notifier', 'position', 'bottom-right');
          let responseString = JSON.stringify(response);
          if(responseString.indexOf("failed") !== -1) {
            alertify.error(response.status);
          } else{
            alertify.success(response.status);
          }
        }
      });
    });
  });


</script>
<?= $this->endSection();?>