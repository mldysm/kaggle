<x-layout active="datasets">
  <x-slot:title>Edit Dataset</x-slot:title>

  <div class="max-w-xl mt-10 mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Dataset</h1>

    <form method="POST" action="{{ route('datasets.update', $dataset->id_datasets) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Dataset Name --}}
      <div class="mb-4">
        <label for="dataset_name" class="block mb-1 font-semibold">Dataset Name</label>
        <input
          type="text"
          name="dataset_name"
          id="dataset_name"
          value="{{ old('dataset_name', $dataset->dataset_name) }}"
          class="w-full border border-gray-300 rounded px-3 py-2"
          required
        >
        @error('dataset_name')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Published Date --}}
      <div class="mb-4">
        <label for="published" class="block mb-1 font-semibold">Published Date</label>
        <input
          type="date"
          name="published"
          id="published"
          value="{{ old('published', $dataset->published) }}"
          class="w-full border border-gray-300 rounded px-3 py-2"
          required
        >
        @error('published')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- PDF File Upload (optional) --}}
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

      {{-- Select Tags as Checkboxes --}}
      @php
        $tags = \App\Models\Tag::all();
        // Ambil old input tags jika ada, kalau tidak pakai selectedTags dari DB
        $oldTags = old('tags', $selectedTags ?? []);
      @endphp

      <div class="mb-4">
        <label class="block mb-1 font-semibold">Select Tags</label>
        <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto border border-gray-300 rounded p-3">
          @foreach($tags as $tag)
            <label class="inline-flex items-center space-x-2">
              <input
                type="checkbox"
                name="tags[]"
                value="{{ $tag->id_tag }}"
                class="form-checkbox h-5 w-5 text-blue-600"
                {{ in_array($tag->id_tag, $oldTags) ? 'checked' : '' }}
              >
              <span>{{ $tag->name_tag }}</span>
            </label>
          @endforeach
        </div>
        @error('tags')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Submit Button --}}
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold"
      >
        Update Dataset
      </button>
    </form>
  </div>
</x-layout>
