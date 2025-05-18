<x-layout active="competitions">
  <x-slot:title>Competitions</x-slot:title>

  <div class="py-4 px-4 mt-20 mx-auto max-w-screen-xl lg:py-8 lg:px-0">

    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Competitions</h1>
      <a href="{{ route('competitions.create') }}" class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-blue-700 text-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium">
        Add New
      </a>
    </div>

    <form action="{{ route('competitions.index') }}" method="GET" class="mb-6">
      <input
        type="text"
        name="q"
        value="{{ old('q', $query) }}"
        placeholder="Search {{ ucfirst($active ?? '...') }}"
        class="h-15 w-full rounded-full border border-gray-300 pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500 text-sm"
      />
    </form>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($competitions as $competition)
        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $competition->competition_name }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
        <strong>Host:</strong> {{ $competition->user->name ?? 'Unknown' }}
        </p>

          <p class="text-sm text-gray-600 dark:text-gray-400 mb-1"><strong>Start Date:</strong> {{ $competition->start_date ? \Carbon\Carbon::parse($competition->start_date)->format('d M Y') : '-' }}</p>
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-4"><strong>URL:</strong> <a href="{{ $competition->url }}" target="_blank" class="underline text-blue-500 truncate block max-w-full" title="{{ $competition->url }}">{{ $competition->url }}</a></p>
          <a href="{{ route('competitions.show', $competition->id_competition) }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline text-sm">
            View Competition
            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </a>
        </div>
      @empty
        <p class="col-span-3 text-center text-gray-500">No competitions found.</p>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $competitions->appends(['q' => $query])->links() }}
    </div>
  </div>
</x-layout>
