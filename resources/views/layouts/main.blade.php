<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Linton</title>
  <link rel="icon" href="/img/logo.png">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="Stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  @livewireStyles
</head>

  <body class="bg-gray-900 text-white font-sans h-full">
    
    @yield('content')

    @livewireScripts
      
    @yield('scripts')

    @include('partials.footer')

    <!-- fill navbar on scroll -->
    <script>
      window.onscroll = function() {
        fillNavbar();
      };
  
      function fillNavbar() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
          document.getElementById("navbar").classList.add("bg-gray-900", "duration-300", "ease-in-out");
        } else {
          document.getElementById("navbar").classList.remove("bg-gray-900");
        }
      }
    </script>
    
  </body>
</html>