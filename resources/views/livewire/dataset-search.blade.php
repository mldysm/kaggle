<div>
    <input
        type="text"
        wire:model.debounce.300ms="search"
        placeholder="Search datasets..."
        class="w-full mb-6 rounded border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500"
    />

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($datasets as $dataset)
            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                    {{ $dataset->dataset_name }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                    <strong>By:</strong> {{ $dataset->user->name ?? 'Unknown User' }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                    <strong>Published:</strong> {{ $dataset->published }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    <strong>URL:</strong>
                    <a href="{{ $dataset->url }}" class="underline text-blue-500 block truncate max-w-full" target="_blank" title="{{ $dataset->url }}">
                        {{ $dataset->url }}
                    </a>
                </p>
                <a href="/datasets/{{ $dataset->id_datasets }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline text-sm">
                    View Dataset
                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No datasets found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $datasets->links() }}
    </div>
</div>
