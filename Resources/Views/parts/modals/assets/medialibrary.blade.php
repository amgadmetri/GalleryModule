<script type="text/javascript">
/**
 * Select and unselect galleries.
 */
 $(document).on('click', 'a#galleryLink', function(){

  selcetedGallery = $(this).find("input[type=checkbox]");

  if( ! selcetedGallery.val())
  {
    selcetedGallery = $(this).find("input[type=radio]");
  }

  if(selcetedGallery.prop('checked')) 
  {
    selcetedGallery.prop('checked', false);
  }
  else
  {
    selcetedGallery.prop('checked', true);
  };

});

/**
 * Media library object that accept listner
 * to return selected values of galleries
 * to that listner.
 */
 var mediaSelectedIds = {
  init: function (listner) {
    mediaSelectedIds.prepare();
    mediaSelectedIds.events(listner);
  },

  prepare: function () {
    mediaSelectedIds.saveButtonId = '#media_form_submit';
  },

  events: function (listner) {

    $(document).on('click', mediaSelectedIds.saveButtonId, function () {

      checkedValues = $('#gallery:checked').map(function () {
        return this.value;
      }).get();

      listner(checkedValues);

    });

  }
};
</script>