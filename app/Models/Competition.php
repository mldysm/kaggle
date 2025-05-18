<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $primaryKey = 'id_competition';
    public $timestamps = false;
    protected $fillable = [
        'competition_name',
        'description',
        'prize',
        'start_date',
        'end_date',
        'total_teams',
        'id_user',
        'url',
    ];

    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'competition_category',   // nama tabel pivot
            'id_competition',         // foreign key di tabel pivot untuk model ini (Competition)
            'id_category'             // foreign key di tabel pivot untuk model terkait (Category)
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
