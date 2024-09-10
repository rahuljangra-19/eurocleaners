<?php

namespace App\Nova\Layouts;

use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Murdercode\TinymceEditor\TinymceEditor;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class AboutLayout extends Layout
{
    protected $name = 'about';

    protected $title = 'About section with tile and Image left side';

    protected $limit = 1;

    public function fields(): array
    {
        return [

            Text::make('H2 Title', 'h2_title')->rules('required'),
            Text::make('Name')->required()->rules('required'),
            Text::make('Profile')->required()->rules('required'),
            Image::make('Feature Image', 'image')
                ->disk('public')
                ->path('images/components')
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . rand(0000, 9999) . '.' . $request->image->getClientOriginalExtension();
                }),
            Image::make('Signature Image', 'sign_image')
                ->disk('public')
                ->path('images/components')
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . rand(0000, 9999) . '.' . $request->sign_image->getClientOriginalExtension();
                }),
            TinymceEditor::make('Description')->required()
                ->stacked()
                ->fullWidth(),
        ];
    }
}
