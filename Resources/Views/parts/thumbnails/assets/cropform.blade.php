<script type="text/javascript">
  (function ($) {
    
    $('#target').Jcrop({
      onSelect: showCoords 
    });

    function showCoords(c)
    {
      form = $('form#crop_form');
      form.find("input[name=x]").val(c.x)
      form.find("input[name=y]").val(c.y)
      form.find("input[name=width]").val(c.w)
      form.find("input[name=height]").val(c.h)
    };

  }(jQuery));
</script>