<?php

namespace App\Nova;

use App\Models\Component as ModelsComponent;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Nova\Filters\ComponentLanguageFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Panel;

class Component extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Component>
     */
    public static $model = \App\Models\Component::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'title',
        'description'
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereHas('language', function ($q) {
            $q->whereNull('deleted_at');
        });
    }


    public static $clickAction = 'edit';

    function getfooterFields()
    {
        return [
            Json::make('items', [
                Textarea::make('About Us', 'about_us')->required()->rules('required'),
                URL::make('Facebook URL', 'facebook')->required()->rules('required'),
                URL::make('Twitter URL', 'twitter')->required()->rules('required'),
                URL::make('Instagram URL', 'insta')->required()->rules('required'),
                URL::make('Google URL', 'google')->required()->rules('required'),
                Email::make('Contact Email', 'contact_email')->required()->rules('required'),
                Text::make('Contact Number', 'phone')->required()->rules('required'),
                Textarea::make('Address', 'address')->required()->rules('required'),
            ])
        ];
    }

    function getTopbarFields()
    {
        return [
            Json::make('items', [
                Text::make('Working Days', 'working_days')->required()->placeholder('Sun - Fri')->rules('required'),
                Text::make('Working Time', 'working_time')->required()->placeholder('8:00 Am - 7:00 Pm ,  24 Hours Open')->rules('required'),
                Text::make('Contact Number', 'phone')->required()->rules('required'),
                Image::make('Clock Image', 'image')
                    ->placeholder('dimensions:width=50,height=50')
                    ->disk('public')
                    ->path('images/components')
                    ->storeAs(function (NovaRequest $request) {
                        return 'clock.jpg';
                        return Carbon::now()->timestamp . '.jpg';
                    })->required()
            ])
        ];
    }

    public function getContactBoxFields()
    {
        return [
            Json::make('items', [
                Text::make('Title')->required()->rules('required')->rules('required'),
                Textarea::make('Description')->required()->rules('required')->rules('required'),

            ])
        ];
    }

    public function getSocialCardFields()
    {
        return [
            Json::make('items', [
                Text::make('Name')->required()->rules('required'),
                Image::make('Image', 'image')->required()->hideFromIndex()
                    ->disk('public')
                    ->path('images/components')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp . '_profile.jpg';
                    }),
                Textarea::make('Description')->required()->rules('required'),
                Text::make('Google Link', 'google_link'),
                Text::make('FaceBook', 'fb_link'),
                Text::make('Instagram', 'insta_link'),
                Text::make('Twitter', 'twitter_link'),
                Text::make('Pinterest', 'pine_link'),
                Text::make('LinkedIn', 'linkedin_link'),
            ])
        ];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return [
            ID::make()->sortable(),
            BelongsTo::make('Language', 'Language', Language::class),
            Text::make('Title'),
            Boolean::make('is_published'),
        ];
    }

    public function fieldsForIndex(NovaRequest $request)
    {

        return [
            ID::make()->sortable(),
            BelongsTo::make('Language', 'Language', Language::class),
            Text::make('Title'),
            Boolean::make('is_published'),

        ];
    }

    // public function fieldsForCreate(NovaRequest $request)
    // {
    //     return [
    //         Multiselect::make('Select Component', 'items')
    //             ->required()
    //             ->options(['footer' => 'Footer', 'top-bar' => 'Top Bar'])
    //             ->singleSelect()
    //             ->hideFromDetail()
    //             ->hideFromIndex(),

    //         BelongsTo::make('Language', 'Language', Language::class),
    //         Text::make('Title'),
    //         Markdown::make('Description'),
    //         Boolean::make('Is Published'),

    //         // Conditionally display fields for 'footer'
    //         Json::make('items', $this->getfooterFields())->when(function ($request) {
    //             return $request->get('items') === 'footer';
    //         }),

    //         // Conditionally display fields for 'top-bar'
    //         Json::make('items', $this->getTopbarFields())->when(function ($request) {
    //             return $request->get('items') === 'top-bar';
    //         }),
    //     ];
    // }


    public function fieldsForUpdate(NovaRequest $request)
    {
        // dd($request);
        $resourceId =   $request->resourceId;
        $component = $this->getComponentDetails($resourceId);

        if ($component) {
            return  $this->getAllFields($component);
        }
    }

    public function getComponentDetails($resourceId)
    {
        $result  = ModelsComponent::find($resourceId);

        return $result ? $result->name : null;
    }


    public function getAllFields($component)
    {
        $componentFields = [
            'footer' => [
                new Panel('Footer', $this->getfooterFields())
            ],
            'top-bar' => [
                new Panel('Top Bar', $this->getTopbarFields())
            ],
            'contact-box' => [
                new Panel('Contact Box', $this->getContactBoxFields())

            ],
            'social-card' => [

                new Panel('Social Card', $this->getSocialCardFields())
            ]
        ];

        $fields =  $componentFields[$component] ?? [];

        return array_merge([
            BelongsTo::make('Language', 'Language', Language::class)->readonly(),
            Text::make('Title')->required()->rules('required'),
            // Markdown::make('Description'),
            Boolean::make('Is Published')
        ], $fields);
    }




    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new ComponentLanguageFilter()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
