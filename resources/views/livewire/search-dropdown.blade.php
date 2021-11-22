<div class="relative mt-3 md:mt-0" x-data="{ result: true }" @click.away="result = false">
	<input 
		wire:model.debounce.500ms="search" 
		type="text" 
		class="bg-white bg-opacity-20 bg-clip-padding backdrop-filter backdrop-blur rounded-full w-64 px-4 pl-8 py-1 ml-3 text-xs sm:text-base focus:outline-none placeholder-white"  
		placeholder="Search (Press '/' to focus)"
		x-ref="search"
		@keydown.window="
			if (event.keyCode === 191) {
				event.preventDefault();
				$refs.search.focus();
			}
		"
		@focus="result = true"
		@keydown="result = true"
		@keydown.escape.window="result = false"
		@keydown.shift.tab="result = false"
	>
	<div class="absolute top-0">
		<svg class="w-4 text-white mt-1 md:mt-2 ml-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
		</svg>
	</div> 

	<div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>

	@if (strlen($search) > 2)
		<div 
			class="z-50 absolute bg-gray-900 text-sm font-medium w-64 mt-4" 
			x-show.transisiton.opacity="result"
		>

			@if ($searchResults->count() > 0)
				<ul>
					@foreach ($searchResults as $result)
						<li class="border-b border-black">
							@if ($result['media_type'] === 'movie')
								<a 
									href="/movies/{{ $result['id'] . '/' . Str::slug($result['title']) }}" class="hover:bg-gray-700 px-3 py-3 flex items-center"
									@if ($loop->last) @keydown.tab="result = false" @endif
								>
									<img src="{{ $result['poster_path'] ? 'https://image.tmdb.org/t/p/w92/' . $result['poster_path'] : 'http://via.placeholder.com/50x75'  }}" class="w-8">
									<span class="ml-4">{{ $result['title'] }}</span>
								</a>

							@elseif ($result['media_type'] === 'tv')
								<a 
									href="/tv/{{ $result['id'] . '/' . Str::slug($result['name']) }}" class="hover:bg-gray-700 px-3 py-3 flex items-center"
									@if ($loop->last) @keydown.tab="result = false" @endif
								>
									<img src="{{ $result['poster_path'] ? 'https://image.tmdb.org/t/p/w92/' . $result['poster_path'] : 'http://via.placeholder.com/50x75'  }}" class="w-8">
									<span class="ml-4">{{ $result['name'] }}</span>
							</a>

							@elseif ($result['media_type'] === 'person')
								<a 
									href="/person/{{ $result['id'] . '/' . Str::slug($result['name']) }}" class="hover:bg-gray-700 px-3 py-3 flex items-center"
									@if ($loop->last) @keydown.tab="result = false" @endif
								>
									<img src="{{ $result['profile_path'] ? 'https://image.tmdb.org/t/p/w92/' . $result['profile_path'] : 'http://via.placeholder.com/50x75'  }}" class="w-8">
									<span class="ml-4">{{ $result['name'] }}</span>
							</a>
							@endif
							
						</li>
					@endforeach
				</ul>
			
			@else
				<div class="px-3 py-3">No result for "{{ $search }}"</div>
			@endif
		</div>
	@endif
</div>
