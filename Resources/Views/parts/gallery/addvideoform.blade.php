<form class="col-sm-12" method="post" id="{{ $medialibraryName }}form_ajax_video" action="{{ url('admin/gallery/createvideo') }}" >
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
	<input name="select" type="hidden" value="{{ $select }}">
	<input name="mediaType" type="hidden" value="{{ $type }}">
	<input name="perPage" type="hidden" value="{{ $perPage }}">
	<input name="medialibraryName" type="hidden" value="{{ $medialibraryName }}">
	
	<div class="form-group">
		<label for="file_name">Video Name</label>
		<input 
		type             ="text" 
		class            ="form-control" 
		name             ="file_name" 
		value            ="{{ old('file_name') }}" 
		placeholder 	 ="Add video name here .." 
		aria-describedby ="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="path">Video URL</label>
		<input 
		type             ="text" 
		class            ="form-control" 
		name             ="path" 
		value            ="{{ old('path') }}" 
		placeholder      ="Video URL here .." 
		aria-describedby ="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="caption">Video Caption</label>
		<input 
		type             ="text" 
		class            ="form-control" 
		name             ="caption" 
		value            ="{{ old('caption') }}" 
		placeholder      ="Add Caption here .." 
		aria-describedby ="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="type">File Type</label>
		<select name="type" class="form-control">
			<option disabled value="photo">Photo</option>
			<option selected value="video">Video</option>
		</select> 
	</div>
	
	<button type="submit" class="btn btn-primary form-control">Add Video</button>
</form>
