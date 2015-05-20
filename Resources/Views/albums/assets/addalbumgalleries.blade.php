<script type="text/javascript">
	$(document).ready(function () {

		url     = '{{ url("admin/gallery/album/addalbumgalleries") }}';
		mediaLibrary.init(function(checkedValues)
		{
			$.ajax({
				url         : url,
				type        : 'GET',
				data        : {'ids': checkedValues},
				success     : function(data)
				{
					$('#insertedGalleries').empty().append(data);
				}
			});
		});
	});
</script>
