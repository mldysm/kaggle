<x-layout active="users">
  <x-slot:title>Users List</x-slot:title>

  <div class=" container mt-25 max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
    <h1 class="text-2xl font-bold mb-6">Users List</h1>

<form action="{{ route('user') }}" method="GET" class="mb-6">
  <input
    type="text"
    name="q"
    value="{{ old('q', $query) }}"
    placeholder="Search {{ ucfirst($active ?? '...') }}"
    class="h-15 w-full rounded-full border border-gray-300 pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500 text-sm"
  />
</form>


    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">#</th>
            <th class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">Name</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($users as $index => $user)
            <tr class="hover:bg-gray-100">
              <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $index + 1 }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $user->name }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
      {{ $users->links() }}
    </div>
  </div>
</x-layout>
