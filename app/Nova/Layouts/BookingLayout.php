<?php

namespace App\Nova\Layouts;

use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class BookingLayout extends Layout
{
    protected $name = 'booking';

    protected $title = 'Booking section with image and title ';

    protected $limit = 1;

    public function fields(): array
    {
        return [
          
                Text::make('Calender Title')->required()->rules('required'),
                Text::make('Delivery Title')->required()->rules('required'),
                Text::make('Problem Title')->required()->rules('required'),
                Image::make('Calender Feature Image', 'calender_image')
                    ->disk('public')
                    ->path('images/components')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp.random_int(00000,9999) . '.' . $request->calender_image->getClientOriginalExtension();
                    }),
                Image::make('Delivery Feature Image', 'delivery_image')
                    ->disk('public')
                    ->path('images/components')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp.random_int(00000,9999) . '.' . $request->delivery_image->getClientOriginalExtension();
                    }),
                Image::make('Problem Feature Image', 'problem_image')
                    ->disk('public')
                    ->path('images/components')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp.random_int(00000,9999) . '.' . $request->problem_image->getClientOriginalExtension();
                    }),

        ];
    }
}
