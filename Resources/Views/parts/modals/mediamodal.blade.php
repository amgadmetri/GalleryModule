<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediaModal">
	Media Library
</button>

<!-- Modal -->

<div class="modal fade bs-example-modal-lg"  id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Media</h4>
			</div>

			<div class="modal-body">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">All Galleries</a></li>
						<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Add Gallery</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">

							<form id="media_form">
								<div class="row">

									{!!$galleryBlock !!}

								</div>
							</form>
						</div>

						<div role="tabpanel" class="tab-pane" id="profile">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

								<div class="alert alert-warning" id="messageContainer">
									<ul>
									</ul>
								</div>

								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Add Photo
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											@include('gallery::parts.gallery.addphotoform')
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Add Video
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
										<div class="panel-body">
											@include('gallery::parts.gallery.addvideoform')
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>
<script src="{{ asset('assets/js/medialibrary/ajax-handlers/modalajaxhandler.js') }}"></script>
<script src="{{ asset('assets/js/medialibrary/ajax-handlers/paginationmodalajaxhandler.js') }}"></script>
<script src="{{ asset('assets/js/medialibrary/medialibrary.js') }}"></script>