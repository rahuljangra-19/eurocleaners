<?php

namespace App\Nova\Layouts;

use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Murdercode\TinymceEditor\TinymceEditor;

class ContactLayout extends Layout
{
    protected $name = 'contact';

    protected $title = 'Contact us section';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            Textarea::make('Address')->required()->rules('required')->fullWidth(),
            Text::make('Email us', 'email')->required()->rules('required')->fullWidth(),
            Text::make('Phone', 'phone')->required()->rules('required')->fullWidth(),
            Text::make('Have Any Question', 'quest_title')->required()->rules('required')->fullWidth(),
            TinymceEditor::make('Question Description', 'ques_desc')->required()->rules('required')
                ->stacked()
                ->fullWidth(),
            Text::make('Submit button Text', 'submit_button')->required()->rules('required')->fullWidth(),

            Text::make('Google Map Iframe', 'google_link')->required()->help('Note: How to create or get iframe link <a target="_blank" href="https://extension.umaine.edu/plugged-in/technology-marketing-communications/web/tips-for-web-managers/embed-map/">Click Here</a>')->fullWidth(),

        ];
    }
}
