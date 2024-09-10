<?php

namespace App\Nova;

use App\Nova\Filters\ProjectCategoryLanguageFilter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProjectCategory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ProjectCategory>
     */
    public static $model = \App\Models\ProjectCategory::class;

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
            BelongsTo::make('Language', 'Language', Language::class)->withoutTrashed(),
            Text::make('Cateory Name', 'name')->sortable()
                ->rules('required')
                ->creationRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('project_categories')->where(function ($query) use ($request) {
                            return $query
                                ->where('language_id', $request->Language)
                                ->where('name', $request->name);
                        }),
                    ];
                })
                ->updateRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('project_categories')
                            ->where(function ($query) use ($request) {
                                return $query
                                    ->where('language_id', $request->Language)
                                    ->where('name', $request->name);
                            })
                            ->ignore($this->id), // Ensure this matches your route parameter
                    ];
                }),
            Boolean::make('Is Published')->sortable()->rules('required'),

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
            new ProjectCategoryLanguageFilter()
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
