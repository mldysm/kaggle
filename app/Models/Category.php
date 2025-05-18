<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id_category';
    public function competitions()
    {
        return $this->belongsToMany(
            Competition::class,
            'competition_category',
            'id_category',        // Foreign key di tabel pivot untuk Tag
            'id_competition'    // Foreign key di tabel pivot untuk Dataset2
        );
    }
}
