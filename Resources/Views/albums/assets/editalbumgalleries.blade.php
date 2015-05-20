<script type="text/javascript">
	$(document).ready(function () {

		url     = '{{ url("admin/gallery/album/editalbumgalleries", $album->id) }}';
		mediaLibrary.init(function(checkedValues)
		{
			$.ajax({
				url         : url,
				type        : 'GET',
				data        : {'ids': checkedValues},
				success     : function(data)
				{
					location.reload();
				}
			});
		});
	});
</script>
