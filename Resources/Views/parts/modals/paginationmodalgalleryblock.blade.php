@if($galleries)
	<nav>
		<ul class="pagination">
			<li class="previous">
				<a 
				href = "{{ $galleries->previousPageUrl() }}" 
				id   = "{{ $medialibraryName }}mediaLibraryPrevious"
				@if($galleries->previousPageUrl() == null)
					class="btn disabled" role="button"
				@endif
				>
					<span aria-hidden="true">&larr;</span> Previous
				</a>
			</li>

			@for($i = 1 ; $i <= $galleries->lastPage() ; $i++)
				<li 
				@if($galleries->currentPage() == $i)
					class="active"
				@endif
				>
					<a 
					href ="{{ $galleries->url($i) }}"
					id   ="{{ $medialibraryName }}mediaLibraryLinks"
					>
						{{ $i }}
					</a>
				</li>
			@endfor
			
			<li class="next">
				<a 
				href = "{{ $galleries->nextPageUrl() }}" 
				id   = "{{ $medialibraryName }}mediaLibraryNext"
				@if($galleries->nextPageUrl() == null)
					class="btn disabled" role="button"
				@endif
				>
					Next <span aria-hidden="true">&rarr;</span>
				</a>
			</li>
		</ul>
	</nav>
@else
	<nav>
		<ul class="pagination">
			<li class="previous">
				<a 
				href = "{{ $albums->previousPageUrl() }}" 
				id   = "{{ $medialibraryName }}mediaLibraryPrevious"
				@if($albums->previousPageUrl() == null)
					class="btn disabled" role="button"
				@endif
				>
					<span aria-hidden="true">&larr;</span> Previous
				</a>
			</li>

			@for($i = 1 ; $i <= $albums->lastPage() ; $i++)
				<li 
				@if($albums->currentPage() == $i)
					class="active"
				@endif
				>
					<a 
					href ="{{ $albums->url($i) }}"
					id   ="{{ $medialibraryName }}mediaLibraryLinks"
					>
						{{ $i }}
					</a>
				</li>
			@endfor

			<li class="next">
				<a 
				href = "{{ $albums->nextPageUrl() }}" 
				id   = "{{ $medialibraryName }}mediaLibraryNext"
				@if($albums->nextPageUrl() == null)
					class="btn disabled" role="button"
				@endif
				>
					Next <span aria-hidden="true">&rarr;</span>
				</a>
			</li>
		</ul>
	</nav>
@endif