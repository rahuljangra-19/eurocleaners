<?php

namespace App\Nova\Layouts;

use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class PageTitleLayout extends Layout
{ 
    protected $name = 'page-title';

    protected $title = 'Page title section with title description and feature image';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            Text::make('Title', 'title')->required()->rules('required'),
            Image::make('Feature Image', 'image')
                ->disk('public')
                ->path('images/components')
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . '.' . $request->image->getClientOriginalExtension();
                }),
            Textarea::make('Description')->required()->rules('required'),
        ];
    }
}
