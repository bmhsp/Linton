@extends('layouts.main')

@include('partials.navbar')

@section('content')
<div class="px-3 md:px-6 pt-16 md:pt-12 container mx-auto divide-y divide-gray-700">
  <!-- person info -->
  <div class="grid md:grid-cols-12 md:gap-6">
    <div class="side-info md:col-span-4 md:py-6">
      <div class="bg-white w-max mx-auto md:mx-0 rounded-md border-2 border-white overflow-hidden">
        <img src="{{ $person['profile_path'] }}" alt="{{ $person['name'] }}" class="w-52 lg:w-full">

        <ul class="flex gap-6 px-3 text-2xl">
          @if ($person['homepage'])
            <li class="text-black py-1">
              <a target="_blank" href="{{ $person['homepage'] }}"><i class="fas fa-link"></i></a>
            </li>  
          @endif
          @if ($social['facebook'])
            <li class="text-blue-600 py-1">
              <a target="_blank" href="{{ $social['facebook'] }}"><i class="fab fa-facebook-square"></i></a>
            </li>  
          @endif
          @if ($social['twitter'])
            <li class="text-blue-600 py-1">
              <a target="_blank" href="{{ $social['twitter'] }}"><i class="fab fa-twitter"></i></a>
            </li>
          @endif
          @if ($social['instagram'])
            <li class="text-red-500 py-1">
              <a target="_blank" href="{{ $social['instagram'] }}"><i class="fab fa-instagram"></i></a>
            </li>
        @endif
        </ul>
      </div>

      <h2 class="md:hidden text-center mt-2 font-semibold text-3xl tracking-wide">{{ $person['name'] }}</h2>
      
      <div class="mt-6">
        <h2 class="font-medium text-lg  md:text-2xl">Personal Info</h2>
        <div class="grid grid-cols-2 gap-3 md:grid-cols-none">
          <div class="mt-3">
            <h3 class="font-medium">Known For</h3>
            <p class="text-gray-300">{{ $person['known_for_department'] }}</p>
          </div>
          <div class="mt-3">
            <h3 class="font-medium">Gender</h3>
            <p class="text-gray-300">{{ $person['gender'] }}</p>
          </div>
          <div class="mt-3">
            <h3 class="font-medium">Birthday</h3>
            <p class="text-gray-300">{{ $person['birthday'] }} ({{ $person['age'] }} years old)</p>
          </div>
          <div class="mt-3">
            <h3 class="font-medium">Place of Birth</h3>
            <p class="text-gray-300">{{ $person['place_of_birth'] }}</p>
          </div>
          @if ($person['deathday'])
            <div class="mt-3">
              <h3 class="font-medium">Day of death</h3>
              <p class="text-gray-300">{{ $person['deathday'] }}</p>
            </div>
          @endif
          <div class="hidden md:block mt-3">
            <h3 class="font-medium">Also knows as</h3>
            @foreach($person['also_known_as'] as $known_as)
              <p class="text-gray-300 mb-1">{{ $known_as }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="info md:col-span-8 md:py-8">
      <div class="mb-6">
        <h2 class="hidden md:block font-semibold text-3xl tracking-wide">{{ $person['name'] }}</h2>
        <div class="mt-8">
          <h3 class="font-medium text-xl">Biography</h3>
          <p class="mt-2 text-sm md:text-md whitespace-pre-wrap">{{ $person['biography'] }}</p>
        </div>
      </div>

      <div class="mb-6">
        <h2 class="font-medium text-xl mb-4">Known For</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @if ($getMovies != '[]')
            @foreach ($getMovies as $movie)
              <div class="grid grid-cols-5 md:grid-cols-3 lg:grid-cols-5 items-center bg-white rounded-md overflow-hidden text-black">
                <a href="{{ $movie['linkToPage'] }}" class="w-max col-span-1">
                  <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150 w-16 h-full">
                </a>
                <div class="col-span-4 md:col-span-2 lg:col-span-4">
                  <a href="{{ $movie['linkToPage'] }}">
                    <p class="truncate text-sm md:text-base font-medium hover:text-gray-800">{{ $movie['title'] }}</p>
                  </a>
                  <p class="text-gray-800 text-xs">{{ $movie['character'] }}</p>
                </div>
              </div> 
              @endforeach
            @else
              <p class="mt-2 text-gray-300 text-sm md:text-base whitespace-pre-wrap">Sorry we don't have enough data for this person.</p>
            @endif
        </div>
      </div>
    </div>

  </div>
</div>

@endsection