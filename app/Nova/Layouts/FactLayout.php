<?php

namespace App\Nova\Layouts;

use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class FactLayout extends Layout
{
    protected $name = 'facts';

    protected $title = 'Facts section with icon image and title';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            Flexible::make('Facts')->addLayout('Facts data', 'facts', [
                Text::make('Count')->required()->rules('required'),
                Image::make('Feature Image', 'image')
                    ->disk('public')
                    ->path('images/components')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp . rand(1111, 9999) . '.' . $request->image->getClientOriginalExtension();
                    })->deletable(),
                Text::make('Description')->required()->rules('required'),
            ])->fullWidth()
        ];
    }
}
