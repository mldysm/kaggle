<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Category;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

        $competitions = Competition::query();

        if ($query) {
            $competitions->where('competition_name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%")
                         ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                 });
        }

        $competitions = $competitions->orderBy('start_date', 'desc')->paginate(9);

        return view('competitions.index', [
            'competitions' => $competitions,
            'query' => $query,
            'active' => 'competitions',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('competitions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'competition_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'prize' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'pdf_file' => 'required|file|mimes:pdf|max:5120',
        'id_user' => 'required|exists:users,id',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:category,id_category',
    ]);

    if ($request->hasFile('pdf_file')) {
        $path = $request->file('pdf_file')->store('pdfs', 'public');
        $validated['url'] = '/storage/' . $path;
    }

    // dd($validated); // <-- Cek validated data

    $competition = Competition::create($validated);

    if (isset($validated['categories'])) {
        $competition->categories()->sync($validated['categories']);
    }

    return redirect()->route('competitions.show', $competition->id_competition)
                     ->with('success', 'Competition created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Eager load relasi categories dan user
        $competition = Competition::with(['categories', 'user'])->findOrFail($id);

        return view('competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $competition = Competition::with('categories')->findOrFail($id);
        $categories = Category::all();

        return view('competitions.edit', compact('competition', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $competition = Competition::findOrFail($id);

    $validated = $request->validate([
        'competition_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'prize' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'total_teams' => 'nullable|integer|min:1',
        'host' => 'nullable|string|max:255',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:category,id_category',
        'pdf_file' => 'nullable|file|mimes:pdf|max:5120', // file PDF opsional saat update
    ]);

    // Jika ada file PDF baru diupload, simpan dan update kolom url
    if ($request->hasFile('pdf_file')) {
        // Simpan file baru
        $path = $request->file('pdf_file')->store('pdfs', 'public');
        $validated['url'] = '/storage/' . $path;

        // (Opsional) Hapus file lama jika perlu
        if ($competition->url) {
            $oldPath = str_replace('/storage/', '', $competition->url);
            \Storage::disk('public')->delete($oldPath);
        }
    }

    // Update data kompetisi
    $competition->update($validated);

    // Sync kategori many-to-many
    if (isset($validated['categories'])) {
        $competition->categories()->sync($validated['categories']);
    } else {
        $competition->categories()->detach();
    }

    return redirect()->route('competitions.show', $competition->id_competition)
                     ->with('success', 'Competition updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);

        // Lepas relasi kategori terlebih dahulu
        $competition->categories()->detach();

        // Hapus kompetisi
        $competition->delete();

        return redirect()->route('competitions.index')
                         ->with('success', 'Competition deleted successfully!');
    }
}
