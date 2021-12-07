@extends('layouts.main')

@section('content')

@include('partials.navbar')

<img src="{{ $getTv['backdrop_path'] }}" alt="{{ $getTv['name'] }}" class="w-full absolute lg:fixed filter blur-sm">

<div class="w-full pt-16 z-10 relative">
  <div class="container px-6 lg:px-8 py-6 mx-auto bg-gradient-to-r from-gray-900 to-transparent">
    <div class="flex items-center gap-3 py-3">
      <a href="/tv/{{ $getTv['slug'] }}">
        <img src="{{ $getTv['tv_poster'] }}" alt="{{ $getTv['name'] }}" class="w-16 rounded-md hover:opacity-75 duration-200">
      </a>
      <div class="py-2 md:py-4">
        <div class="flex items-center gap-2">
          <a href="/tv/{{ $getTv['slug'] }}" class="text-base md:text-2xl">
            <h2 class="font-semibold hover:text-gray-300 duration-200">
              {{ $getTv['original_name'] }} 
            </h2>
          </a>
          <h2 class="text-gray-200 font-normal text-base md:text-2xl">({{ $getTv['tv_year_date'] }})</h2>
        </div>
        
        <a href="/tv/{{ $getTv['slug'] }}" class="text-gray-200 hover:text-gray-400 duration-200 flex items-center gap-1 w-max text-xs md:text-base">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          <span class="text-sm md:text-base">Back to main</span>
        </a>
      </div>
    </div>
  </div>

  <!-- seasons -->
  <div class="seasons bg-gray-900 bg-opacity-90 container px-3 md:px-8 mx-auto divide-y divide-gray-500">
    @foreach ($seasons as $season)
      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-4 md:col-span-2 py-6">
          <a href="/tv/{{ $getTv['id'] . $season['season_link'] }}">    
            <img src="{{ $season['poster_path'] }}" alt="{{ $season['name'] }}" class="hover:opacity-80 duration-200 rounded-lg">
          </a>  
        </div>  

        <div class="col-span-8 md:col-span-10 flex flex-col justify-center py-8">
          <div class="flex gap-4">
            <a href="/tv/{{ $getTv['id'] . $season['season_link'] }}" class="w-max">   
              <h2 class="font-semibold text-base md:text-2xl hover:text-gray-300">{{ $season['name'] }}</h2>
            </a>
            <p class="text-xs lg:text-md self-center bg-red-500 px-1 lg:py-1 font-medium text-center">{{ $season['episode_count'] }} Episode</p>
          </div>
          
          <div class="text-xs md:text-base mt-1">{{ $getTv['original_name'] }} &middot; Season {{ $season['season_number'] }} {{ $season['air_date'] }}
          </div>

          <div class="mt-3 hidden lg:block">
            <p class="pr-8 text-sm">{{ $season['overview'] }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection