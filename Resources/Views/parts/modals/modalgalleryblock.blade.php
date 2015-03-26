<div class="col-xs-12 col-md-12" id="galleryContent">
	@foreach($galleries as $gallery)
	<div class="col-xs-6 col-md-4">
		<div class="thumbnail">
			<a href="#" id="galleryLink">
				<input name="gallery" type="checkbox" id="gallery" value="{{ $gallery->id }}">
				{{ $gallery->type }}
				@if ($gallery->type == 'photo')
				<img width="149" height="149" src='{{ $gallery->path }}' alt="{{ $gallery->caption }}"/>
				@else
				<img width="149" height="149" src='http://img.youtube.com/vi/{{$gallery->video_path}}/0.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
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
	<div class="col-xs-12 col-md-12">
		<nav>
			<ul class="pager">
				<li class="previous">
					<a href="{{  $galleries->previousPageUrl() }}" id="mediaLibraryPrevious">
						<span aria-hidden="true">&larr;</span> Previous
					</a>
				</li>
				<li class="next">
					<a href="{{  $galleries->nextPageUrl() }}" id="mediaLibraryNext">
						Next <span aria-hidden="true">&rarr;</span>
					</a>
				</li>
			</ul>
		</nav>
		<button type="button" id="media_form_submit" class="btn btn-primary btn-block" data-dismiss="modal">Insert Galleries</button>
	</div>
</div>