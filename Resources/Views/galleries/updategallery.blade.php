@extends('core::app')
@section('content')
<div class="container">
	<div class="col-sm-9">
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

		<form method="post" accept-charset="UTF-8" enctype="multipart/form-data">
			<input name="_token" type="hidden" value="{{ csrf_token() }}">
			<input name="path" type="hidden" value="{{ $gallery->path }}">
			<input name="type" type="hidden" value="{{ $gallery->type }}">

			<div class="form-group">
				<label for="file_name">Photo Name</label>
				<input 
				type="text" 
				class="form-control" 
				name="file_name" 
				value="{{$gallery->file_name }}" 
				placeholder="Add file name here .." 
				aria-describedby="sizing-addon2"
				>
			</div>

			<div class="form-group">
				<label for="caption">Caption</label>
				<input 
				type="text" 
				class="form-control" 
				name="caption" 
				value="{{ $gallery->caption }}" 
				placeholder="Add file name here .." 
				aria-describedby="sizing-addon2"
				>
			</div>

			<button type="submit" class="btn btn-primary form-control">Update Photo</button>
		</form>
	</div>
</div>
@stop