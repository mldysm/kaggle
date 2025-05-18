<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = 'id_tag';

    public function datasets()
    {
        return $this->belongsToMany(
            Dataset::class,
            'dataset_tag',
            'id_tag',        // Foreign key di tabel pivot untuk Tag
            'id_datasets'    // Foreign key di tabel pivot untuk Dataset2
        );
    }

}
