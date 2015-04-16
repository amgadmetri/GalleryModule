<form method="post" id="form_ajax_vedio" action="{{ url('gallery/createvideo') }}" >
	<input name="_token" type="hidden" value="{{ csrf_token() }}">
	<input name="single" type="hidden" value="{{ $single ? 'true' : 'false' }}">
	<input name="mediaType" type="hidden" value="{{ $type }}">
	<input name="medialibraryName" type="hidden" value="{{ $medialibraryName }}">
	
	<div class="form-group">
		<label for="file_name">Video Name</label>
		<input 
		type="text" 
		class="form-control" 
		name="file_name" 
		value="{{ old('file_name') }}" 
		placeholder="Add video name here .." 
		aria-describedby="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="path">Video URL</label>
		<input 
		type="text" 
		class="form-control" 
		name="path" 
		value="{{ old('path') }}" 
		placeholder="Video URL here .." 
		aria-describedby="sizing-addon2"
		>
	</div>
	<div class="form-group">
		<label for="caption">Video Caption</label>
		<input 
		type="text" 
		class="form-control" 
		name="caption" 
		value="{{ old('caption') }}" 
		placeholder="Add Caption here .." 
		aria-describedby="sizing-addon2"
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
