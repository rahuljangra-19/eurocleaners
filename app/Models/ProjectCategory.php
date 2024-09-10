<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'is_published'
    ];

    
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
