<?= $this->extend('home/navbar/navbar');?>

<?= $this->section('content');?>

<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Set New Password</h5>
                  <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    Hi, <b><?= $getAccount['username'];?>,</b>
                    <br>Please set your new <strong>password</strong>.
                  </div>
                </div>

                <form action="<?= base_url('ubah-passwords/'.$getAccount['id_user']);?>" method="post" class="row g-3 needs-validation"
                  novalidate>

                  <input type="hidden" value="<?= $getAccount['id_user']; ?>" name="uniques">

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Your new password</label>
                    <input type="password" name="password_hash" class="form-control" id="yourUsername" required placeholder="New Password">
                    <div class="invalid-feedback">Please enter your password.</div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Re-type Password</label>
                    <input type="password" name="re_type_password" placeholder="Re-type Password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please re-type password!</div>
                  </div>


                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Submit</button>
                  </div>

                  <div class="col-12">
                    <p class="small mb-0 text-center">
                      <a href="<?= base_url('/')?>">Back to login
                      </a>
                    </p>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
              <a href="https://www.abhatigroup.com">Abhati Group <?= date('Y') ?></a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main>
<!-- End #main -->


<?= $this->endSection();?>
<?= $this->section('scripts');?>
<?= $this->endSection();?>