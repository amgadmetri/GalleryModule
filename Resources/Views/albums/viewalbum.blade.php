@extends('app')
@section('content')
<div class="container">
	<div class="col-sm-9">

		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Album name</th>
				<th>Preview</th>
				<th>Options</th>
			</tr>
			@foreach($albums as $album)
			<tr>
				<th>{{ $album->id }}</th>
				<th>{{ $album->album_name }}</th>
				<th>
					<a class="btn btn-default" href='{{ url("/gallery/album/preview/$album->id") }}'role="button">View</a> 
				</th>
				<th>
					<a class="btn btn-default" href='{{ url("/gallery/album/update/$album->id") }}'role="button">Edit</a> 
					<a class="btn btn-default" href='{{ url("/gallery/album/delete/$album->id") }}'role="button">Delete</a> 
				</th>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@stop