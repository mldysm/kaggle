<x-layout active="datasets">
  <main class="pt-24 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="px-4 mx-auto mt-5 max-w-4xl">
      <div class="relative bg-white dark:bg-gray-800 shadow-md rounded-xl p-8">

        <!-- Tombol Edit & Delete -->
        <div class="absolute top-4 right-4 flex space-x-2">
          <a href="/datasets/{{ $dataset->id_datasets }}/edit" class="p-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
          </svg>
          </a>
            <form action="{{ route('datasets.destroy', $dataset->id_datasets) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this dataset?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-full">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 012 2v0a2 2 0 01-2 2H7a2 2 0 01-2-2v0a2 2 0 012-2h10z"/>
            </svg>
            </button>
          </form>
        </div>

        <a href="/datasets" class="text-blue-600 text-sm hover:underline block mb-4">&laquo; Back to Datasets</a>

        <div class="flex items-center mb-6">
          <img class="w-16 h-16 rounded-full mr-4" src="{{ $dataset->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($dataset->user->name ?? 'User') }}" alt="{{ $competition->user->name ?? 'User' }}">
          <!-- <img class="w-16 h-16 rounded-full mr-4" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="{{ $dataset->user->name }}"> -->
          <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $dataset->user->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">User ID: {{ $dataset->id_user }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $dataset->published }}</p>
          </div>
        </div>

        <div class="mb-4">
          <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
            Dataset ID: {{ $dataset->id }}
          </span>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6">
          {{ $dataset->dataset_name }}
        </h1>

        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed">
          URL: <a href="{{ $dataset->url }}" class="underline text-blue-500" target="_blank">{{ $dataset->url }}</a>
        </p>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
          <strong>Tags:</strong>
          @foreach($dataset->tags as $tag)
            <span class="inline-block bg-gray-200 text-gray-800 rounded px-2 py-1 text-xs mr-1">{{ $tag->name_tag }}</span>
          @endforeach
        </p>
        
        {{-- Tambahan info lain kalau mau --}}
        <p class="mt-4 text-sm text-gray-500">
          Total Downloads: {{ $dataset->total_downloads }} |
          Total Votes: {{ $dataset->total_votes }} |
          Usability Rating: {{ $dataset->usability_rating }}
        </p>

      </div>
    </div>
  </main>
</x-layout>
