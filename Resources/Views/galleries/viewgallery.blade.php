@extends('core::app')
@section('content')
<div class="container">
	<div class="col-sm-9">
		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Gallery</th>
				<th>name</th>
				<th>Caption</th>
				<th>Type</th>
				<th>Options</th>
			</tr>
			@foreach($galleries as $gallery)
			<tr>
				<th>{{ $gallery->id }}</th>
				@if ($gallery->type == 'photo')
					<th><img src="{{ $gallery->path }}" alt="{{ $gallery->caption }}" width="70" height="70"></th>
				@else
					<img src='http://img.youtube.com/vi/{{ $gallery->video_path }}/0.jpg' alt="{{ $gallery->caption }}" width="70" height="70">
				@endif
				<th>{{ $gallery->file_name }}</th>
				<th>{{ $gallery->caption }}</th>
				<th>{{ $gallery->type }}</th>
				<th>
					@if(\CMS::permissions()->can('show', 'Galleries'))
						<a 
						class ="btn btn-default" 
						href  ='{{ url("admin/gallery/show/$gallery->id") }}'
						role  ="button">
						View
						</a> 
					@endif
					@if(\CMS::permissions()->can('edit', 'Galleries'))
						<a 
						class ="btn btn-default" 
						href  ='{{ url("admin/gallery/edit/$gallery->id") }}' 
						role  ="button">
						Edit
						</a> 
					@endif
					@if(\CMS::permissions()->can('delete', 'Galleries'))
						<a 
						class ="btn btn-default" 
						href  ='{{ url("admin/gallery/delete/$gallery->id") }}' 
						role  ="button">
						Delete
						</a> 
					@endif
				</th>
			</tr>
			@endforeach
		</table>
		<div class="col-xs-12 col-md-12">
			<nav>
				<ul class="pager">
					<li class="previous">
						<a 
						href ="{{ $galleries->previousPageUrl() }}"
						@if($galleries->previousPageUrl() == null)
							class="btn disabled" role="button"
						@endif
						>
							<span aria-hidden="true">&larr;</span> Previous
						</a>
					</li>
					<li class="next">
						<a 
						href ="{{ $galleries->nextPageUrl() }}"
						@if($galleries->nextPageUrl() == null)
							class="btn disabled" role="button"
						@endif
						>
							Next <span aria-hidden="true">&rarr;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
@stop