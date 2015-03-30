@extends('app')
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

		<div align="center">
			<h3>{{ $gallery->file_name }}</h3>

			@if ($gallery->type == 'photo')
				<img width="412" height="315" src='{{ $gallery->path }}' alt="{{ $gallery->caption }}"/><br>
				<b>Thumbnails</b>
				<br>

				<div class="row">
					@foreach($gallery->thumbnails as $thumbnail)
					<div class="col-sm-2 col-md-2">
						<img src='{{ $thumbnail->path }}' alt="{{ $thumbnail->caption }}" width="100" height="100" >
						<div class="caption">
							<h3>{{ $thumbnail->thumb_name }}</h3>
							<p>{{ $thumbnail->width }} X {{ $thumbnail->height }}</p>
							<p>
								<a class="btn btn-default" href='{{ url("/gallery/thumbnail/delete/$thumbnail->id") }}' role="button">Delete</a>
							</p>
						</div>
					</div>
					@endforeach
				</div>

				<br><b>{{ $gallery->caption }}</b><br>

				@include('gallery::parts.thumbnails.cropform')
				@include('gallery::parts.thumbnails.resizeform')

			@else
				<iframe width="412" height="315" src="{{ $gallery->path }}" frameborder="0" allowfullscreen></iframe>
				<br><b>{{ $gallery->caption }}</b><br>
				<img src='http://img.youtube.com/vi/{{$gallery->video_path}}/0.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
				<img src='http://img.youtube.com/vi/{{$gallery->video_path}}/1.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
				<img src='http://img.youtube.com/vi/{{$gallery->video_path}}/2.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
				<img src='http://img.youtube.com/vi/{{$gallery->video_path}}/3.jpg' alt="{{ $gallery->caption }}" width="100" height="100">
			@endif
			<br>
		</div>
	</div>
</div>
@stop