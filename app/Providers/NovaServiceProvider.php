<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Page;
use App\Models\ProjectCategory;
use App\Nova\Component;
use App\Nova\Language as NovaLanguage;
use App\Nova\Page as NovaPage;
use App\Nova\Post;
use App\Nova\Project;
use App\Nova\ProjectCategory as NovaProjectCategory;
use App\Nova\Service;
use App\Nova\Setting;
use Illuminate\Support\Facades\Gate;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Laravel\Nova\Dashboards\Main;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::script('custom', 'https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js');

        Nova::withBreadcrumbs();
        Nova::withoutGlobalSearch();
        $this->getCustomMenu();

        Nova::footer(function (Request $request) {
            return Blade::render('
                <p class="text-center">Designed & Developed by <a class="link-default" target="_blank" href="#">Laravel Developer</a></a></p>
            ');
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void 
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {

            $userEmails = User::all()->pluck('email')->toArray();

            return in_array($user->email, $userEmails);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**         
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function getCustomMenu()
    {
        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class),
                // MenuSection::resource(NovaLanguage::class)->icon('server'),
                MenuSection::resource(NovaPage::class)->icon('clipboard-check'),
                MenuSection::resource(Component::class)->icon('table'),
                // MenuSection::resource(NovaProjectCategory::class)->icon('chart-square-bar'),
                // MenuSection::resource(Project::class)->icon('briefcase'),
                MenuSection::make('Projects', [
                    MenuItem::resource(NovaProjectCategory::class),
                    MenuItem::resource(Project::class)
                ])->icon('briefcase'),
                MenuSection::resource(Service::class)->icon('server'),
                MenuSection::resource(Post::class)->icon('chart-square-bar'),
                MenuSection::make('Configuration', [
                    MenuItem::resource(Setting::class),
                    MenuItem::resource(NovaLanguage::class)
                ])->icon('cog'),

            ];
        });
    }
}
