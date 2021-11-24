@extends('layouts.main')

@section('content')

@include('partials.navbar')

<div class="lg:h-screen overflow-hidden absolute">
  <img src="{{ $tvshow['backdrop_path'] }}" alt="{{ $tvshow['name'] }}" class="w-screen opacity-30 relative">
</div>

  <!-- tv main -->
  <div class="tv-main relative lg:bg-gradient-to-r from-gray-900 to-transparant lg:h-screen lg:flex items-center lg:pt-16 border-b border-gray-500 lg:border-none">
    <div class="container mx-auto px-8 py-8 grid grid-cols-1 lg:grid-cols-4">
      <div class="h-max lg:col-span-1 mt-12 md:mt-24 lg:mt-0">
        <img src="{{ $tvshow['poster_path'] }}" alt="{{ $tvshow['name'] }}" class="w-1/3 mx-auto lg:w-full rounded-md lg:rounded-none lg:rounded-t-md">
        
        <div x-data="{ trailer: false }">
          @if ($getVideo == '[]')
            <button class="focus:outline-none bg-black duration-200 rounded-md w-max px-3 md:px-16 lg:px-0 mx-auto mt-3 lg:mt-0 lg:rounded-none lg:rounded-b-md lg:w-full flex justify-center items-center py-2 md:py-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
              </svg>
              <span class="ml-1 font-medium text-xs md:text-base">No Trailer</span>
            </button>
          @else  
            <button class="focus:outline-none bg-red-800 hover:bg-red-900 rounded-md w-max px-3 md:px-16 lg:px-0 mx-auto mt-3 lg:mt-0 lg:rounded-none lg:rounded-b-md lg:w-full flex justify-center items-center py-2 md:py-3" @click="trailer = true">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
              </svg>
              <span class="ml-1 font-medium text-xs md:text-base">View Trailer</span>
            </button>
          @endif

          <!-- trailer modal -->
          <section  
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-50" 
            style="background-color: rgba(0, 0, 0, 0.5)"
            x-show.transition.opacity="trailer"
          >
            <div class="mx-auto max-w-5xl bg-red-500 px-2 pb-2 rounded-md" @click.away="trailer = false" @keydown.escape.window="trailer = false">
              <div class="flex justify-between px-3 pb-1">
                <h2 class="text-lg md:text-xl font-medium tracking-wide self-end">{{ $tvshow['name'] }}</h2>
                <button @click="trailer = false" class="text-2xl md:text-4xl leading-none">&times;</button>
              </div>

              <div class="relative overflow-hidden px-40 md:px-64 lg:px-96" style="padding-top: 56.25%;">
                <!-- large image on slides -->
                @foreach ($getVideo as $video)
                  <div class="mySlides hidden">
                    <div class="w-full object-cover">
                      <iframe width="560" height="315" class="absolute top-0 left-0 w-full h-full" src="https://youtube.com/embed/{{ $video['key'] }}" style="border: 0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                  </div>
                @endforeach
          
                <!-- buttons -->
                <a class="absolute left-0 md:inset-y-3/4 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(-1)">❮</a>
                <a class="absolute right-0 md:inset-y-3/4 flex items-center -mt-32 px-4 text-white hover:text-gray-800 cursor-pointer text-3xl font-extrabold" onclick="plusSlides(1)">❯</a>
              </div>

              <!-- smaller images under description -->
              <div class="w-full object-cover flex justify-center gap-3 md:gap-1 border border-red-500">
                @foreach ($getVideo as $video)
                  <img class="description h-12 md:h-24 opacity-50 hover:opacity-100 cursor-pointer" src="{{ $video['thumbnail'] }}" onclick="currentSlide({{ $loop->iteration }})" alt="{{ $video['name'] }}">
                @endforeach
              </div>
            </div>
          </section> <!-- end modal --> 
        </div>
      </div>

      <div class="lg:ml-16 mt-4 lg:mt-0 lg:col-span-3 flex flex-col justify-center">
        <h2 class="text-2xl md:text-4xl text-center lg:text-left font-bold">{{ $tvshow['name'] }}</h2>
        <div class="flex flex-wrap items-center justify-center lg:justify-start text-gray-300 text-xs md:text-sm lg:text-base mt-1">
          <svg class="text-yellow-500 w-4" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
          </svg>
          <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
          <span class="mx-2">|</span>
          <span>{{ $tvshow['type'] }}</span>
          <span class="mx-2">|</span>
          <span>{{ $tvshow['episode_run_time'] }}</span>
        </div>

        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 mt-6">
          @foreach ($getGenre as $genre)
            <a href="/genre/{{ $genre['link'] }}/tv" class="text-xs md:text-base px-3 py-2 font-semibold border border-white hover:bg-white hover:text-black duration-300 ease-in text-center tracking-wide">
              {{ $genre['name'] }}
            </a>
          @endforeach
        </div>

        <div class="mt-8">
          <h2 class="text-lg font-semibold mb-1">Overview</h2>
          <p class="text-sm md:text-base">
            {{ $tvshow['overview'] }}
          </p>
        </div>

        <div class="mt-8 flex justify-between md:w-1/2">
          <div>
            <h2 class="text-lg font-semibold mb-1">Status</h2>
            <p class="text-sm md:text-base">{{ $tvshow['status'] }}</p>
          </div>
          @if ($tvshow['created_by'])
            <div>
              <h2 class="text-lg font-semibold mb-1">Creator</h2>
              <p class="text-sm md:text-base">{{ $tvshow['created_by'] }}</p>
            </div>
          @endif
        </div>
        
      </div>
      
    </div>
  </div> <!-- end tv main -->

  <!-- tv info -->
  <div class="tv-info container px-3 md:px-8 py-6 mx-auto border-b border-gray-500">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
      <div class="lg:col-span-3 w-full">
        <h2 class="text-xl md:text-2xl font-semibold mb-3">Lastest Season</h2>
        <div class="lastest-season grid grid-cols-2 md:grid-cols-4 border border-gray-800 shadow-lg rounded-lg overflow-hidden">
          <div class="md:col-span-1 w-4/5">
            @foreach ($getSeason as $season)
              @if ($loop->last)
                <a href="/tv/{{ $tvshow['id'] . $season['season_link'] }}">    
                  <img src="{{ $season['season_poster'] }}" alt="{{ $season['name'] }}" class="hover:opacity-80 duration-200">
                </a>        
                </div>
                <div class="md:col-span-3 flex flex-col justify-center">
                  <a href="/tv/{{ $tvshow['id'] . $season['season_link'] }}" class="w-full">   
                    <h2 class="font-semibold text-lg md:text-2xl hover:text-gray-300">{{ $season['name'] }}</h2>
                  </a>
                  <p class="text-sm md:text-md font-medium">
                    {{ ($season['year_air_date']) }} | 
                    {{ $season['episode_count'] }} Episode
                  </p>
                  
                  <div class="mt-6 text-sm md:text-base">{{ $tvshow['name'] }} &middot; Season {{ $season['season_number'] . $season['air_date'] }}  
                  </div>

                  <a href="/tv/{{ $tvshow['link'] }}/seasons" class="mt-1 hover:text-gray-300 underline text-sm md:text-base">View All Seasons</a>
              @endif
            @endforeach
          </div>
        </div>

        <div class="mt-3">
          <div class="flex flex-wrap gap-2">
            @foreach ($keywords as $keyword)
              <a href="/keyword/{{ $keyword['link'] }}/tv" class="bg-gray-700 hover:bg-gray-800 rounded-md px-2 py-1 text-sm">{{ $keyword['name'] }}</a>
            @endforeach
          </div>
        </div>
      </div>
      
      <div class="lg:col-span-1 w-full">
        <h2 class="text-xl md:text-2xl font-semibold mb-3">Info</h2>
        <div class="bg-gray-300 bg-opacity-20 p-3 rounded-md border border-gray-800 shadow-lg">
          <div class="mb-3">
            <h3 class="font-medium mb-1">Original Name</h3>
            <p class="text-gray-300">{{ $tvshow['original_name'] }}</p>
          </div>
          <div class="mb-3">
            <h3 class="font-medium mb-1">First Air Date</h3>
            <p class="text-gray-300">{{ $tvshow['first_air_date'] }}</p>
          </div>
          <div class="mb-3">
            <h3 class="font-medium mb-1">Production</h3>
            <p class="text-gray-300">{{ $tvshow['production_countries'] }}</p>
          </div>
          @if ($getNetwork != '[]')
            <div class="mb-3">
              <h3 class="font-medium mb-2">Networks</h3>
              <div class="flex flex-wrap gap-6 w-full items-center">
                @foreach ($getNetwork as $network)
                  <a href="/network/{{ $network['link'] }}" class="w-2/5 my-auto">
                    <img src="{{ $network['logo_path'] }}" alt="{{ $network['name'] }}" class="w-2/5 lg:w-full h-full">
                  </a>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- end tv info -->

  <!-- cast-->
  @if ($getCast != '[]')
    <div class="tv-cast container px-3 md:px-8 py-6 mx-auto">
      <div class="flex flex-col mb-6 h-max">
        <h2 class="text-xl md:text-2xl font-semibold mb-3">Cast</h2>
        <div class="flex overflow-x-scroll hide-scroll-bar">
          <div class="flex flex-nowrap gap-4">
            @foreach ($getCast as $cast)
            <div class="inline-block">
              <div class="w-28 md:w-36 lg:w-40 max-w-xs h-max overflow-hidden bg-white rounded-lg">
                <a href="/person/{{ $cast['link'] }}">
                  <img src="{{ $cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="hover:opacity-75 transition:ease-in duration-200">
                </a>
                <div class="mt-2 px-3 pb-2 text-black">
                  <a href="/person/{{ $cast['id'] }}">
                    <p class="text-sm truncate font-semibold hover:text-gray-300">{{ $cast['name'] }}</p>
                  </a>
                  <div class="text-gray-600 text-xs md:text-sm">
                    <p class="truncate">{{ $cast['character'] }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endif
  <!-- end cast-->

  <!-- tv image -->
  @if ($getImage != '[]')
    <div class="tv-images relative bg-white" x-data="{ image: false , image:''}">
      <div class="container mx-auto px-3 md:px-8 py-6">
        <h2 class="text-xl md:text-2xl font-semibold mb-3 text-black">Images</h2>
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
                  <img src="{{ $image['file_path'] }}" alt="{{ $tvshow['name'] }}" class="hover:opacity-75 transition:ease-in duration-200 cursor-pointer">   
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
              <h2 class="text-xl font-medium tracking-wide self-end">{{ $tvshow['name'] }}</h2>
              <button 
                @click="image = false"
                @keydown.escape.window= "image = false"
                class="text-4xl leading-none hover:text-gray-300">&times;
              </button>
            </div>

            <div class="relative overflow-hidden px-40 md:px-64 lg:px-96" style="padding-top: 56.25%;">
              <img :src="image" alt="{{ $tvshow['name'] }}" class="absolute top-0 left-0 w-full h-full">
            </div>
          </div>
        </div> <!-- end image modal-->

      </div>
    </div>
  @endif 
  <!-- end tv image-->

  <!-- recomend tv -->
  @if ($recomendTv != '[]')
    <div class="relative container mx-auto p-8">
      <div class="recomend-tv flex flex-col h-max">
        <h2 class="text-2xl font-semibold">Recomended</h2>
          <div class="flex overflow-x-scroll hide-scroll-bar">
            <div class="flex flex-nowrap gap-4">
              @foreach ($recomendTv as $recomended)
                <div class="inline-block">
                  <div class="w-36 md:w-48 max-w-xs h-max overflow-hidden">
                    <x-tv-card :tvshow="$recomended" />
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      </div>
    </div>
  @endif
  <!-- end recomend tv -->

@endsection