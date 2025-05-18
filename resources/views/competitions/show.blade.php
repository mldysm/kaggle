<x-layout active="competitions">
  <main class="pt-24 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="px-4 mx-auto mt-5 max-w-4xl">
      <div class="relative bg-white dark:bg-gray-800 shadow-md rounded-xl p-8">

        <!-- Tombol Edit & Delete -->
        <div class="absolute top-4 right-4 flex space-x-2">
          <a href="{{ route('competitions.edit', $competition->id_competition) }}" class="p-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full" title="Edit Competition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
          </a>
          <form action="{{ route('competitions.destroy', $competition->id_competition) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this competition?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-full" title="Delete Competition">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 012 2v0a2 2 0 01-2 2H7a2 2 0 01-2-2v0a2 2 0 012-2h10z"/>
              </svg>
            </button>
          </form>
        </div>

        <a href="{{ route('competitions.index') }}" class="text-blue-600 text-sm hover:underline block mb-4">&laquo; Back to Competitions</a>

        <div class="flex items-center mb-6">
          <img class="w-16 h-16 rounded-full mr-4" src="{{ $competition->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($competition->user->name ?? 'User') }}" alt="{{ $competition->user->name ?? 'User' }}">
          <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Hosted by: </p>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $competition->user->name ?? '-' }}</h3>
          </div>
        </div>

        <div class="mb-4">
          <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
            Competition ID: {{ $competition->id_competition }}
          </span>
        </div>

        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6">
          {{ $competition->competition_name }}
        </h1>

        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed mb-4">
          {{ $competition->description }}
        </p>

        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed mb-4">
          Prize: <strong>{{ $competition->prize }}</strong>
        </p>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
          <strong>Start Date:</strong> {{ $competition->start_date ? \Carbon\Carbon::parse($competition->start_date)->format('d M Y') : '-' }}
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
          <strong>End Date:</strong> {{ $competition->end_date ? \Carbon\Carbon::parse($competition->end_date)->format('d M Y') : '-' }}
        </p>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
          <strong>Total Teams:</strong> {{ $competition->total_teams ?? '-' }}
        </p>

        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed mb-4">
          URL: <a href="{{ $competition->url }}" class="underline text-blue-500" target="_blank">{{ $competition->url }}</a>
        </p>

        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
        <strong>Categories:</strong>
        @foreach($competition->categories as $category)
            <span class="inline-block bg-gray-200 text-gray-800 rounded px-2 py-1 text-xs mr-1">
            {{ $category->category_name }}
            </span>
        @endforeach
        </p>






        {{-- Tambahan info lain --}}
        {{-- Contoh statistik atau info tambahan --}}
        <p class="mt-4 text-sm text-gray-500">
          {{-- Contoh: Total Participants: {{ $competition->participants_count ?? 'N/A' }} --}}
        </p>

      </div>
    </div>
  </main>
</x-layout>
