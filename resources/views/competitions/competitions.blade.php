<x-layout active="competitions">
  <x-slot:title>Competitions</x-slot:title>

  <div class="py-4 px-4 mt-20 mx-auto max-w-screen-xl lg:py-8 lg:px-0">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Competitions</h1>
      <a href="/competitions/create" 
        class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-blue-700 text-white dark:bg-blue-500 dark:hover:bg-blue-600 text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        Add New
        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
      </a>

    </div>
    
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @foreach(range(1, 6) as $i)
      <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Competitions {{ $i }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. 
        </p>
        <a href="/competitions/competition" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline text-sm">
          View Competitions
          <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</x-layout>
