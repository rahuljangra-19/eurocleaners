<?php

namespace App\View\Components;

use App\Models\Component as ModelsComponent;
use App\Models\Language;
use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;


class TopBar extends Component
{
    public $data;
    public $languages;
    public $page;
    public $localLangId;
    /**
     * Create a new component instance. 
     */
    public function __construct($page)
    {
        $result = $this->checkDefaultLangIsSet();
        $localeId =  FacadesSession::get('local_lang_id') ?? config('app.local_lang_id');
        $components = ModelsComponent::where(['name' => 'top-bar', 'language_id' => $localeId])->first();
        if ($components) {
            $this->data = $components->items;
        }
        if ((is_array($page->translated_page_id) || $page->id) && $result) {
            $translatedLangIds = $page->model::where('is_published', true)->where(function ($query) use ($page) {
                $query->whereIn('id', $page->translated_page_id ?? [])
                    ->orWhere('id', $page->id);
            })
                ->pluck('language_id')
                ->unique()
                ->toArray();
        }
        if (!empty($translatedLangIds)) {
            $this->languages = Language::WhereIn('id', $translatedLangIds)
                ->get();
        } else {
            $this->languages = Language::where('is_default', true)->get();
        }
        $this->localLangId = $localeId;
        $this->page = $page;
    }

    function checkDefaultLangIsSet()
    {
        return Language::where('is_default', true)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top-bar', ['data' => $this->data, 'languages' => $this->languages, 'page' => $this->page, 'localLangId' => $this->localLangId]);
    }
}
