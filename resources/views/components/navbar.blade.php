@props(['active' => null])

<nav class="h-22 bg-white shadow px-6 flex items-center fixed top-0 left-0 w-full z-50 transition-shadow duration-300 overflow-x-auto whitespace-nowrap">
  <div class="container mx-auto px-4 flex items-center justify-between w-full">
    <div class="flex items-center space-x-6">
    <a href="/dashboard">
      <img src="{{ asset('images/kaggle_logo.png') }}" alt="Laravel Logo" class="h-10 w-auto">
    </a>
      <ul class="pl-6 hidden md:flex space-x-6 text-gray-700 font-medium">
        <li><a href="/competitions" class="text-[18px] hover:text-sky-500 {{ $active === 'competitions' ? 'text-sky-500 font-semibold' : 'text-gray-500' }}">
          Competitions
        </a></li>
        <li><a href="/datasets" class="text-[18px] hover:text-sky-500 {{ $active === 'datasets' ? 'text-sky-500 font-semibold' : 'text-gray-500' }}">
          Datasets
        </a></li>
        <li><a href="/users" class="text-[18px] hover:text-sky-500 {{ $active === 'users' ? 'text-sky-500 font-semibold' : 'text-gray-500' }}">
          Users
        </a></li>
        <li><a href="#" class="text-[18px] hover:text-sky-500 {{ $active === 'models' ? 'text-sky-500 font-semibold' : 'text-gray-500' }}">
          Models
        </a></li>
        <li><a href="#" class="text-[18px] hover:text-sky-500 {{ $active === 'code' ? 'text-sky-500 font-semibold' : 'text-gray-500' }}">
          Code
        </a></li>
        <li><a href="#" class="text-gray-500 text-[18px] hover:text-sky-500">Discussions</a></li>
        <li><a href="#" class="text-gray-500 text-[18px] hover:text-sky-500">Blog</a></li>
        <li><a href="#" class="text-gray-500 text-[18px] hover:text-sky-500">Courses</a></li>
      </ul>
    </div>

  


    <div class="flex items-center space-x-2">
    <div x-data="{ open: false }" class="relative">
  <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none px-4 py-2 rounded-md hover:bg-gray-100">
    <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'User' }}</span>
    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Tambahkan fixed dan top-20 biar melayang -->
  <div
    x-show="open"
    @click.away="open = false"
    class="fixed right-[100px] top-20 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-[9999] py-1"
  >
    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</button>
    </form>
  </div>
</div>

  </div>
  </div>
</nav>