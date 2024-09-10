<?php

namespace App\Nova\Layouts;

use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Layouts\Layout;
use Outl1ne\MultiselectField\Multiselect;
use App\Models\Project;
use Murdercode\TinymceEditor\TinymceEditor;

class ProjectsLayout extends Layout
{
    protected $name = 'projects';

    protected $title = 'Projects section to show all projects';

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
