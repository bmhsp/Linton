@extends('layouts.main')

@section('content')

@include('partials.navbar')

<div class="bg-path bg-cover w-screen h-screen fixed">
</div>

<div class="w-full py-16 z-10 relative">
  <div class="container px-6 lg:px-8 py-6 mx-auto bg-gradient-to-r from-gray-900 to-transparent bg-opacity-50">
    <h1 class="text-3xl font-black tracking-wide uppercase">Lin.<span class="text-yellow-400">ton</span></h1>
    <p class="mt-2 text-sm md:text-base">Movies, TV Shows, and person are ready to discover. <a href="/movies" class="px-1 bg-yellow-400 font-semibold tracking-wide">Explore Now.</a></p>
  </div>

  <!-- movies -->
  <div class="movies container px-6 lg:px-8 py-6 mx-auto bg-gray-900">
    <h2 class="text-xl font-semibold uppercase mb-5 pl-2 text-yellow-400">trending movies</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
      @foreach ($movies as $movie)
        <x-movie-card :movie="$movie" />
      @endforeach
    </div>
  </div>

  <!-- tv -->
  <div class="tv container px-6 lg:px-8 py-6 mx-auto bg-gray-900">
    <h2 class="text-xl font-semibold uppercase mb-5 pl-2 text-yellow-400">trending tv shows</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
      @foreach ($tv as $tvshow)
        <x-tv-card :tvshow="$tvshow" />
      @endforeach
    </div>
  </div>

  <!-- persons -->
  <div class="persons container px-6 lg:px-8 py-6 mx-auto bg-gray-900">
    <h2 class="text-xl font-semibold uppercase mb-5 pl-2 text-yellow-400">trending people</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
      @foreach ($persons as $person)
      <div class="bg-white rounded-lg overflow-hidden text-black shadow-lg">
        <a href="/person/{{ $person['link'] }}">
          <img src="{{ $person['profile_path'] }}" alt="{{ $person['name'] }}" class="hover:opacity-75 transition ease-in-out duration-200">
        </a>
        <div class="mt-2 px-2 pb-2 text-center">
          <a href="/persons/{{ $person['link'] }}" class="text-xs md:text-sm hover:text-gray-300 font-semibold">
            <p class="truncate">{{ $person['name'] }}</p>
          </a>
          <p class="text-xs truncate text-gray-600">{{ $person['known_for'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
  
@endsection