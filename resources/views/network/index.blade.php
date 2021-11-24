@extends('layouts.main')

@section('content')

@include('partials.navbar')

<div class="bg-path bg-cover w-screen h-screen fixed">
</div>

<div class="w-full pb-6 pt-14 relative">
  <div class="container px-3 md:px-8 mx-auto flex gap-6 from-gray-900 to-transparent bg-opacity-50">
    <div class="py-4 self-center w-1/5">
      <img src="{{ $networks['logo_path'] }}" alt="{{ $networks['name'] }}" class="w-full md:w-3/4 lg:w-1/2 cursor-pointer p-1">
    </div>

    <div class="self-end flex flex-wrap gap-1 justify-between py-4 w-full lg:w-1/2 text-xs md:text-base">
      <div class="flex gap-2 items-center">
        <i class="fas fa-network-wired"></i>
        <p>{{ $networks['name'] }}</p>
      </div>
      <div class="flex gap-2 items-center">
        <i class="fas fa-compass"></i>
        <p>{{ $networks['headquarters'] }}</p>
      </div>
      <div class="flex gap-2 items-center">
        <i class="fas fa-globe-asia"></i>
        <p>{{ $networks['origin_country'] }}</p>
      </div>
      <div class="flex items-center">
        <a href="{{ $networks['homepage'] }}">
          <i class="fas fa-link mr-2"></i>Website
        </a>
      </div>
    </div>
  </div>

  <!-- results -->
  <div class="results bg-gray-900 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 container px-3 md:px-8 py-6 mx-auto">  
    @foreach ($tv as $tvshow)
      <x-tv-card :tvshow="$tvshow" />
    @endforeach
  </div>
</div>

@endsection