<?php

namespace App\Nova;

use App\Models\Language;
use App\Models\Page as ModelsPage;
use App\Nova\Filters\PageLanguagFilter;
use App\Nova\Language as NovaLanguage;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Outl1ne\MultiselectField\Multiselect;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Panel;
use Outl1ne\NovaSortable\Traits\HasSortableRows;
use App\Nova\Layouts\HeroSlider;
use App\Nova\Layouts\HeroSliderLayout;
use App\Nova\Layouts\AboutLayout;
use App\Nova\Layouts\BlogsLayout;
use App\Nova\Layouts\BookingLayout;
use App\Nova\Layouts\ContactLayout;
use App\Nova\Layouts\FactLayout;
use App\Nova\Layouts\FooterLayout;
use App\Nova\Layouts\PageTitleLayout;
use App\Nova\Layouts\ProjectsLayout;
use App\Nova\Layouts\ServicesLayout;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasOne as FieldsHasOne;
use Laravel\Nova\Fields\Textarea;

class Page extends Resource
{
    use HasSortableRows;

    public static $sortableCacheEnabled = false;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Page>
     */

    public static string $model = \App\Models\Page::class;

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
        'name',
        'slug',
        'title'
    ];

    public static $clickAction = 'select';

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array 
     */
    public function fields(NovaRequest $request)
    {
        return [
            new Panel('Page Details', $this->pageFields()),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new PageLanguagFilter()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereHas('language', function ($q) {
            $q->whereNull('deleted_at');
        });
    }

    public function pageFields()
    {

        return [
            ID::make()->sortable(),
            Text::make('Title')
                ->required()
                ->textAlign('left')
                ->rules('required')
                ->creationRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('pages')->where(function ($query) use ($request) {

                            return $query
                                ->where('language_id', $request->Language)
                                ->where('title', $request->title);
                        }),
                    ];
                })
                ->updateRules(function (NovaRequest $request) {
                    return [
                        Rule::unique('pages')
                            ->where(function ($query) use ($request) {
                                return $query
                                    ->where('language_id', $request->Language)
                                    ->where('title', $request->title);
                            })
                            ->ignore($this->id), // Ensure this matches your route parameter
                    ];
                }),
            BelongsTo::make('Language', 'Language', NovaLanguage::class)->sortable()->withoutTrashed(),
            // Select::make('language', 'language_id')->required()->options(Language::pluck('name', 'id'))->sortable()->rules(['required']),
            Slug::make('Slug')->from('title')->required()->textAlign('left')->rules([
                'required',
                Rule::unique('pages')->where(function ($query) {
                    return $query->where('language_id', $this->language)->where('slug', $this->slug);
                })->ignore($this->id)
            ])->help('Home page have only / as a slug'),
            Multiselect::make('Parent Page', 'parent_page')
                ->singleSelect()
                ->hideFromIndex()
                ->hideFromDetail()
                ->dependsOn(
                    ['Language'],
                    function (Multiselect $field, NovaRequest $request, FormData $formData) {
                        if (isset($formData)) {
                            $pages = ModelsPage::where('language_id', $formData->Language)
                                ->pluck('title', 'id')
                                ->toArray();
                            $field->options($pages);
                        }
                    }
                )->help('This is user for show under a parent page '),
            Multiselect::make('Translated Pages', 'translated_page_id')
                // ->singleSelect()
                ->hideFromIndex()
                ->hideFromDetail()
                ->dependsOn(
                    ['Language'],
                    function (Multiselect $field, NovaRequest $request, FormData $formData) {
                        if (isset($formData)) {
                            $pages = [];
                            // $defaultLang = Language::where('is_default', true)->first();
                            // if ($formData->Language !=  $defaultLang->id) {
                            $languages = Language::where('id', '!=', $formData->Language)->get();
                            foreach ($languages as $language) {
                                $pagesInLang = ModelsPage::where('language_id', $language->id)
                                    ->pluck('title', 'id')
                                    ->mapWithKeys(function ($title, $id) use ($language) {
                                        return [$id => $title . ' (' . $language->name . ')'];
                                    });
                                foreach ($pagesInLang as $key => $page) {
                                    $pages[$key] = $page;
                                }
                            }
                            // }
                            $field->options($pages);
                        }
                    }
                )->help('Select a page which you wants to show for other langugage. choose page for every language otherwise no option will show on that page ')->required(),
            Text::make('Page Name', 'page_name')
                ->readonly()
                ->hideFromIndex()
                ->hideFromDetail()
                ->hideWhenCreating()
                ->dependsOn(
                    ['title'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        return ucfirst($formData->title);
                    }
                ),
            Text::make('Meta Title')->hideFromIndex()->help('meta keyword are comma seperated like laravel,nova'),
            Textarea::make('Meta Description')->hideFromIndex(),
            Boolean::make('Is Published')->required()->rules('required'),
            Boolean::make('Is Menu')->required()->rules('required')->hideFromIndex(),
            Boolean::make('Have Sub Menu')->required()->rules('required')->hideFromIndex(),
            Flexible::make('Components')->hideFromDetail()
                ->collapsed()
                ->confirmRemove()
                ->button('Add component')
                ->menu('flexible-search-menu', [
                    'openDirection' => 'top'
                ])
                ->addLayout(HeroSliderLayout::class)
                ->addLayout(AboutLayout::class)
                ->addLayout(BookingLayout::class)
                ->addLayout(FactLayout::class)
                ->addLayout(PageTitleLayout::class)
                ->addLayout(ProjectsLayout::class)
                ->addLayout(ServicesLayout::class)
                ->addLayout(ContactLayout::class)
                ->addLayout(BlogsLayout::class)
        ];
    }
}
