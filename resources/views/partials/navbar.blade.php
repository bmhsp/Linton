<div class="fixed z-50 w-full bg-gray-900">
  <div class="antialiased">
    <div class="w-full text-gray-300">
      <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-3 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between p-4">
          <a href="/" class="text-lg font-semibold tracking-widest uppercase text-white focus:outline-none">LIN.<span class="text-yellow-400">TON</span></a>
          <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
              <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
              <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
          <a class="{{ (request()->is('movies*')) ? 'text-yellow-500' : '' }} px-4 md:px-0 lg:px-4 uppercase py-2 mt-2 text-xs font-semibold md:mt-0 md:ml-4 hover:text-yellow-500 duration-200 focus:outline-none" href="/movies">Movies</a>
          <a class="{{ (request()->is('tv*')) ? 'text-yellow-500' : '' }} px-4 md:px-0 lg:px-4 uppercase py-2 mt-2 text-xs font-semibold md:mt-0 md:ml-4 hover:text-yellow-500 duration-200 focus:outline-none" href="/tv">TV Shows</a>
          <a class="{{ (request()->is('person*')) ? 'text-yellow-500' : '' }} px-4 md:px-0 lg:px-4 uppercase py-2 mt-2 text-xs font-semibold md:mt-0 md:ml-4 hover:text-yellow-500 duration-200 focus:outline-none md:mr-2 lg:mr-0" href="/person">People</a>
          <livewire:search-dropdown>    
        </nav>
      </div>
    </div>
  </div>
</div>