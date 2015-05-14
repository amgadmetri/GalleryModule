<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resizeModal">
	Resize image 
</button>

<!-- Modal -->
<div class="modal fade" id="resizeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<form method="post" action='{{  url("admin/gallery/thumbnail/resize/$gallery->id") }}'>
					<input type="hidden" name="_token" value="{{ csrf_token() }}" >
					<div class="form-group">
						<label for="thumb_name">Thumbnail name</label>
						<input 
						type="text" 
						class="form-control" 
						name="thumb_name" 
						value="{{ old('thumb_name') }}" 
						placeholder="Add file name here .." 
						aria-describedby="sizing-addon2"
						>
					</div>
					
					<div class="form-group">
						<label for="width_height">Thumbnail size:</label><br>
						<div class="col-sm-2">
							<input class="form-control" type="text" name="width" id="width" value="{{ old('width') }}" placeholder="width">
						</div>
						
						<div class="col-sm-2">
							<input class="form-control" type="text" name="height" id="height" value="{{ old('height') }}" placeholder="height">
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-primary form-control">Create thumbnail</button>
				</form>
			</div>
		</div>
	</div>
</div>