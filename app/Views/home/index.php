<?= $this->extend('home/navbar/navbar');?>
<?= $this->section('content');?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
          <a href="<?= base_url('/')?>" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">LMS APPS ABHATI GROUP</span>
          </a>
        </div><!-- End Logo -->

        <div class="card mb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
              <br>
            </div>

            <?= session_notif(); $validation->listErrors();?>
            <form action="<?= base_url('login') ?>" method="post" class="row g-3 needs-validation" novalidate>

              <div class="col-12">
                <label for="yourUsername" class="form-label">Email or Username</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <i id="icon" class="bi bi-person-circle"></i>
                  </span>
                  <input type="text" name="username" value="<?= old('username')?>" class="form-control users"
                    id="yourUsername" placeholder="Email or Username" required>
                  <div class="invalid-feedback">Please enter your email or username.</div>
                </div>
              </div>

              <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <i class="bi bi-lock-fill"></i>
                  </span>
                  <input type="password" name="password_hash" class="form-control" id="yourPassword"
                    placeholder="Password" required>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>
              </div>

              <div class="col-12">
                <!-- <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div> -->
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Login</button>
              </div>
            </form>

            <div class="row g-1">
              <div class="col-12 g-3">
                <p class="text-center small mb-0">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#lupa_password">Forgot Password?</a>
                </p>
              </div>
              <div class="col-12 g-3">
                <p class="small mb-0 text-center">Don't have account?
                  <a href="#" data-bs-toggle="modal" data-bs-target="#create_account">Create an account
                  </a>
                </p>
              </div>
            </div>

          </div>
        </div>

        <div class="credits">
          <a href="https://www.abhatigroup.com">LMS &copy; <?= date('Y') ?></a>
        </div>

      </div>
    </div>
  </div>

</section>
<!-- End #main -->

<!-- forgot password -->
<div class="modal fade" id="lupa_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Forgot password ?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
          <input type="email" class="form-control email_lupa" id="floatingInput" placeholder="name@example.com"
            name="email">
          <label for="floatingInput">Email address</label>
        </div>
        <span id="email_lupa" class="fw-bold info" style="color:#fc6d80"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary forgot_password">Send Email</button>
      </div>
    </div>
  </div>
</div>

<!-- create account -->
<div class="modal fade" id="create_account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
          <input type="email" class="form-control email" id="floatingInput" placeholder="Email">
          <label for="floatingInput">Email address</label>
          <span id="emailFeedback"></span>
        </div>

        <div class="form-floating mb-3">
          <input type="text" class="form-control username" id="floatingInput" placeholder="Username">
          <label for="floatingInput">Username</label>
          <span id="usernameFeedback"></span>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control password" id="floatingInput" placeholder="Password">
          <label for="floatingInput">Password</label>
        </div>

        <!-- <div class="form-floating mb-3">
          <select class="form-select company" id="floatingSelect" aria-label="Floating label select example">
            <option selected>-- Choose Company --</option>
            <?php foreach($company as $cp) :?>
            <option value="<?= $cp['id_company']?>"><?= $cp['company_name']?></option>
            <?php endforeach; ?>
          </select>
          <label for="floatingSelect">Choose your company</label>
        </div> -->

        <!-- <div class="form-floating mb-3">
          <select class="form-select dept" id="floatingSelect" aria-label="Floating label select example">
            <option selected>-- Choose Department --</option>
            <?php foreach($dept as $dp) :?>
            <option value="<?= $dp['id_dept']?>"><?= $dp['department_name']?></option>
            <?php endforeach; ?>
          </select>
          <label for="floatingSelect">Choose your department</label>
        </div> -->

        <div class="form-floating mb-3">
          <select class="form-select gender" id="floatingSelect" aria-label="Floating label select example">
            <option selected>-- Choose one --</option>
            <option value="1">Man</option>
            <option value="0">Woman</option>
          </select>
          <label for="floatingSelect">Choose your gender</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saves">Submit Data</button>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection();?>
<?= $this->section('scripts');?>
<script text="text/javascript">
  $(document).ready(function () {
    // create account
    $(document).on('click', '.saves', function () {
      let data = {
        'email': $('.email').val(),
        'username': $('.username').val(),
        'password': $('.password').val(),
        // 'company': $('.company').val(),
        // 'department': $('.dept').val(),
        'gender': $('.gender').val(),
      };

      $.ajax({
        method: "POST",
        url: "<?= route_to('create-account'); ?>",
        data: data,
        success: function (response) {

          $('#create_account').modal('hide');
          $('#create_account').find('input').val('');
          $('.email').removeClass('is-valid');
          $('.username').removeClass('is-valid');

          alertify.set('notifier', 'position', 'top-right');
          alertify.success(response.status);
        }
      });
    });

    // forgot password
    $(document).on('click', '.forgot_password', function () {
      if ($.trim($('.email_lupa').val()).length == 0) {
        email_lupa = "Mohon masukkan email kamu!";
        $('#email_lupa').text(email_lupa);
        $('.email_lupa').addClass('is-invalid');
      } else {
        email_lupa = "";
        $('#email_lupa').text(email_lupa);
        $('.email_lupa').addClass('');
      }

      if (email_lupa != "") {
        return false;
      } else {
        let data = {
          'email': $('.email_lupa').val()
        };

        $.ajax({
          method: "POST",
          url: "<?= route_to('forgot-password'); ?>",
          data: data,
          success: function (response) {

            $('#lupa_password').modal('hide');
            $('#lupa_password').find('input').val('');

            alertify.set('notifier', 'position', 'top-right');
            alertify.success(response.status);
          }
        });
      }
    });

    $(document).on('input', '.users', function () {
      let inputValue = $(this).val();

      // Periksa apakah karakter '@' ada dalam input
      if (inputValue.includes('@') && (inputValue.includes('.com') || inputValue.includes('.co.id'))) {
        // Jika ada, ubah ikon menjadi ikon email
        $('#icon').removeClass('bi bi-person-circle').addClass('bi bi-envelope');
      } else {
        // Jika tidak, kembalikan ikon ke ikon awal
        $('#icon').removeClass('bi bi-envelope').addClass('bi bi-person-circle');
      }
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

    $('.table').DataTable();
  });
</script>
<?= $this->endSection();?>