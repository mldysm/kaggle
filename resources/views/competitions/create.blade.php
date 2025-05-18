<x-layout active="competitions">
  <x-slot:title>Create Competition</x-slot:title>

  <div class="max-w-xl mt-25 mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Create New Competition</h1>

    <form action="{{ route('competitions.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Competition Name --}}
      <div class="mb-4">
        <label for="competition_name" class="block mb-1 font-semibold">Competition Name</label>
        <input
          type="text"
          name="competition_name"
          id="competition_name"
          class="w-full border border-gray-300 rounded px-3 py-2"
          value="{{ old('competition_name') }}"
          required
        >
        @error('competition_name')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Description --}}
      <div class="mb-4">
        <label for="description" class="block mb-1 font-semibold">Description</label>
        <textarea
          name="description"
          id="description"
          rows="4"
          class="w-full border border-gray-300 rounded px-3 py-2"
        >{{ old('description') }}</textarea>
        @error('description')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Prize --}}
      <div class="mb-4">
        <label for="prize" class="block mb-1 font-semibold">Prize</label>
        <input
          type="text"
          name="prize"
          id="prize"
          class="w-full border border-gray-300 rounded px-3 py-2"
          value="{{ old('prize') }}"
        >
        @error('prize')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Start Date --}}
      <div class="mb-4">
        <label for="start_date" class="block mb-1 font-semibold">Start Date</label>
        <input
          type="date"
          name="start_date"
          id="start_date"
          class="w-full border border-gray-300 rounded px-3 py-2"
          value="{{ old('start_date') }}"
        >
        @error('start_date')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- End Date --}}
      <div class="mb-4">
        <label for="end_date" class="block mb-1 font-semibold">End Date</label>
        <input
          type="date"
          name="end_date"
          id="end_date"
          class="w-full border border-gray-300 rounded px-3 py-2"
          value="{{ old('end_date') }}"
        >
        @error('end_date')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Host (User Select) --}}
      @php
        $currentUser = auth()->user();
      @endphp

        <div class="mb-4">
        <label for="host" class="block mb-1 font-semibold">Host</label>
        <input
            type="text"
            id="host"
            class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
            value="{{ $currentUser->name }}"
            readonly
            disabled
        >
        <!-- Input hidden untuk mengirim id_user -->
        <input type="hidden" name="id_user" value="{{ $currentUser->id }}">
        </div>

      {{-- Upload PDF --}}
      <div class="mb-4">
        <label for="pdf_file" class="block mb-1 font-semibold">Upload PDF</label>
        <input
          type="file"
          name="pdf_file"
          id="pdf_file"
          accept="application/pdf"
          class="w-full border border-gray-300 rounded px-3 py-2"
          required
        >
        @error('pdf_file')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Select Categories as Checkboxes --}}
      @php
        $categories = \App\Models\Category::all();
        $oldCategories = old('categories', []);
      @endphp

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Select Categories</label>
        <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto border border-gray-300 rounded p-3">
          @foreach($categories as $category)
            <label class="inline-flex items-center space-x-2">
              <input
                type="checkbox"
                name="categories[]"
                value="{{ $category->id_category }}"
                class="form-checkbox h-5 w-5 text-blue-600"
                {{ in_array($category->id_category, $oldCategories) ? 'checked' : '' }}
              >
              <span>{{ $category->category_name }}</span>
            </label>
          @endforeach
        </div>
        @error('categories')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Submit Button --}}
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold"
      >
        Create Competition
      </button>
    </form>
  </div>
</x-layout>
