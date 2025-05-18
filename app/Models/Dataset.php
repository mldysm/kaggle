<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = 'dataset_2';
    protected $primaryKey = 'id_datasets';

    protected $fillable = [
        'dataset_name',
        'id_user',
        'total_downloads',
        'total_votes',
        'usability_rating',
        'published',
        'url',
    ];

    // app/Models/Dataset.php
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'dataset_tag', 'id_datasets', 'id_tag');
    }

    public function index()
    {
    $topDatasets = Dataset::orderByDesc('total_downloads')
        ->take(10)
        ->get(['dataset_name', 'total_downloads']);

    return view('datasets.index', compact('topDatasets'));
    }





}
