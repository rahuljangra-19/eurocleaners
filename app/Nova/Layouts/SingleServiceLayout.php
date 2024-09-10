<?php

namespace App\Nova\Layouts;

use App\Models\Service;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\MultiselectField\Multiselect;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Murdercode\TinymceEditor\TinymceEditor;

class SingleServiceLayout extends Layout
{
    protected $name = 'single-service';

    protected $title = 'single service details page ( show complete service details ) ';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            Image::make('Feature Image', 'image')
                ->disk('public')
                ->path('images/components')
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . '.' . $request->image->getClientOriginalExtension();
                })->fullWidth(),
            Text::make('Description Title', 'title')->required()->fullWidth()->rules('required'),
            TinymceEditor::make('Service details','details')->required()->rules('required')
                ->stacked()
                ->fullWidth(),
            Text::make('Questions Title', 'ques_title')->required()->fullWidth()->rules('required'),
            Flexible::make('Questions')->addLayout('Questions', 'question', [
                Text::make('Question')->required()->fullWidth(),
                Text::make('Answer')->required()->fullWidth(),
            ])->fullWidth()->button('Add Questions')
        ];
    }
}
 
