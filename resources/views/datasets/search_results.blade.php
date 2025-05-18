<x-layout>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Search Results for "{{ $query }}"</h1>

        @if($results->isEmpty())
            <p>No datasets found matching your query.</p>
        @else
            <ul class="space-y-4">
                @foreach($results as $dataset)
                    <li class="border p-4 rounded shadow">
                        <h2 class="text-xl font-semibold">{{ $dataset->dataset_name }}</h2>
                        {{-- Tambahkan info lain jika perlu --}}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</x-layout>