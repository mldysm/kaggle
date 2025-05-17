<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaggle</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <nav class="h-22 bg-white shadow px-6 flex items-center fixed top-0 left-0 w-full z-50 transition-shadow duration-300 overflow-x-auto whitespace-nowrap">
  <div class="container mx-auto px-4 flex items-center justify-between w-full">

    <div class="flex items-center space-x-6">
      <img src="{{ asset('images/kaggle_logo.png') }}" alt="Laravel Logo" class="h-10 w-auto">
    </div>

    <div class="flex items-center space-x-2">

    @if (Route::has('login'))
        @auth
        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
            Dashboard
        </a>
    @else
        <a href="{{ route('login') }}" class="px-8 py-3 font-bold text-gray-700 hover:text-sky-500">
            Log in
        </a>

    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="px-8 py-3 bg-black text-white rounded-full font-bold hover:bg-gray-800">
        Register
    </a>
    @endif
    @endauth
    @endif
</div>


  </div>
</nav>


    <div class="container mx-auto px-2 pt-30 min-h-[90vh] flex flex-col-reverse md:flex-row justify-between py-16 gap-10">
        <div class="w-full md:w-1/2 flex flex-col justify-center">
        <h1 class="text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
        Level up with the largest AI & ML community
        </h1>
        <p class="text-lg md:text-xl text-gray-600 mb-8">
        Join over <span class="font-semibold text-gray-900">24M+</span> machine learners to share, stress test, and stay up-to-date on all the latest ML techniques and technologies. Discover a huge repository of community-published models, data & code for your next project.
        </p>
        <div class="flex gap-4">
        <button class="flex items-center gap-2 px-6 py-3 rounded-full border border-gray-300 bg-white shadow-sm text-base font-medium hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
            Register with Google
        </button>
        <a href="{{ route('register') }}" class="px-6 py-3 rounded-full bg-gray-100 text-base font-medium hover:bg-gray-200 transition">
            Register with Email
        </a>
        </div>
    </div>


        <div class="w-full md:w-1/2 flex justify-center">
        <img src="{{ asset('images/dash.png') }}" class="max-w-[700px] w-full h-auto">
    </div>

    </div>



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
