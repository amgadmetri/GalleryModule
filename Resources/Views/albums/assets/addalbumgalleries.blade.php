<script type="text/javascript">
	$(document).ready(function () {
		mediaSelectedIds.init(function(checkedValues)
		{
			$.ajax({
				url         : window.location,
				type        : 'GET',
				data        : {'ids': checkedValues},
				success     : function(data)
				{
					if (data === 'refresh')  location.reload();
					$('#insertedGalleries').empty().append(data);
				}
			});
		});
	});
</script>
