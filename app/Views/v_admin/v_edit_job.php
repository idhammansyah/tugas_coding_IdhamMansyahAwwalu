<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>

<?php echo session_notif(); ?>
<section class="section dashboard">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h4 class="card-header">
          Edit Job
        </h4>
        <form action="<?= base_url('4/update-job/'.$jobs['uid_hash']); ?>" method="post">
          <div class="card-body">

            <!-- <input type="hidden" name="uid_hash" value="<?= $jobs['uid_hash']; ?>"> -->

            <div class="row mb-3">
              <div class="col">
                <label for="Company">Company</label>
                <select class="form-select select2-hidden-accessible" name="id_company" tabindex="-1" aria-hidden="true"
                  id="company" style="width: 100%;">
                  <option value="">-- Pilih Salah Satu --</option>
                  <?php foreach($company as $c) : ?>
                    <option value="<?= $c['id_company']?>" <?= $jobs['id_company'] == $c['id_company'] ? 'selected':''?>>
                      <?= $c['company_name']?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
  
              <div class="col">
                <label for="department">Department</label>
                <select class="form-select select2-hidden-accessible" name="id_department" tabindex="-1" aria-hidden="true"
                  id="department" style="width: 100%;">
                  <option value="">-- Pilih Salah Satu --</option>
                  <?php foreach($dept as $dep) :?>
                    <option value="<?= $dep['id_dept']?>" <?= $jobs['id_department'] == $dep['id_dept'] ? 'selected':''?>>
                      <?= $dep['department_name']?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
  
            <div class="row mb-3">
              <div class="col">
                <label for="level">Level</label>
                <select class="form-select select2-hidden-accessible" name="id_level" tabindex="-1" aria-hidden="true"
                  id="level" style="width: 100%;">
                  <option value="">-- Pilih Salah Satu --</option>
                  <?php foreach($level as $lvl) :?>
                    <option value="<?= $lvl['id_level']?>" <?= $jobs['id_level'] == $lvl['id_level'] ? 'selected':''?>>
                      <?= $lvl['level_name']?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
  
              <div class="col">
                <label for="position">Position</label>
                <select class="form-select select2-hidden-accessible" name="id_position" tabindex="-1" aria-hidden="true"
                  id="position" style="width: 100%;">
                  <option value="">-- Pilih Salah Satu --</option>
                  <?php foreach($position as $pos) :?>
                    <option value="<?= $pos['id_position']?>" <?= $jobs['id_position'] == $pos['id_position'] ? 'selected':''?>>
                      <?= $pos['position_name']?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
  
            <div class="row mb-3">
              <div class="col">
                <label for="contract">Contract Type</label>
                <select class="form-select select2-hidden-accessible" name="id_contracts" tabindex="-1" aria-hidden="true"
                  id="contract" style="width: 100%;">
                  <option value="">-- Pilih Salah Satu --</option>
                  <?php foreach($contract as $cr) :?>
                    <option value="<?= $cr['id_contract']?>" <?= $jobs['id_contracts'] == $cr['id_contract'] ? 'selected':''?>>
                      <?= $cr['contract_name']?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
  
              <div class="col">
                <label for="location">Location</label>
                <select class="form-select select2-hidden-accessible" name="id_location" tabindex="-1" aria-hidden="true"
                  id="location" style="width: 100%;">
                  <option value="">-- Pilih Salah Satu --</option>
                  <?php foreach($location as $loc) :?>
                    <option value="<?= $loc['id_location']?>" <?= $jobs['id_location'] == $loc['id_location'] ? 'selected':''?>>
                      <?= $loc['location_name']?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
  
            <div class="mb-3">
              <label for="judul">Job Description Information</label>
              <textarea id="content" name="job_content" class="form-control"
                placeholder="Explain the content here"><?= $jobs['job_content']?></textarea>
            </div>
  
            <div class="row mb-3">
              <div class="col">
                <label for="">Open Job</label>
                <input type="text" id="openjob" class="form-control" placeholder="Start date open this job"
                  name="opening_at">
              </div>

              <div class="col">
                <label for="">Closed Job</label>
                <input type="text" id="closedjob" class="form-control" placeholder="End date close this job"
                  name="closed_at" value="">
              </div>
            </div>
  
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary" id="save"><i class="bi bi-floppy"></i>&nbsp; Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
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

  <?php 
    $tanggal_buka = $jobs['opening_at'];
    $tanggal_tutup = $jobs['closed_at'];

    $format_buka = date('d-m-Y', strtotime($tanggal_buka));
    $format_tutup = date('d-m-Y', strtotime($tanggal_tutup));
  ?>

  let tanggalan_buka = "<?php echo $format_buka; ?>";
  $('#openjob').val(tanggalan_buka);
  let tanggalan_tutup = "<?php echo $format_tutup; ?>";
  $('#closedjob').val(tanggalan_tutup);

});
</script>
<?= $this->endSection();?>