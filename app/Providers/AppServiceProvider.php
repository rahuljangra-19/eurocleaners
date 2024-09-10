<?php

namespace App\Providers; 

use App\Models\Component;
use App\Models\Language;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Page;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Observers\ComponentObserver;
use App\Observers\LanguageObserver;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
use App\Observers\ProjectObserver;
use App\Observers\ServiceObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // URL::forceScheme('https');
        Page::observe(PageObserver::class);
        Component::observe(ComponentObserver::class);
        Service::observe(ServiceObserver::class);
        Project::observe(ProjectObserver::class);
        Post::observe(PostObserver::class);
        Language::observe(LanguageObserver::class);

        Paginator::defaultView('pagination/bootstrap-5');

        $lang = Language::where('is_default', true)->first();
        if ($lang) {
            if (!Session('local_lang_id')) {
                Config::set('app.local_lang_id', $lang->id);
            }
        }
    }
}
