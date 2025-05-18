<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;
use App\Models\Tag;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

       $datasets = Dataset::when($query, function ($q) use ($query) {
        $q->where('dataset_name', 'like', '%' . $query . '%');
    })->paginate(20);

    return view('datasets.datasets', compact('datasets', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all(); // ambil semua tag dari DB
        return view('datasets.create', compact('tags'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dataset_name' => 'required|string',
            'published' => 'required|date',
            'pdf_file' => 'required|mimes:pdf',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id_tag',
        ]);

        // simpan PDF
        $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');

        // buat dataset
        $dataset = Dataset::create([
            'dataset_name' => $request->dataset_name,
            'published' => $request->published,
            'url' => '/storage/' . $pdfPath,
            'id_user' => auth()->id(),
        ]);

        // simpan relasi tags
        foreach ($request->tags as $tagId) {
            \DB::table('dataset_tag')->insert([
                'id_datasets' => $dataset->id_datasets,
                'id_tag' => $tagId,
            ]);
        }

        return redirect()->route('datasets.show', $dataset->id_datasets)->with('success', 'Dataset created.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataset = Dataset::with('user')->findOrFail($id); // dengan relasi ke user
        return view('datasets.dataset', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataset = Dataset::findOrFail($id);
        $tags = Tag::all();

        // Ambil tag yang sudah dipilih sebelumnya
        $selectedTags = $dataset->tags()->pluck('tags.id_tag')->toArray();

        return view('datasets.edit', compact('dataset', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'dataset_name' => 'required|string',
            'published' => 'required|date',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id_tag',
            'pdf_file' => 'nullable|mimes:pdf',
        ]);

        $dataset = Dataset::findOrFail($id);
        $dataset->dataset_name = $request->dataset_name;
        $dataset->published = $request->published;

        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');
            $dataset->url = '/storage/' . $pdfPath;
        }

        $dataset->save();

        // sync tag baru
        $dataset->tags()->sync($request->tags);

        return redirect()->route('datasets.show', $dataset->id_datasets)
            ->with('success', 'Dataset updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $dataset = Dataset::findOrFail($id);

    // Hapus relasi tags terlebih dahulu agar constraint tidak gagal
    $dataset->tags()->detach();

    // Jika ada file PDF yang diupload, hapus filenya dari storage (opsional)
    if ($dataset->pdf_file_path) {
        \Storage::disk('public')->delete($dataset->pdf_file_path);
    }

    // Hapus dataset
    $dataset->delete();

    return redirect()->route('datasets.index')
                     ->with('success', 'Dataset deleted successfully.');
}

public function search(Request $request)
    {
        $query = $request->input('q');

        $results = Dataset::where('dataset_name', 'like', "%{$query}%")->get();

        return view('datasets.search_results', compact('results', 'query'));
    }


}
