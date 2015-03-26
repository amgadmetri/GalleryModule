<!-- Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<img src='{{ $gallery->path }}' alt="{{ $gallery->caption }}" id="target" /><br>
				<form method="post" id="crop_form" action="{{ url('/gallery/thumbnail/crop', $gallery->id) }}">
					<input name="_token" type="hidden" value="{{ csrf_token() }}">
					<input type="hidden" name="x">       	
					<input type="hidden" name="y">
					<input type="hidden" name="width">
					<input type="hidden" name="height">
					<div class="form-group">
						<label for="thumb_name">Thumbnail name</label>
						<input 
						type="text" 
						class="form-control" 
						name="thumb_name" 
						value="{{ old('thumb_name') }}" 
						placeholder="Thumbnail name here .." 
						aria-describedby="sizing-addon2"
						>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">Crop</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
<script src="{{ asset('js/crop/jquery.Jcrop.min.js') }}"></script>
<script src="{{ asset('js/crop/cropform.js') }}"></script>