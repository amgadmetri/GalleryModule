@extends('gallery::master')
@section('content')
<div class="container">
	<div class="col-sm-9">

		<table class="table table-striped">
			<tr class="info">
				<th>ID</th>
				<th>Album name</th>
				<th>Preview</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
			@foreach($albums as $album)
			<tr>
				<th>{{ $album->id }}</th>
				<th>{{ $album->album_name }}</th>
				<th>
					<a class="btn btn-success" href='{{ url("/gallery/preview/$album->id") }}' data-toggle="tooltip" data-placement="left" title="Preview">
						<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
					</a> 
				</th>
				<th>
					<a class="btn btn-primary" href='{{ url("/gallery/album/update/$album->id") }}' data-toggle="tooltip" data-placement="left" title="Edit">
						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</a> 
				</th>
				<th>
					<a class="btn btn-danger" href='{{ url("/gallery/album/delete/$album->id") }}' data-toggle="tooltip" data-placement="left" title="Delete">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a> 
				</th>
			</tr>
			@endforeach
			
		</table>

	</div>
</div>
@stop