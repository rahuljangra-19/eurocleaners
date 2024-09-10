<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Client\Request;

class Component extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'description',
        'items',
        'is_published'
    ];

    protected $casts = [
        'items' => 'array',

    ];


    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    // public function pages()
    // {
    //     return $this->belongsToMany(Page::class, 'page_components');
    // }
}
