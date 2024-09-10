<?php

namespace App\Nova;

use App\Nova\Layouts\HeroSliderLayout;
use App\Nova\Layouts\PageTitleLayout;
use App\View\Components\HeroSlider;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Slug;
use App\Nova\Language as NovaLanguage;
use App\Models\Language;
use App\Models\Page as ModelsPage;
use App\Models\Post as ModelsPost;
use App\Nova\Filters\PostLanguageFilter;
use App\Nova\Layouts\SingleBlogLayout;
use App\Rules\ConditionalRequiredImage;
use App\View\Components\SingleBlog;
use Armincms\Json\Json as JsonJson;
use Carbon\Carbon;
use Laravel\Nova\Fields\Repeater\Presets\JSON;
use Laravel\Nova\Fields\Tag as NovaTag;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Outl1ne\MultiselectField\Multiselect;
use Laravel\Nova\Fields\Image;
use Murdercode\TinymceEditor\TinymceEditor;



class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Post>
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $clickAction = 'edit';
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
            Slug::make('Slug')->from('title')->required()->textAlign('left')->rules([
                'required',
                Rule::unique('pages')->where(function ($query) {
                    return $query->where('language_id', $this->language)->where('slug', $this->slug);
                })->ignore($this->id)
            ]),
            Image::make('Feature Image', 'feature_image')->required()->hideFromIndex()
                ->disk('public')
                ->path('images/posts')
                ->rules(function (NovaRequest $request) {
                    $hasImage = $this->resource->feature_image;
                    return $hasImage ? [] : ['required'];
                })
                ->storeAs(function (NovaRequest $request) {
                    return Carbon::now()->timestamp . $request->feature_image->getClientOriginalName();
                }),
            Multiselect::make('Translated Pages', 'translated_page_id')
                ->hideFromIndex()
                ->hideFromDetail()
                ->dependsOn(
                    ['Language'],
                    function (Multiselect $field, NovaRequest $request, FormData $formData) {
                        if (isset($formData)) {
                            $pages = [];
                            $languages = Language::where('id', '!=', $formData->Language)->get();
                            foreach ($languages as $language) {
                                $pagesInLang = ModelsPost::where('language_id', $language->id)
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
                )->help('Select a page which you wants to show for other default langugage')->required(),
            Text::make('Page Name', 'page_name')
                ->readonly()
                ->hideFromIndex()
                ->hideFromDetail()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->dependsOn(
                    ['title'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        return ucfirst($formData->title);
                    }
                ),
            // Markdown::make('Short Description For Blogs Page', 'descriptions')->required()->textAlign('left')->rules('required'),
            TinymceEditor::make('Short Description For Blogs Page','descriptions')->required()->rules('required')
                ->stacked()
                ->fullWidth(),
            Boolean::make('Is Published', 'is_published')->required()->rules('required'),
            Flexible::make('Components')->hideFromDetail()
                ->collapsed()
                ->confirmRemove()
                ->button('Add component')
                ->menu('flexible-search-menu', [
                    'openDirection' => 'top'
                ])
                ->addLayout(PageTitleLayout::class)
                ->addLayout(SingleBlogLayout::class)


        ];
    }



    public function socialCardFields()
    {

        return [
            JsonJson::make('author', [
                Text::make('Title')->required()->rules('required'),
                Image::make('Feature Image', 'image')->required()->hideFromIndex()
                    ->disk('public')
                    ->path('images/posts')
                    ->storeAs(function (NovaRequest $request) {
                        return Carbon::now()->timestamp . '.' . $request->image->getClientOriginalExtension();
                    }),
                Textarea::make('Description')->required()->rules('required'),
                Text::make('Google Link', 'google_link'),
                Text::make('FaceBook', 'fb_link'),
                Text::make('Instagram', 'insta_link'),
                Text::make('Twitter', 'twitter_link'),
            ])
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
            new PostLanguageFilter()
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
