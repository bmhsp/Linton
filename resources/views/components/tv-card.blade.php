<div>
  <a href="/tv/{{ $tvshow['id'] . '/' . Str::slug($tvshow['name']) }}">
    <img src="{{ $tvshow['poster_path'] }}" alt="{{ $tvshow['name'] }}" class="hover:opacity-75 duration-200 rounded-3xl">
  </a>
  <div class="mt-2 text-center">
    <a href="/tv/{{ $tvshow['id'] . '/' . Str::slug($tvshow['name']) }}" class="text-sm md:text-base mt-2 hover:text-gray-300">
      <p class="truncate">{{ $tvshow['name'] }}</p>
    </a>
    <div class="flex items-center justify-center text-gray-400 text-xs md:text-sm mt-1">
      <svg class="text-yellow-500 w-4" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
      </svg>
      <span class="ml-1">{{ Str::limit($tvshow['vote_average'], 3, '') }}</span>
      <span class="mx-2">|</span>
      <span>{{ ($tvshow['first_air_date']) }}</span>
    </div>
    {{-- <div class="text-gray-400 text-xs md:text-sm">{{ $tvshow['genres'] }}</div> --}}
  </div> 
</div>