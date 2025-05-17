<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Kaggle') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/js/app.js'])
</head>
<body class="relative overflow-visible">
    <x-navbar></x-navbar>
{{ $slot }}
    <!-- <div class="container mx-auto px-2 pt-24 min-h-[90vh] flex flex-col-reverse md:flex-row justify-between py-16 gap-10">
        <div class="w-full md:w-1/2 flex flex-col justify-center">
        <h1 class="text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
        Level up with the largest AI & ML community
        </h1>
        <p class="text-lg md:text-xl text-gray-600 mb-8">
        Join over <span class="font-semibold text-gray-900">24M+</span> machine learners to share, stress test, and stay up-to-date on all the latest ML techniques and technologies. Discover a huge repository of community-published models, data & code for your next project.
        </p>
    </div>


        <div class="w-full md:w-1/2 flex justify-center">
        <img src="{{ asset('images/dash.png') }}" class="max-w-[700px] w-full h-auto">
    </div>

    </div> -->



</body>
</html>

<script>
  window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 10) {
      navbar.classList.add('shadow');
    } else {
      navbar.classList.remove('shadow');
    }
  });
</script>
