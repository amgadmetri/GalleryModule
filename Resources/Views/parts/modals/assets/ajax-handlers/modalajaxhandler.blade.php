<script type="text/javascript">
	(function ($) {

		function newAddGalleryObj(){
			var addGallery = {
				init: function (formId) {
					addGallery.prepare(formId);
					addGallery.events();
				},

				prepare: function (formId) {
					addGallery.form               = $(formId);
					addGallery.messageContainer   = $('div#{{ $medialibraryName }}messageContainer');
					addGallery.messageContainerUl = addGallery.messageContainer.find("ul");
					addGallery.galleryContent     = $('div#{{ $medialibraryName }}galleryContent');
					addGallery.url                = addGallery.form.attr('action');
					
					addGallery.messageContainer.hide();
				},

				events: function () {
					addGallery.form.submit(function(e) {
						e.preventDefault();

						addGallery.messageContainer.show();
						addGallery.messageContainerUl.find("li").remove();

						addGallery.data = new FormData(addGallery.form[0]);  

						if(addGallery.form.find("select[name=type]").val() == 'photo')
							addGallery.data.append("file", addGallery.form.find("input[name=image]").prop("files")[0]);

						addGallery.ajaxAction();
					});
				},

				ajaxAction: function () 
				{
					$.ajax({
						url         : addGallery.url,
						data        : addGallery.data,
						type        : 'POST',
						processData : false,
						contentType : false,
						success: function(data)
						{
							addGallery.messageContainerUl.append('<li>Gallery created successfully.</li>')
							addGallery.galleryContent.empty();
							addGallery.galleryContent.append(data);

							setTimeout(function() {
								addGallery.messageContainer.fadeOut();
								addGallery.messageContainerUl.find("li").remove();
							}, 5000);
						},
						error: function(data, error, errorThrown)
						{
							$.each(JSON.parse(data.responseText), function(index, value){
								addGallery.messageContainerUl.append('<li>' + value + '</li>')
							});

							setTimeout(function() {
								addGallery.messageContainer.fadeOut();
								addGallery.messageContainerUl.find("li").remove();
							}, 5000);
						}
					});
				}
			}
			return addGallery;
		}

		$(document).ready(function (){

			var form_ajax_video =  newAddGalleryObj();
			form_ajax_video.init("#{{ $medialibraryName }}form_ajax_video");

			var form_ajax_photo =  newAddGalleryObj();
			form_ajax_photo.init("#{{ $medialibraryName }}form_ajax_photo");
		});

	}(jQuery));
</script>