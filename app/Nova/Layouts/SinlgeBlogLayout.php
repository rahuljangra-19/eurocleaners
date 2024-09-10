<?php

namespace App\Nova\Layouts;

use App\Models\Service;
use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Outl1ne\MultiselectField\Multiselect;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Murdercode\TinymceEditor\TinymceEditor;

class SingleBlogLayout extends Layout
{
    protected $name = 'single-blog';

    protected $title = 'Blog details page ( show complete blog details ) ';

    protected $limit = 1;

    public function fields(): array
    {
        return [
            Image::make('Image', 'image')
                ->disk('public')
                ->path('images/posts')
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . '.' . $request->image->getClientOriginalExtension();
                })->fullWidth(),
            Textarea::make('Thought in your mind', 'thought')->hideFromIndex()->fullWidth(),
            TinymceEditor::make('Description', 'desc_first')->required()->rules('required')->hideFromIndex()
                ->stacked()
                ->fullWidth(),
            TinymceEditor::make('Description', 'desc_second')->required()->rules('required')
                ->stacked()->hideFromIndex()
                ->fullWidth(),
            Flexible::make('Author Details')->addLayout('Author Details', 'author', [
                Text::make('Name')->required()->rules('required')->hideFromIndex(),
                Image::make('Image', 'image')->required()->hideFromIndex()
                    ->disk('public')
                    ->path('images/posts')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp . 'author.jpg';
                    }),
                Textarea::make('Description', 'desc')->required()->rules('required')->hideFromIndex(),
                Text::make('Google Link', 'google_link')->hideFromIndex(),
                Text::make('FaceBook', 'fb_link')->hideFromIndex(),
                Text::make('Instagram', 'insta_link')->hideFromIndex(),
                Text::make('Twitter', 'twitter_link')->hideFromIndex(),
            ])->fullWidth()->button('Add Author Details')->limit(1),


        ];
    }


    public function authorFields()
    {
        return [

            Text::make('Name')->required()->rules('required')->hideFromIndex(),
            Image::make('Image', 'image')->required()->hideFromIndex()
                ->disk('public')
                ->path('images/posts')
                ->storeAs(function (NovaRequest $request) {

                    return Carbon::now()->timestamp . '.jpg';
                }),
            Textarea::make('Description')->required()->rules('required')->hideFromIndex(),
            Text::make('Google Link', 'google_link')->required()->rules('required')->hideFromIndex(),
            Text::make('FaceBook', 'fb_link')->required()->rules('required')->hideFromIndex(),
            Text::make('Instagram', 'insta_link')->required()->rules('required')->hideFromIndex(),
            Text::make('Twitter', 'twitter_link')->required()->rules('required')->hideFromIndex(),
        ];
    }
}
