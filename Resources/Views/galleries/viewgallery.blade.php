@extends('gallery::master')
@section('content')
<div class="container">
	<div class="col-sm-9">

		<table class="table table-striped">
			<tr class="info">
				<th>ID</th>
				<th>Gallery name</th>
				
				<th>Caption</th>
				<th>Type</th>
				<th>Preview</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
			@foreach($galleries as $gallery)
			<tr>
				<th>{{ $gallery->id }}</th>
				<th>{{ $gallery->file_name }}</th>
				
				<th>{{ $gallery->caption }}</th>
				<th>{{ $gallery->type }}</th>
				<th>
					<a class="btn btn-success" href='{{ url("/gallery/preview/$gallery->id") }}' data-toggle="tooltip" data-placement="left" title="Preview">
						<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
					</a> 
				</th>
				<th>
					<a class="btn btn-primary" href='{{ url("/gallery/updategallery/$gallery->id") }}' data-toggle="tooltip" data-placement="left" title="Edit">
						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</a> 
				</th>
				<th>
					<a class="btn btn-danger" href='{{ url("/gallery/delete/$gallery->id") }}' data-toggle="tooltip" data-placement="left" title="Delete">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a> 
				</th>
			</tr>
			@endforeach
			
		</table>
			{!! $galleries->render() !!}
	</div>
</div>
@stop