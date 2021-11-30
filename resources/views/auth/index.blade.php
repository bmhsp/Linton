@extends('layouts.main')

@section('content')

  <div class="bg-path bg-cover w-screen h-screen fixed">
  </div>

  <div class="relative container mx-auto">
    <div class="flex justify-center px-6 py-12">
      <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <div  class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg" style="background-image: url('https://images.unsplash.com/photo-1515965885361-f1e0095517ea?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3300&q=80')"></div>
        <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none">
          <h3 class="pt-4 text-2xl text-center text-black font-black">Welcome Back!</h3>
          <form class="px-8 pt-6 mb-4 bg-white rounded" action="/authenticate" method="POST">
            @csrf
            <div class="mb-4">
              <div class="mb-4 md:mr-2 md:mb-0">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="username">
                  Username
                </label>
                <input
                  class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                  id="username"
                  type="text"
                  placeholder="Username"
                  name="username"
                />
              </div>
            </div>
            <div class="mb-4">
              <div class="mb-4 md:mr-2 md:mb-0">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                  Password
                </label>
                <input
                  class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                  id="password"
                  type="password"
                  placeholder="*************"
                  name="password"
                />
              </div>
            </div>
            <div class="mb-6 text-center">
              <button class="w-full px-4 py-2 font-bold text-white bg-yellow-400 rounded-full hover:bg-yellow-600 duration-200 focus:outline-none focus:shadow-outline" type="submit">Login</button>
            </div>
            <hr class="mb-6 border-t"/>
            <div class="text-center flex flex-col gap-2">
              <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800" href="/register">Not have an account? Register!</a>
            </div>
          </form>
          <form action="/guest" action="GET">
            @csrf
            <button class="w-full mx-auto text-sm text-blue-500 align-baseline hover:text-blue-800" type="submit">Login as guest</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection