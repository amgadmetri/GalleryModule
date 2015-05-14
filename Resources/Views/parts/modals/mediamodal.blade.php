<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{ $medialibraryName }}">
	Media Library
</button>

<!-- Modal -->

<div class="modal fade"  id="{{ $medialibraryName }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
						<li role="presentation" class="active"><a href="#all{{ $medialibraryName }}" aria-controls="#all{{ $medialibraryName }}" role="tab" data-toggle="tab">All Galleries</a></li>
						@if($galleries && \CMS::permissions()->can('add', 'Galleries'))
							<li role="presentation"><a href="#add{{ $medialibraryName }}" aria-controls="#add{{ $medialibraryName }}" role="tab" data-toggle="tab">Add Gallery</a></li>
						@endif
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="all{{ $medialibraryName }}">
							<form id="media_form">
								<div class="row">
									@include('gallery::parts.modals.modalgalleryblock')
								</div>
							</form>
						</div>

						<div role="tabpanel" class="tab-pane" id="add{{ $medialibraryName }}">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

								<div class="alert alert-warning" id="{{ $medialibraryName }}messageContainer">
									<ul>
									</ul>
								</div>

								@if ($type == 'photo' || $type == 'all')
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="photo{{ $medialibraryName }}">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#photocollapse{{ $medialibraryName }}" aria-expanded="true" aria-controls="photocollapse{{ $medialibraryName }}">
													Add Photo
												</a>
											</h4>
										</div>
										<div id="photocollapse{{ $medialibraryName }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="photo{{ $medialibraryName }}">
											<div class="panel-body">
												@include('gallery::parts.gallery.addphotoform')
											</div>
										</div>
									</div>
								@endif
								@if ($type == 'video' || $type == 'all')
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="video{{ $medialibraryName }}">
											<h4 class="panel-title">
												<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#videocollapse{{ $medialibraryName }}" aria-expanded="false" aria-controls="videocollapse{{ $medialibraryName }}">
													Add Video
												</a>
											</h4>
										</div>
										<div id="videocollapse{{ $medialibraryName }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="video{{ $medialibraryName }}">
											<div class="panel-body">
												@include('gallery::parts.gallery.addvideoform')
											</div>
										</div>
									</div>
								@endif
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
@include('gallery::parts.modals.assets.ajax-handlers.modalajaxhandler')
@include('gallery::parts.modals.assets.ajax-handlers.paginationmodalajaxhandler')
@include('gallery::parts.modals.assets.medialibrary')