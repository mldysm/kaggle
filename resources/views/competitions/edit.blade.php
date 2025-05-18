<x-layout active="competitions">
  <x-slot:title>Edit Competition</x-slot:title>

  <div class="max-w-xl mt-25 mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Competition</h1>

    <form enctype="multipart/form-data" action="{{ route('competitions.update', $competition->id_competition) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Competition Name --}}
      <div class="mb-4">
        <label for="competition_name" class="block mb-1 font-semibold">Competition Name</label>
        <input
          type="text"
          name="competition_name"
          id="competition_name"
          class="w-full border border-gray-300 rounded px-3 py-2"
          value="{{ old('competition_name', $competition->competition_name) }}"
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
        >{{ old('description', $competition->description) }}</textarea>
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
          value="{{ old('prize', $competition->prize) }}"
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
          value="{{ old('start_date', $competition->start_date) }}"
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
          value="{{ old('end_date', $competition->end_date) }}"
        >
        @error('end_date')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Total Teams --}}
      <!-- <div class="mb-4">
        <label for="total_teams" class="block mb-1 font-semibold">Total Teams</label>
        <input
          type="number"
          name="total_teams"
          id="total_teams"
          min="1"
          class="w-full border border-gray-300 rounded px-3 py-2"
          value="{{ old('total_teams', $competition->total_teams) }}"
        >
        @error('total_teams')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div> -->

      {{-- Host --}}
<div class="mb-4">
  <label for="host" class="block mb-1 font-semibold">Host</label>
  <input
    type="text"
    id="host"
    class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
    value="{{ old('host', $competition->user->name ?? 'Unknown') }}"
    readonly
    disabled
  >
</div>


      {{-- URL --}}
      <div class="mb-4">
        <label for="pdf_file" class="block mb-1 font-semibold">Replace PDF (optional)</label>
        <input
          type="file"
          name="pdf_file"
          id="pdf_file"
          accept="application/pdf"
          class="w-full border border-gray-300 rounded px-3 py-2"
        >
        @error('pdf_file')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Categories Checkbox --}}
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
                {{ in_array($category->id_category, old('categories', $competition->categories->pluck('id_category')->toArray())) ? 'checked' : '' }}
              >
              <span>{{ $category->category_name }}</span>
            </label>
          @endforeach
        </div>
        @error('categories')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Submit --}}
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold"
      >
        Update Competition
      </button>
    </form>
  </div>
</x-layout>
