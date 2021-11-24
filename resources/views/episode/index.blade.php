@extends('layouts.main')

@section('content')

@include('partials.navbar')

<img src="{{ $episode['still_path'] }}" alt="{{ $episode['name'] }}" class="w-full fixed">

<div class="w-full py-6 relative">
  <div class="mt-8 px-6 md:px-10 bg-gradient-to-r from-gray-900 to-transparent">
    <div class="flex items-center gap-3 py-3">
      <a href="/tv/{{ $getTv['id'] . $getSeason['season_link'] }}">
        <img src="{{ $getSeason['poster_path'] }}" alt="{{ $getSeason['name'] }}" class="w-16 rounded-md hover:opacity-75 duration-200">
      </a>
      <div class="py-2 md:py-4">
        <div class="flex items-center gap-2">
          <a href="/tv/{{ $getTv['id'] . $getSeason['season_link'] }}">
            <h2 class="text-base md:text-2xl font-semibold hover:text-gray-300 duration-200">
              {{ $getSeason['name'] }} 
            </h2>
          </a>
          <h2 class="text-gray-200 text-base md:text-2xl font-normal">({{ $getSeason['year_date'] }})</h2>
        </div>
        <a href="/tv/{{ $getTv['id'] . $getSeason['season_link'] }}" class="text-gray-200 hover:text-gray-400 duration-200 flex items-center gap-1 w-max text-xs md:text-base">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          <span>Back to episode list</span>
        </a>
      </div>
    </div>
  </div>

  <!-- episode -->
  <div class="episode bg-gray-900 container px-3 md:px-8 mx-auto episode md:grid md:grid-cols-12 gap-6">
    <div class="md:col-span-6 lg:col-span-4 py-6">
      <img src="{{ $episode['still_path'] }}" alt="{{ $episode['name'] }}" class="hover:opacity-80 duration-200 rounded-lg mx-auto"> 
    </div>  

    <div class="md:col-span-6 lg:col-span-8 flex flex-col justify-center pb-6 md:py-8">
      <div class="flex gap-3">
        <p class="text-md bg-white text-gray-900 px-2 rounded-full h-max font-semibold">{{ $episode['episode_number'] }}</p>
        <div class="flex flex-col lg:flex-row lg:justify-between w-full">
          <div class="flex items-center gap-4 mb-1">
            <h2 class="font-semibold text-lg md:text-xl hover:text-gray-300">{{ $episode['name'] }}</h2>
            <div class="flex bg-red-500 text-sm px-2 py-1 rounded-full w-max">
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

  <!-- images -->
  <div class="images relative bg-white" x-data="{ image: false , image:''}">
    <div class="container mx-auto px-3 md:px-8 py-6">
      <h2 class="text-xl font-semibold mb-3 text-black">Screenshoot</h2>
      <div class="flex overflow-x-scroll hide-scroll-bar rounded-md">
        <div class="flex flex-nowrap gap-4">
          @foreach ($getImage as $image)
            <div class="inline-block max-w-xs w-max">
              <button
              @click.prevent="
                image = true
                image = '{{ $image['file_path'] }}'
              "
              >
                <img src="{{ $image['file_path'] }}" alt="{{ $getSeason['name'] }}" class="hover:opacity-75 transition:ease-in duration-200 cursor-pointer">   
              </button>
            </div>
          @endforeach
        </div>
      </div>

      <!-- image modal -->
      <div 
      class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50" 
      style="background-color: rgba(0, 0, 0, 0.5)"
      x-show.transition.opacity="image"
      >
        <div class="mx-auto max-w-5xl bg-red-500 px-2 pb-2 rounded-md" @click.away="image = false">
          <div class="flex justify-between px-3 pb-1">
            <h2 class="text-xl font-medium tracking-wide self-end">{{ $episode['name'] }}</h2>
            <button 
              @click="image = false"
              @keydown.escape.window= "image = false"
              class="text-4xl leading-none hover:text-gray-300">&times;
            </button>
          </div>

          <div class="relative overflow-hidden px-40 md:px-64 lg:px-96" style="padding-top: 56.25%;">
            <img :src="image" alt="{{ $episode['name'] }}" class="absolute top-0 left-0 w-full h-full">
          </div>
        </div>
      </div> <!-- end image modal-->
    </div>
  </div> 

  <!-- credit --> 
  <div class="credit bg-gray-900 container px-3 md:px-8 mx-auto py-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      @if ($getCast != '[]')
        <div class="cast">
          <h2 class="text-xl font-medium mb-3">Main Character</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($getCast as $cast)
              <div class="bg-white rounded-md overflow-hidden flex items-center gap-3">
                <a href="/person/{{ $cast['slug'] }}">
                  <img src="{{ $cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="w-16 hover:opacity-80 duration-200">
                </a>
                <div>
                  <a href="/person/{{ $cast['slug'] }}">
                    <h5 class="font-medium text-black hover:text-gray-700 duration-200">{{ $cast['name'] }}</h5>
                  </a>
                  <p class="text-gray-700 text-xs truncate">{{ $cast['character'] }}</p>
                </div>
              </div>
              
            @endforeach
          </div>
        </div>
      @endif

      @if ($getGuest != '[]')
        <div class="guest-star">
          <h2 class="text-xl font-medium mb-3">Guest Star</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($getGuest as $guest)
              <div class="bg-white rounded-md overflow-hidden flex items-center gap-3">
                <a href="/person/{{ $guest['slug'] }}">
                  <img src="{{ $guest['profile_path'] }}" alt="{{ $guest['name'] }}" class="w-16 hover:opacity-80 duration-200">
                </a>
                <div>
                  <a href="/person/{{ $guest['slug'] }}">
                    <h5 class="font-medium text-black hover:text-gray-700 duration-200">{{ $guest['name'] }}</h5>
                  </a>
                  <p class="text-gray-700 text-xs truncate">{{ $guest['character'] }}</p>
                </div>
              </div>      
            @endforeach
          </div>
        </div>
      @elseif ($getCrew != '[]')
        <div class="crew">
          <h2 class="text-xl font-medium mb-3">Crew</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($getCrew as $crew)
              <div class="bg-white rounded-md overflow-hidden flex items-center gap-3">
                <a href="/person/{{ $crew['slug'] }}">
                  <img src="{{ $crew['profile_path'] }}" alt="{{ $crew['name'] }}" class="w-16 hover:opacity-80 duration-200">
                </a>
                <div>
                  <a href="/person/{{ $crew['slug'] }}">
                    <h5 class="font-medium text-black hover:text-gray-700 duration-200">{{ $crew['name'] }}</h5>
                  </a>
                  <p class="text-gray-700 text-xs truncate">{{ $crew['known_for_department'] }}</p>
                </div>
              </div>             
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>
</div>

 @endsection