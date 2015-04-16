<script type="text/javascript">
/**
 * Select and unselect galleries.
 */
 $(document).on('click', 'a#{{ $medialibraryName }}galleryLink', function(){

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
 var {{ $medialibraryName }} = {
  init    : function (listner) {
    {{ $medialibraryName }}.prepare();
    {{ $medialibraryName }}.events(listner);
  },

  prepare : function () {
    {{ $medialibraryName }}.saveButtonId = '#{{ $medialibraryName }}media_form_submit';
  },

  events  : function (listner) {

    $(document).on('click', {{ $medialibraryName }}.saveButtonId, function () {

      checkedValues = $('#{{ $medialibraryName }}gallery:checked').map(function () {
        return this.value;
      }).get();

      listner(checkedValues);

    });

  }
};
</script>