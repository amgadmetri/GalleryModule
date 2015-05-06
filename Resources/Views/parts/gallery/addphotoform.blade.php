<form class="col-sm-12" method="post" id="{{ $medialibraryName }}form_ajax_photo" action="{{ url('gallery/createphoto') }}" enctype="multipart/form-data">
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
	<input name="path" type="hidden" value="{{ url('1') }}">
	<input name="single" type="hidden" value="{{ $single ? 'true' : 'false' }}">
	<input name="mediaType" type="hidden" value="{{ $type }}">
	<input name="medialibraryName" type="hidden" value="{{ $medialibraryName }}">

	<div class="form-group">
		<label for="file_name">Photo Name</label>
		<input 
		type             ="text" 
		class            ="form-control" 
		name             ="file_name" 
		value            ="{{ old('file_name') }}" 
		placeholder      ="Add file name here .." 
		aria-describedby ="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="caption">Caption</label>
		<input 
		type             ="text" 
		class            ="form-control" 
		name             ="caption" 
		value            ="{{ old('caption') }}" 
		placeholder      ="Add file name here .." 
		aria-describedby ="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="type">File Type</label>
		<select name="type" class="form-control">
			<option selected value="photo">Photo</option>
			<option disabled value="video">Video</option>
		</select> 
	</div>
	<div class="form-group">
		<label for="image">File input</label>
		<input name="image" type="file" id="image">
	</div>
	<button type="submit" class="btn btn-primary form-control">Add Photo</button>
</form>
