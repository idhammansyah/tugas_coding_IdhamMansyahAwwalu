<?= $this->extend('v_admin/header/header');?>
<?= $this->section('page-content');?>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="<?= base_url();?>/img/<?= $profile['avatar']?>" alt="Profile" class="rounded-circle">
          <h2><?= $profile['username']; ?></h2>
          <h3><?= $profile['company_name'] . ' - ' . $profile['department_name']?></h3>
          <div class="social-links mt-2">
            <a href="mailto:<?= $profile['email']?>" class="mail"><i class="bi bi-envelope"></i></a>
            <!-- <a href="#" class="facebook"><i class="bi bi-facebook"></i></a> -->
            <!-- <a href="#" class="instagram"><i class="bi bi-instagram"></i></a> -->
            <!-- <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                aria-selected="true" role="tab">Overview</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false"
                role="tab" tabindex="-1">Edit Profile</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"
                aria-selected="false" role="tab" tabindex="-1">Change Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8"><?= $profile['nama_lengkap']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Company</div>
                <div class="col-lg-9 col-md-8"><?= $profile['company_name']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Department</div>
                <div class="col-lg-9 col-md-8"><?= $profile['department_name']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Place and Date of birth</div>
                <div class="col-lg-9 col-md-8"><?= $profile['tempat_lahir']?>, <?= date('d F Y', strtotime($profile['tanggal_lahir'])) ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?= $profile['email']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Role</div>
                <div class="col-lg-9 col-md-8"><?= $profile['role_name']?></div>
              </div>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

              <!-- Profile Edit Form -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="<?= base_url();?>/img/<?= $profile['avatar']?>" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                          class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                          class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $profile['nama_lengkap']?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="company" id="" class="form-select">
                      <?php foreach($company as $c) :?>
                        <option value="<?= $c['id_company']?>" <?= $profile['company_id'] == $c['id_company'] ? 'selected': ''?>><?= $c['company_name']?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Department</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="department" id="" class="form-select">
                      <?php foreach($department as $d) :?>
                        <option value="<?= $d['id_dept']?>" <?= $profile['department_id'] == $d['id_dept'] ? 'selected': ''?>><?= $d['department_name']?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control is-<?= $profile['status'] == 'verified' ? 'valid' : 'invalid'?>" id="Email" value="<?= $profile['email']?>" readonly>
                    <div class="<?=$profile['status'] == 'verified' ? 'valid' : 'invalid'?>-feedback">
                      <i class="bi bi-<?= $profile['status'] == 'verified' ? 'check' : 'x'?>"></i> &nbsp; <?=$profile['status'] == 'verified' ? 'Email is valid.' : 'Email is not verified yet.'?>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Place of Birth</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="tempat_lahir" type="text" class="form-control" value="<?= $profile['tempat_lahir']?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="dob" type="date" class="form-control"
                      value="<?= $profile['tanggal_lahir']; ?>">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
              <!-- Change Password Form -->
              <form>

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<script type="text/javascript">
  
</script>
<?= $this->endSection();?>