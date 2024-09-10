<?php

namespace App\Models;

use App\Interfaces\Pageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Pageable
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'slug',
        'translated_page_id',
        'parent_page',
        'title',
        'short_desc',
        'descriptions',
        'tags',
        'author',
        'social_card',
        'banner_image',
        'homepage_image',
        'sort_order',
        'is_published',
        'components'
    ];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
        'nova_order_by' => 'DESC',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    protected function casts()
    {
        return [
            'components' => 'array',
            'tags' => 'array',
            'social_card' => 'array',
            'author' => 'array',
            'translated_page_id' => 'array'
        ];
    }

    public function getPageName(): ?string
    {
        return 'Blogs';
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
