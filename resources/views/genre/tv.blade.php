@extends('layouts.main')

@section('content')

@include('partials.navbar')

<div class="grid grid-cols-12 md:container md:px-4 lg:px-8 mx-auto"
x-data="{ popular: true, topRated: false, latest: false }">
  <!-- sidebar -->
  <section class="sidebar col-span-4 md:col-span-3 lg:col-span-2">
    <div class="w-full h-full bg-gray-900 mt-10 relative z-10">
      <nav class="mt-10 fixed">
        <p class="font-semibold text-xs px-4 lg:px-8 mx-4 mb-2 text-gray-600 uppercase">tv show</p>
        <button 
        class="w-full flex items-center mb-5 py-2 px-4 lg:px-8"
        @click="popular = true, topRated = false, latest = false"
        :class="popular ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
        >
          <span class="mx-4 text-sm md:text-base font-medium">Popular</span>
        </button>

        <button 
        class="w-full flex items-center mb-5 py-2 px-4 lg:px-8"
        @click="topRated = true, popular = false, latest = false"
        :class="topRated ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
        >
          <span class="mx-4 text-sm md:text-base font-medium">Top Rated</span>
        </button>

        <button 
        class="w-full flex items-center py-2 px-4 lg:px-8"
        @click="latest = true, topRated = false, popular = false"
        :class="latest ? 'bg-gray-700 text-gray-100 border-r-4 border-gray-100' : 'text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700 hover:text-gray-100 hover:border-gray-100 duration-300 ease-in'"
        >
          <span class="mx-4 text-sm md:text-base font-medium">Latest</span>
        </button>
      </nav>
    </div>
  </section>

  <!-- main content -->
  <section class="main-content col-span-8 md:col-span-9 lg:col-span-10 mt-16 pb-12">
    <div class="popular grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8 px-8 md:px-0"
    x-show="popular"
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >
      @foreach ($popular as $tvshow)
        <x-tv-card :tvshow="$tvshow" />
      @endforeach
    </div>

    <div class="topRated grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8 px-8 md:px-0"
    x-show="topRated"
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >
      @foreach ($topRated as $tvshow)
        <x-tv-card :tvshow="$tvshow" />
      @endforeach
    </div>

    <div class="latest grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8 px-8 md:px-0"
    x-show="latest"
    x-transition:enter="transition ease-in duration-500"
    x-transition:enter-start="opacity-0 transform -translate-x-12"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    >
      @foreach ($latest as $tvshow)
        <x-tv-card :tvshow="$tvshow" />
      @endforeach
    </div>
  </section>
</div>   

@endsection