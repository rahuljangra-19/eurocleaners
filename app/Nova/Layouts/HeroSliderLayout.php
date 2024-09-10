<?php

namespace App\Nova\Layouts;

use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class HeroSliderLayout extends Layout
{
    protected $name = 'hero-slider';

    protected $title = 'Slider with image title and description';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            Flexible::make('Slides')
                ->addLayout(
                    'Hero Slider Slide',
                    'hero-slides',
                    [
                        Text::make('Title', 'title')->required()->rules('required'),
                        Image::make('Feature Image', 'image')
                            ->disk('public')
                            ->path('images/components')
                            ->storeAs(function (NovaRequest $request) {
                                return Carbon::now()->timestamp . rand(0000, 9999) . '.' . $request->image->getClientOriginalExtension();
                            }),
                        Textarea::make('Description')->required()->rules('required'),
                    ]
                )->fullWidth()
        ];
    }
}
