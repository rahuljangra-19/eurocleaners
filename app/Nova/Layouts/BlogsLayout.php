<?php

namespace App\Nova\Layouts;

use App\Models\Page;
use App\Models\Post;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Outl1ne\MultiselectField\Multiselect;
use App\Models\Project;
use Laravel\Nova\Fields\FormData;

class BlogsLayout extends Layout
{
    protected $name = 'blogs';

    protected $title = 'Blogs section with all blogs';

    protected $limit = 1;

    public function fields(): array
    {
        return [];
    }
}
