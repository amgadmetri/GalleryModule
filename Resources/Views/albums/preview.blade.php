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

		<h3>Album : {{ $album->album_name }}</h3>
		@include('gallery::parts.gallery.albumgalleriesblock')
	</div>
	<div class="col-sm-2">
		<label for="album_name">Choos Galleries</label>
		{!! $mediaLibrary !!}
	</div>
</div>
@include('gallery::albums.assets.addalbumgalleries')
@stop