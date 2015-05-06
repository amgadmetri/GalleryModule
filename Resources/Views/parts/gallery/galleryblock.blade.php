<div class="col-xs-12 col-md-12" id="galleryContent">
	@foreach($insertedGalleries as $gallery)
	<div class="col-xs-6 col-md-4">
		<div class="thumbnail">
			<input name="gallery_ids[]" type="hidden" id="gallery_id" value="{{ $gallery->id }}">
			@if ($gallery->type == 'photo')
				<img width="149" height="149" src='{{ $gallery->path }}' alt="{{ $gallery->caption }}"/>
			@else
				<img width="149" height="149" src='http://img.youtube.com/vi/{{$gallery->video_path}}/0.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
			@endif
			<div class="caption" align="center">
				<p>
					<h4>{{ $gallery->caption }}</h4>
					@if(\AclRepository::can('show', 'Galleries'))
						<a href='{{ url("/gallery/preview/$gallery->id") }}' target="_blank">Preview</a>
					@endif
				</p>
			</div>
		</div>
	</div>
	@endforeach
</div>