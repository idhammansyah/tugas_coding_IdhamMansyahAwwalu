<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>
<div class="section dashboard">
<?php echo session_notif(); ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">Edit events - <?= $events['title_events']; ?></div>
        <form action="<?= site_url('4/update-events/'.$events['id_events'])?>" method="post">
          <div class="card-body">
            <input type="hidden" value="<?= $events['id_events']?>" name="events">

            <div class="mb-3">
              <label>Title Events</label>
              <input type="text" name="title" class="form-control" value="<?= $events['title_events']?>" placeholder="Insert Title Events">
            </div>

            <div class="mb-3">
              <label>Date Events</label>
              <input type="date" class="form-control" name="date_events" value="<?= $events['start_date']?>">
            </div>

            <div class="mb-3">
              <label>Notes Event</label>
              <textarea class="form-control" id="notes" name="notes" placeholder="Leave a comment here"><?= $events['notes_events']?></textarea>
            </div>
            <script>
              CKEDITOR.replace('notes', {
                extraPlugins: 'editorplaceholder',
                editorplaceholder: 'Explain the events',
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
            </script>
            
          </div>
          <div class="card-footer">
            <button class="btn btn-primary"><i class="bi bi-floppy"></i>&nbsp; Update Event</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection();?>
<?= $this->section('scripts'); ?>
<?= $this->endSection();?>