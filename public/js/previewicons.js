$(document).on('click', '.icon-preview', function() {
  $bootbox.hide();
  $this = $(this);
  fapicker({
    iconUrl: base_url + 'public/vendors/font-awesome/metadata/icons.yml',
    onSelect: function (elm) {
      $bootbox.show();
      var icon_class = $(elm).data('icon');
      $this.find('i').removeAttr('class').addClass(icon_class);
      $this.parent().find('[name="icon_class"]').val(icon_class);
    },
    onClose: function() {
      $bootbox.show();
    }
  });
});