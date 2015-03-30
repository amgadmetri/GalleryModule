@extends('app')
@section('content')
<div class="container">
	<div class="col-sm-9">

		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Gallery name</th>
				
				<th>Caption</th>
				<th>Type</th>
				<th>Preview</th>
				<th>Options</th>
			</tr>
			@foreach($galleries as $gallery)
			<tr>
				<th>{{ $gallery->id }}</th>
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
			{!! $galleries->render() !!}
	</div>
</div>
@stop