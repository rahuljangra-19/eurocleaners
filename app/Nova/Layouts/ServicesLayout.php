<?php

namespace App\Nova\Layouts;

use App\Models\Service;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\MultiselectField\Multiselect;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Murdercode\TinymceEditor\TinymceEditor;

class ServicesLayout extends Layout
{
    protected $name = 'services';

    protected $title = 'Services section to show all services';

    protected $limit = 1;

    public function fields(): array
    {   
        return [
            Text::make('Title', 'title')->required()->rules('required'),
            TinymceEditor::make('Description')->required()
                ->stacked()
                ->fullWidth(),
           
        ];
    }
}
