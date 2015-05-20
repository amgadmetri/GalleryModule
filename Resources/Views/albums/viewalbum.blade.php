@extends('app')
@section('content')
<div class="container">
	<div class="col-sm-9">

		<table class="table table-striped">
			<tr>
				<th>ID</th>
				<th>Album name</th>
				<th>Options</th>
			</tr>
			@foreach($albums as $album)
				<tr>
					<th>{{ $album->id }}</th>
					<th>{{ $album->album_name }}</th>
					<th>
						@if(\CMS::permissions()->can('show', 'Albums'))
							<a 
							class="btn btn-default" 
							href='{{ url("admin/gallery/album/show/$album->id") }}'
							role="button">
							galleries
							</a> 
						@endif
						@if(\CMS::permissions()->can('edit', 'Albums'))
							<a 
							class ="btn btn-default" 
							href  ='{{ url("admin/gallery/album/edit/$album->id") }}'
							role  ="button">
							Edit
							</a>
						@endif
						@if(\CMS::permissions()->can('delete', 'Albums'))
							<a 
							class ="btn btn-default" 
							href  ='{{ url("admin/gallery/album/delete/$album->id") }}'
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
						href="{{ $albums->previousPageUrl() }}"
						@if($albums->previousPageUrl() == null)
							class="btn disabled" role="button"
						@endif
						>
							<span aria-hidden="true">&larr;</span> Previous
						</a>
					</li>
					<li class="next">
						<a 
						href="{{ $albums->nextPageUrl() }}"
						@if($albums->nextPageUrl() == null)
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