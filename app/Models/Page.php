<?php

namespace App\Models;

use App\Interfaces\Pageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class Page extends Model implements Sortable, Pageable
{
    use HasFactory, SoftDeletes, SortableTrait, HasFlexible;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'description',
        'meta_title',
        'meta_description',
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
        return $this->belongsTo(Language::class)->withTrashed();
    }

    protected function casts()
    {
        return [
            'components' => 'array',
            'translated_page_id' => 'array'
        ];
    }

  

    public function getPageName(): ?string
    {
        return $this->page_name;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public static function toDropdownArray(): array
    {
        return self::pluck('name', 'type')->toArray();
    }
}
