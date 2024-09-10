<?php

namespace App\Nova;

use App\Models\CountryFlag;
use App\Models\Language as ModelsLanguage;
use Armincms\Json\Json;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\MultiselectField\Multiselect;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Panel;

class Language extends Resource
{
    /**
     * The model the resource corresponds to. 
     *
     * @var class-string<\App\Models\Language>
     */
    public static $model = \App\Models\Language::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string 
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name'
    ];

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
            Text::make('language', 'name')->required()->rules(['required', Rule::unique('languages')->where(function ($query) {
                return $query->where('name', $this->name);
            })->ignore($this->id)])->sortable(),
            Text::make('language Code', 'code')->required()->rules(['required', Rule::unique('languages')->where(function ($query) {
                return $query->where('code', $this->name);
            })->ignore($this->id)]),
            Image::make('Icon Image', 'icon')->required()
                ->disk('public')
                ->path('images/icons')
                ->storeAs(function (NovaRequest $request) {
                    return  $request->icon->getClientOriginalName();
                })->hideFromIndex(),
            Boolean::make('Is Default', 'is_default'),

            new Panel('Language Meta Keywords', [
                Json::make('meta', [
                    Text::make('Welcome', 'welcome')->required()->rules('required'),
                    Text::make('About Us', 'about')->required()->rules('required'),
                    Text::make('Latest Post', 'latest_posts')->required()->rules('required'),
                    Text::make('Contact Btn', 'contact_btn')->required()->rules('required'),
                    Text::make('Services', 'services')->required()->rules('required'),
                    Text::make('Projects', 'projects')->required()->rules('required'),
                    Text::make('Contact')->required()->rules('required'),
                    Text::make('Book Online', 'book_online')->required()->rules('required'),
                ])
            ]) 

        ];
    }


    public static function afterUpdate(NovaRequest $request, Model $model)
    {
        if ($model->is_default) {
            ModelsLanguage::whereNot('id', $model->id)->update(['is_default' => false]);
        }
    }

    public static function afterCreate(NovaRequest $request, Model $model)
    {
        DB::table('components')->insert(['name' => 'footer', 'title' => 'Footer for ' . $model->name, 'description' => 'Footer', 'language_id' => $model->id]);
        DB::table('components')->insert(['name' => 'top-bar', 'title' => 'Top bar with phone and time for ' . $model->name, 'description' => 'Top bar ', 'language_id' => $model->id]);
        DB::table('components')->insert(['name' => 'social-card', 'title' => 'Social Card for ' . $model->name, 'description' => 'Social-card', 'language_id' => $model->id]);
        DB::table('components')->insert(['name' => 'contact-box', 'title' => 'Contact-box with Title and description for ' . $model->name, 'description' => 'Contact-box ', 'language_id' => $model->id]);
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
        return [];
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
