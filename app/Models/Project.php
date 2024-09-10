<?php

namespace App\Models;

use App\Interfaces\Pageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model implements Pageable
{
    use HasFactory;


    protected function casts()
    {
        return [
            'components' => 'array',
            'translated_page_id' => 'array'
        ];
    }

    
    public function language()
    {
        return $this->belongsTo(Language::class);
    }


    public function getPageName(): ?string
    {
        return 'Project';
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
