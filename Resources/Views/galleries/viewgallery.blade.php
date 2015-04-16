@extends('app')
@section('content')
<div class="container">
	<div class="col-sm-3">
		{!! $mediaLibrary !!}
	</div>
	<div class="col-sm-9">
		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Gallery</th>
				<th>name</th>
				<th>Caption</th>
				<th>Type</th>
				<th>Preview</th>
				<th>Options</th>
			</tr>
			@foreach($galleries as $gallery)
			<tr>
				<th>{{ $gallery->id }}</th>
				<th><img src="{{ $gallery->path }}" width="70" height="70"></th>
				<th>{{ $gallery->file_name }}</th>
				<th>{{ $gallery->caption }}</th>
				<th>{{ $gallery->type }}</th>
				<th>
					<a class="btn btn-default" href='{{ url("/gallery/preview/$gallery->id") }}'role="button">View</a> 
				</th>
				<th>
					<a class="btn btn-default" href='{{ url("/gallery/updategallery/$gallery->id") }}' role="button">Edit</a> 
					<a class="btn btn-default" href='{{ url("/gallery/delete/$gallery->id") }}' role="button">Delete</a> 
				</th>
			</tr>
			@endforeach
		</table>
		<div class="col-xs-12 col-md-12">
			<nav>
				<ul class="pager">
					<li class="previous">

						<a 
						href="{{ $galleries->previousPageUrl() }}"
						@if($galleries->previousPageUrl() == null)
						class="btn disabled" role="button"
						@endif
						>
							<span aria-hidden="true">&larr;</span> Previous
						</a>
					</li>
					<li class="next">
						<a 
						href="{{ $galleries->nextPageUrl() }}"
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