<?php

namespace App\Nova;

use App\Nova\Layouts\PageTitleLayout;
use App\Nova\Layouts\SingleServiceLayout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Outl1ne\MultiselectField\Multiselect;
use Whitecube\NovaFlexibleContent\Flexible;
use App\Models\Service as ModelsServices;
use App\Models\Language as ModelsLanguage;
use App\Nova\Filters\ServiceLanguageFilter;

class Service extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Service>
     */
    public static $model = \App\Models\Service::class;

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
        'title'
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereHas('language', function ($q) {
            $q->whereNull('deleted_at');
        });
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
            BelongsTo::make('Language', 'Language', Language::class)->sortable()->withoutTrashed(),
            Text::make('Title')->required()->rules('required', 'max:255')
                ->creationRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('services')->where(function ($query) use ($request) {

                            return $query
                                ->where('language_id', $request->Language)
                                ->where('title', $request->title);
                        }),
                    ];
                })
                ->updateRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('services')
                            ->where(function ($query) use ($request) {
                                return $query
                                    ->where('language_id', $request->Language)
                                    ->where('title', $request->title);
                            })
                            ->ignore($this->id), // Ensure this matches your route parameter
                    ];
                }),
            Slug::make('Slug')->from('title')->required()->textAlign('left')->rules('required')
                ->creationRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('services')->where(function ($query) use ($request) {

                            return $query
                                ->where('language_id', $request->Language)
                                ->where('slug', $request->slug);
                        }),
                    ];
                })
                ->updateRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('services')
                            ->where(function ($query) use ($request) {
                                return $query
                                    ->where('language_id', $request->Language)
                                    ->where('slug', $request->slug);
                            })
                            ->ignore($this->id), // Ensure this matches your route parameter
                    ];
                }),

            Markdown::make('Description')->required()->rules('required'),
            Image::make('Feature Image', 'image')->required()->hideFromIndex()
                ->disk('public')
                ->path('images/services')
                ->rules(function (NovaRequest $request) {
                    $hasImage = $this->resource->image;
                    return $hasImage ? [] : ['required'];
                })
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . '.' . $request->image->getClientOriginalExtension();
                }),
            Multiselect::make('Translated Pages', 'translated_page_id')
                // ->singleSelect()
                ->hideFromIndex()
                ->hideFromDetail()
                ->dependsOn(
                    ['Language'],
                    function (Multiselect $field, NovaRequest $request, FormData $formData) {
                        if (isset($formData)) {
                            $pages = [];
                            $languages = ModelsLanguage::where('id', '!=', $formData->Language)->get();
                            foreach ($languages as $language) {
                                $pagesInLang = ModelsServices::where('language_id', $language->id)
                                    ->pluck('title', 'id')
                                    ->mapWithKeys(function ($title, $id) use ($language) {
                                        return [$id => $title . ' (' . $language->name . ')'];
                                    });
                                foreach ($pagesInLang as $key => $page) {
                                    $pages[$key] = $page;
                                }
                            }
                            $field->options($pages);
                        }
                    }
                )->help('Select a page which you wants to show for other default langugage ')->required(),
            Boolean::make("Is Published")->required()->rules('required'),
            Flexible::make('Components')->hideFromDetail()
                ->collapsed()
                ->confirmRemove()
                ->button('Add component')
                ->menu('flexible-search-menu', [
                    'openDirection' => 'top'
                ])
                ->addLayout(PageTitleLayout::class)
                ->addLayout(SingleServiceLayout::class)
        ];
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
            new ServiceLanguageFilter()
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
