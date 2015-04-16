<div class="col-xs-12 col-md-12" id="galleryContent">
	@if($galleries)
		@foreach($galleries as $gallery)
			<div class="col-xs-6 col-md-4">
				<div class="thumbnail">
					<a href="#" id="{{ $medialibraryName }}galleryLink">

						@if($single)
						<input name="gallery" type="radio" id="{{ $medialibraryName }}gallery" value="{{ $gallery->id }}">
						@else
						<input name="gallery" type="checkbox" id="{{ $medialibraryName }}gallery" value="{{ $gallery->id }}">
						@endif
						
						{{ $gallery->type }}
						
						@if ($gallery->type == 'photo')
						<img width="149" height="149" src='{{ $gallery->path }}' alt="{{ $gallery->caption }}"/>
						@else
						<img width="149" height="149" src='http://img.youtube.com/vi/{{ $gallery->video_path }}/0.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
						@endif
					</a>
					<div class="caption" align="center">
						<p><h4>{{ $gallery->caption }}</h4>
							<a href='{{ url("/gallery/preview/$gallery->id") }}' target="_blank">Preview</a>
						</p>
					</div>
				</div>
			</div>
		@endforeach
	@else
		@foreach($albums as $album)
			<div class="col-xs-6 col-md-4">
				<div class="thumbnail">
					<a href="#" id="{{ $medialibraryName }}galleryLink">

						@if($single)
						<input name="gallery" type="radio" id="{{ $medialibraryName }}gallery" value="{{ $album->id }}">
						@else
						<input name="gallery" type="checkbox" id="{{ $medialibraryName }}gallery" value="{{ $album->id }}">
						@endif
						
						{{ $album->album_name }}
						
						<img width="149" height="149" src='{{ $album->galleries[0]->path }}' alt="{{ $album->galleries[0]->caption }}"/>
					</a>
					<div class="caption" align="center">
						<p><h4>{{ $album->album_name }}</h4>
							<a href='{{ url("/gallery/album/preview/$album->id") }}' target="_blank">Preview</a>
						</p>
					</div>
				</div>
			</div>
		@endforeach
	@endif
	<div class="col-xs-12 col-md-12">
		@if($galleries)
			<nav>
				<ul class="pager">
					<li class="previous">
						<a 
						href = "{{ $galleries->previousPageUrl() }}" 
						id   = "mediaLibraryPrevious"
						@if($galleries->previousPageUrl() == null)
						class="btn disabled" role="button"
						@endif
						>
							<span aria-hidden="true">&larr;</span> Previous
						</a>
					</li>
					<li class="next">
						<a 
						href = "{{ $galleries->nextPageUrl() }}" 
						id   = "mediaLibraryNext"
						@if($galleries->nextPageUrl() == null)
						class="btn disabled" role="button"
						@endif
						>
							Next <span aria-hidden="true">&rarr;</span>
						</a>
					</li>
				</ul>
			</nav>
		@else
			<nav>
				<ul class="pager">
					<li class="previous">
						<a 
						href = "{{ $albums->previousPageUrl() }}" 
						id   = "mediaLibraryPrevious"
						@if($albums->previousPageUrl() == null)
						class="btn disabled" role="button"
						@endif
						>
							<span aria-hidden="true">&larr;</span> Previous
						</a>
					</li>
					<li class="next">
						<a 
						href = "{{ $albums->nextPageUrl() }}" 
						id   = "mediaLibraryNext"
						@if($albums->nextPageUrl() == null)
						class="btn disabled" role="button"
						@endif
						>
							Next <span aria-hidden="true">&rarr;</span>
						</a>
					</li>
				</ul>
			</nav>
		@endif
		<button type="button" id="{{ $medialibraryName }}media_form_submit" class="btn btn-primary btn-block" data-dismiss="modal">Insert Galleries</button>
	</div>
</div>