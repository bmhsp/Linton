@extends('layouts.main')

@section('content')

@include('partials.navbar')

<img src="{{ $season['poster_path'] }}" alt="{{ $getTv['name'] }}" class="w-full fixed">

<div class="w-full py-6 relative">
  <div class="mt-8 px-6 md:px-10 bg-gradient-to-r from-gray-900 to-transparent">
    <div class="flex items-center gap-3 py-3">
      <a href="/tv/{{ $getTv['id'] . $season['season_link'] }}">
        <img src="{{ $season['poster_path'] }}" alt="{{ $season['name'] }}" class="w-16 rounded-md hover:opacity-75 duration-200">
      </a>
      <div class="py-2 md:py-4">
        <div class="flex items-center gap-2">
          <a href="/tv/{{ $getTv['id'] . $season['season_link'] }}">
            <h2 class="text-base md:text-2xl font-semibold hover:text-gray-300 duration-200">
              {{ $season['name'] }} 
            </h2>
          </a>
          <h2 class="text-gray-200 text-base md:text-2xl font-normal">({{ $season['air_date'] }})</h2>
        </div>
        <a href="/tv/{{ $getTv['slug'] }}/seasons" class="text-gray-200 hover:text-gray-400 duration-200 flex items-center gap-1 w-max text-xs md:text-base">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          <span>Back to season list</span>
        </a>
      </div>
    </div>
  </div>

  @if ($getEpisode != '[]')
    <div class="episodes bg-gray-900 container px-3 md:px-8 mx-auto divide-y divide-gray-500">
      @foreach ($getEpisode as $episode)
        <div class="md:grid md:grid-cols-12 gap-6">
          <div class="md:col-span-6 lg:col-span-4 py-6">
            <a href="/tv/{{ $getTv['id'] . $season['season_link'] . $episode['episode_link'] }}">    
              <img src="{{ $episode['still_path'] }}" alt="{{ $episode['name'] }}" class="hover:opacity-80 duration-200 rounded-lg">
            </a>  
          </div>  

          <div class="md:col-span-6 lg:col-span-8 flex flex-col justify-center pb-6 md:py-8">
            <div class="flex gap-3">
              <p class="text-md bg-white text-gray-900 px-2 rounded-full h-max font-semibold">{{ $episode['episode_number'] }}</p>
              <div class="flex flex-col lg:flex-row lg:justify-between w-full">
                <div class="flex items-center gap-4 mb-1">
                  <a href="/tv/{{ $getTv['id'] . $season['season_link'] . $episode['episode_link'] }}">   
                    <h2 class="font-semibold text-lg md:text-xl hover:text-gray-300">{{ $episode['name'] }}</h2>
                  </a>
                  <div class="flex bg-red-500 text-sm px-2 py-1 rounded-full">
                    <svg class="text-yellow-300 w-4" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span class="ml-1 text-white font-semibold">{{ $episode['vote_average'] }}</span>
                </div>
                </div>
                <p class="text-xs lg:self-center tracking-wide">
                  {{ ($episode['air_date']) }} 
                </p>
              </div>
            </div>

            <div class="mt-3">
              <p class="pr-8 text-sm">{{ $episode['overview'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="container px-3 md:px-8 mx-auto divide-y divide-gray-500">
      <div class="md:grid md:grid-cols-12 gap-6">
        <div class="md:col-span-6 lg:col-span-4 py-6">
          <img src="https://via.placeholder.com/750x500?text=COMING+SOON" class="hover:opacity-80 duration-200 rounded-lg">
        </div>  

        <div class="md:col-span-6 lg:col-span-8 flex flex-col justify-center pb-6 md:py-8">
          <div class="flex gap-3">
            <p class="text-md bg-white text-gray-900 px-2 rounded-full h-max font-semibold">0</p>
            <div class="flex flex-col lg:flex-row lg:justify-between w-full">
              <div class="flex items-center gap-4 mb-1">
                <h2 class="font-semibold text-lg md:text-xl hover:text-gray-300">Coming soon!</h2>
                <div class="flex bg-red-500 text-sm px-2 py-1 rounded-full">
                  <svg class="text-yellow-300 w-4" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                  <span class="ml-1 text-white font-semibold">0</span>
              </div>
              </div>
              <p class="text-xs lg:self-center tracking-wide">
                future 
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

</div>

@endsection