<?php

namespace App\Nova\Layouts;

use App\Models\Service;
use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\MultiselectField\Multiselect;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;
use Murdercode\TinymceEditor\TinymceEditor;

class SingleProjectLayout extends Layout
{
    protected $name = 'single-project';

    protected $title = 'single project details page ( show complete project details ) ';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            URL::make('Video Link', 'video_link')->required()->fullWidth()
                ->rules('required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/')
                ->help('Link look likes https://www.youtube.com/embed/D0EjoNy2-Ys <a href="https://www.w3schools.com/html/html_youtube.asp" target="_blank">view</a>'),
            Image::make('Video Thumbnail Image', 'image')
                ->disk('public')
                ->path('images/components')
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . '.' . $request->image->getClientOriginalExtension();
                })->fullWidth(),
            Text::make('H1 Title', 'h1_title')->required()->fullWidth()->rules('required'),
            Textarea::make('H1 details', 'h1_description')->required()->hideFromIndex()->fullWidth()->rules('required'),
            Text::make('Description Title', 'title')->required()->fullWidth()->rules('required'),
            TinymceEditor::make('Project details', 'details')->required()->rules('required')
                ->stacked()
                ->fullWidth(),
            Text::make('Questions Title', 'ques_title')->required()->fullWidth()->rules('required'),
            Text::make('Client Name', 'name')->required()->rules('required')->fullWidth(),
            Text::make('Project Value', 'value')->required()->rules('required')->fullWidth(),
            Text::make('Date', 'date')->rules('required')->required()->fullWidth(),
            Flexible::make('Questions')->addLayout('Questions', 'question', [
                Text::make('Question')->required()->fullWidth(),
                Text::make('Answer')->required()->fullWidth(),
            ])->fullWidth()->button('Add Questions')
        ];
    }
}
