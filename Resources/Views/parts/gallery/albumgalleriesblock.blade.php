<div class="col-xs-12 col-md-12" id="albumGalleryContent">
	@foreach($albumGalleries as $gallery)
		<div class="col-xs-6 col-md-4">
			<div class="thumbnail">
				<input name="gallery_ids[]" type="hidden" id="gallery_id" value="{{ $gallery->id }}">
				@if ($gallery->type == 'photo')
					<img width="149" height="149" src='{{ $gallery->path }}' alt="{{ $gallery->caption }}"/>
				@else
					<img width="149" height="149" src='http://img.youtube.com/vi/{{$gallery->video_path}}/0.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
				@endif
				<div class="caption" align="center">
					<p><h4>{{ $gallery->caption }}</h4>
						@if(\CMS::permissions()->can('show', 'Galleries'))
							<a 
							class  ="btn btn-default" 
							href   ='{{ url("admin/gallery/show/$gallery->id") }}' 
							target ="_blank"
							>Preview
							</a>
						@endif
						@if(\CMS::permissions()->can('delete', 'Albums'))
							<a 
							class  ="btn btn-default" 
							href   ='{{ url("admin/gallery/album/deletegallery", [$gallery->id, $album->id]) }}' 
							role   ="button">
							Delete
							</a>
						@endif
					</p>
				</div>
			</div>
		</div>
	@endforeach
</div>