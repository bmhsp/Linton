@extends('layouts.main')

@section('content')

@include('partials.navbar')

<div 
class="grid grid-cols-12 md:container md:px-4 lg:px-8 mx-auto" 
x-data="{ airingToday: true, onTheAir: false, popular: false, topRated: false}"> 
  <!-- sidebar -->
  <section class="sidebar col-span-4 md:col-span-3 lg:col-span-2">
    <div class="w-full h-full bg-gray-900 mt-10 relative z-10">

      <nav class="mt-10 fixed">
        <p class="font-semibold text-xs px-4 lg:px-8 mx-4 mb-3 text-gray-600 uppercase">TV Shows</p>
        <button 
        class="w-full flex items-center py-2 px-4 lg:px-8"
        @click="airingToday = true, onTheAir = false, popular = false, topRated = false"
        :class="airingToday ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
        >
          <span class="mx-4 text-sm md:text-base font-medium">Airing Today</span>
        </button>

        <button 
        class="w-full flex items-center mt-5 py-2 px-4 lg:px-8"
        @click="onTheAir = true, airingToday = false, popular = false, topRated = false"
        :class="onTheAir ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
        >
          <span class="mx-4 text-sm md:text-base font-medium">On The Air</span>
        </button>

        <button 
        class="w-full flex items-center mt-5 py-2 px-4 lg:px-8"
        @click="popular = true, onTheAir = false, airingToday = false, topRated = false"
        :class="popular ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
          >
          <span class="mx-4 text-sm md:text-base font-medium">Popular</span>
        </button>

        <button 
        class="w-full flex items-center mt-5 py-2 px-4 lg:px-8"
        @click="topRated = true, onTheAir = false, popular = false, airingToday = false"
        :class="topRated ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
        >
          <span class="mx-4 text-sm md:text-base font-medium">Top Rated</span>
        </button>
      </nav>
    </div>
  </section>

  <!-- main content -->
  <section class="main-content col-span-8 md:col-span-9 lg:col-span-10 mt-4">
    <!-- airing today -->
    <div 
    class="now-playing grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 px-12 md:px-0 md:ml-3 lg:ml-6 pt-16 pb-6 gap-3 md:gap-6" 
    x-show="airingToday"  
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >  
      @foreach ($airingToday as $tv)
      <x-tv-card :tvshow="$tv" :genres="$genres" />
      @endforeach
    </div>

    <!-- on the air -->
    <div 
    class="onTheAir grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 px-12 md:px-0 md:ml-3 lg:ml-6 pt-16 pb-6 gap-3 md:gap-6" 
    x-show="onTheAir"
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >
      @foreach ($onTheAir as $tv)
      <x-tv-card :tvshow="$tv" :genres="$genres" />
      @endforeach
    </div>

    <!-- popular -->
    <div 
    class="popular grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 px-12 md:px-0 md:ml-3 lg:ml-6 pt-16 pb-6 gap-3 md:gap-6" 
    x-show="popular"
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >
      @foreach ($popularTv as $tv)
      <x-tv-card :tvshow="$tv" :genres="$genres" />
      @endforeach
    </div>

    <!-- top rated -->
    <div 
    class="top-rated grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 px-12 md:px-0 md:ml-3 lg:ml-6 pt-16 pb-6 gap-3 md:gap-6" 
    x-show="topRated"
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >
      @foreach ($topRated as $tv)
      <x-tv-card :tvshow="$tv" :genres="$genres" />
      @endforeach
    </div>
  </section>

</div>

@endsection