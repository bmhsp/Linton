@extends('layouts.main')

@section('content')

@include('partials.navbar')

<div class="lg:h-screen overflow-hidden fixed">
  <img src="{{ $collection['backdrop_path'] }}" alt="{{ $collection['name'] }}" class="w-screen opacity-30 relative">
</div>

<!-- collection -->
<div class="collection-main relative lg:bg-gradient-to-r from-gray-900 to-transparant lg:h-screen lg:flex items-center lg:pt-16 border-b border-gray-500 lg:border-none">
  <div class="container mx-auto px-8 py-8 grid grid-cols-1 lg:grid-cols-4">
    <div class="h-max lg:col-span-1 mt-12 md:mt-24 lg:mt-0">
      <img src="{{ $collection['poster_path'] }}" alt="{{ $collection['name'] }}" class="w-1/3 mx-auto lg:w-full rounded-md lg:rounded-none lg:rounded-t-md">
    </div>

    <div class="lg:ml-16 mt-4 lg:mt-0 lg:col-span-3 flex flex-col justify-center">
      <h2 class="text-2xl md:text-4xl text-center lg:text-left font-bold">{{ $collection['name'] }}</h2>
      <div class="mt-8">
        <h2 class="text-lg font-semibold mb-1">Overview</h2>
        <p class="text-sm md:text-base">
          {{ $collection['overview'] }}
        </p>
      </div>   
      
      <!-- movie list -->
      <div class="movie-list mt-8">
        <h2 class="text-lg font-semibold mb-2">Movie List</h2>
        <div class="flex overflow-x-scroll pb-4">
          <div class="flex flex-nowrap gap-6">
            @foreach ($getMovie as $movie)
              <div class="inline-block">
              <div class="w-52 md:w-72 max-w-xs h-max overflow-hidden">
                  <a href="/movies/{{ $movie['movie_link'] }}">
                    <img src="{{ $movie['backdrop_path'] }}" alt="{{ $movie['title'] }}" class="hover:opacity-75 duration-200 rounded-xl">
                  </a>   
                  <div class="mt-1 text-center">
                    <a href="/movies/{{ $movie['movie_link'] }}" class="text-sm md:text-base font-medium mt-2 hover:text-gray-300">
                      <p class="truncate">{{ $movie['title'] }}</p>
                    </a>
                    <div class="flex justify-center items-center text-gray-300 text-xs mt-1">
                      <svg class="text-yellow-500 w-4" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                      </svg>
                      <span class="ml-1">{{ $movie['vote_average'] }}</span>
                      <span class="mx-2">|</span>
                      <span>{{ ($movie['release_date']) }}</span>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>     
  </div>
</div> <!-- end collection -->

@endsection