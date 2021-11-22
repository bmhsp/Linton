@extends('layouts.main')

@include('partials.navbar')

@section('content')
  <div class="container mx-auto px-3 md:px-8 pt-14">
    <div class="popular-person pt-6 mb-3">
      <h1 class="uppercase tracking-wider text-gray-300 text-2xl font-semibold mb-6">Popular People</h1>
      <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">       
        @foreach ($popularPersons as $person)
          <div class="person bg-white rounded-lg overflow-hidden text-black shadow-lg">
            <a href="/person/{{ $person['link'] }}">
              <img src="{{ $person['profile_path'] }}" alt="{{ $person['name'] }}" class="hover:opacity-75 transition ease-in-out duration-200">
            </a>
            <div class="mt-2 px-2 pb-2 text-center">
              <a href="/persons/{{ $person['link'] }}" class="text-xs md:text-base lg:text-lg hover:text-gray-300 font-semibold">
                <p class="truncate">{{ $person['name'] }}</p>
              </a>
              <p class="text-xs md:text-sm truncate text-gray-600">{{ $person['known_for'] }}</p>
            </div>
          </div>   
        @endforeach       
      </div>
    </div> <!-- end popular people -->

    <div class="page-load-status my-8">
      <div class="flex justify-center">
        <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">Error</p>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

  <script>
    let elem = document.querySelector('.grid');
    let infScroll = new InfiniteScroll( elem, {
      // options
      path: '/person/page/@{{#}}',
      append: '.person',
      status: '.page-load-status'
      // history: false,
    });
  </script>
@endsection