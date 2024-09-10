<?php

namespace App\Nova\Layouts;

use Armincms\Json\Json;
use Carbon\Carbon;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
Use Laravel\Nova\Fields\Email;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class FooterLayout extends Layout
{
    protected $name = 'footer';

    protected $title = 'Footer section with about us and social links';
    
    protected $limit = 1;

    public function fields(): array
    {
        return [
            Json::make('items', [
                Textarea::make('About Us', 'about_us')->required()->rules('required'),
                URL::make('Facebook URL', 'facebook')->required()->rules('required'),
                URL::make('Twitter URL', 'twitter')->required()->rules('required'),
                URL::make('Instagram URL', 'insta')->required()->rules('required'),
                URL::make('Google URL', 'google')->required()->rules('required'),
                Email::make('Contact Email', 'contact_email')->required()->rules('required'),
                Text::make('Contact Number', 'phone')->required()->rules('required'),
                Textarea::make('Address', 'address')->required()->rules('required'),
            ])
        ];
    }
}
