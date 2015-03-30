@extends('app')
@section('content')
<div class="container">
	<div class="col-sm-8">
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		@if (Session::has('message'))
		<div class="alert alert-success">
			<ul>
				<li>{{ Session::get('message') }}</li>
			</ul>
		</div>
		@endif

		<form method="post" id="album">
			<input name="_token" type="hidden" value="{{ csrf_token() }}">

			<div class="form-group">
				<label for="album_name">Album Name</label>
				<input 
				type="text" 
				class="form-control" 
				name="album_name" 
				value="{{ old('album_name') }}" 
				placeholder="Album name.." 
				aria-describedby="sizing-addon2"
				>
			</div>

			<div class="form-group" id="insertedGalleries">
				<label for="album_name">Galleries</label>
				
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary form-control">Add Album</button>
			</div>
			
		</form>
	</div>
	<div class="col-sm-2">
		<label for="album_name">Choos Galleries</label>
		@include('gallery::parts.modals.mediamodal')
	</div>
</div>
<script src="{{ asset('assets/js/album/addalbumgalleries.js') }}"></script>
@stop