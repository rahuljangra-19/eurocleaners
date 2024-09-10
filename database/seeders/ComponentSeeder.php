<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Component::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // $data  = [
        //     // ['name' => 'hero-slider', 'title' => 'Hero Slider', 'description' => 'Hero slider testing'],
        //     // ['name' => 'service', 'title' => 'Services', 'description' => 'Services testing'],
        //     // ['name' => 'booking', 'title' => 'Booking feature section', 'description' => 'Booking feature section'],
        //     // ['name' => 'fact', 'title' => 'Facts', 'description' => 'Facts'],
        //     // ['name' => 'projects', 'title' => 'Projects', 'description' => 'Projects'],
        //     // ['name' => 'about', 'title' => 'About', 'description' => 'About'],
        //     // ['name' => 'title', 'title' => 'Page Title', 'description' => 'Page Title'],
        //     ['name' => 'footer', 'title' => 'Footer for English', 'description' => 'Footer', 'language_id' => 1],
        //     ['name' => 'footer', 'title' => 'Footer for Greek', 'description' => 'Footer', 'language_id' => 2],
        //     ['name' => 'top-bar', 'title' => 'Top bar with phone and time for English', 'description' => 'Top bar ', 'language_id' => 1],
        //     ['name' => 'top-bar', 'title' => 'Top bar with phone and time for Greek', 'description' => 'Top bar ', 'language_id' => 2],

        //     ['name' => 'social-card', 'title' => 'Social Card for English', 'description' => 'Social-card', 'language_id' => 1],
        //     ['name' => 'social-card', 'title' => 'Social Card for Greek', 'description' => 'Social-card', 'language_id' => 2],

        //     ['name' => 'contact-box', 'title' => 'Contact-box with Title and description for English', 'description' => 'Contact-box ', 'language_id' => 1],
        //     ['name' => 'contact-box', 'title' => 'Contact-box with Title and description for Greek', 'description' => 'Contact-box ', 'language_id' => 2],
        // ];

        // foreach ($data as $value) {
        //     $component = new Component();
        //     $component->language_id = $value['language_id'];
        //     $component->name = $value['name'];
        //     $component->title = $value['title'];
        //     $component->description = $value['description'];
        //     $component->save();
        // }
        DB::table('components')->insert([
            [
                'id' => 1,
                'language_id' => 1,
                'name' => 'footer',
                'title' => 'Footer for English',
                'description' => 'Footer',
                'is_published' => 1,
                'have_items' => 0,
                'items' => null,
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:14:30',
            ],
            [
                'id' => 2,
                'language_id' => 2,
                'name' => 'footer',
                'title' => 'Footer for Greek',
                'description' => 'Footer',
                'is_published' => 1,
                'have_items' => 0,
                'items' => null,
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:14:30',
            ],
            [
                'id' => 3,
                'language_id' => 1,
                'name' => 'top-bar',
                'title' => 'Top bar with phone and time for English',
                'description' => 'Top bar ',
                'is_published' => 1,
                'have_items' => 0,
                'items' => json_encode([
                    'working_days' => 'Sun - Fri',
                    'working_time' => '24 Hours open',
                    'phone' => '+7 895 6562 665',
                    'image' => 'images/components/clock.jpg',
                ]),
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:14:30',
            ],
            [
                'id' => 4,
                'language_id' => 2,
                'name' => 'top-bar',
                'title' => 'Top bar with phone and time for Greek',
                'description' => 'Top bar ',
                'is_published' => 1,
                'have_items' => 0,
                'items' => null,
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:14:30',
            ],
            [
                'id' => 5,
                'language_id' => 1,
                'name' => 'social-card',
                'title' => 'Social Card for English',
                'description' => 'Social-card',
                'is_published' => 1,
                'have_items' => 0,
                'items' => json_encode([
                    'name' => 'Deve',
                    'description' => 'labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.',
                    'google_link' => 'gogole.com',
                    'fb_link' => 'fb.com',
                    'insta_link' => 'insta.com',
                    'twitter_link' => 'tw.com',
                    'image' => 'images/components/1724321590_profile.jpg',
                ]),
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 06:08:01',
            ],
            [
                'id' => 6,
                'language_id' => 2,
                'name' => 'social-card',
                'title' => 'Social Card for Greek',
                'description' => 'Social-card',
                'is_published' => 1,
                'have_items' => 0,
                'items' => json_encode([
                    'name' => 'Developer',
                    'image' => 'images/components/1724321544_profile.jpg',
                    'description' => 'labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.',
                    'google_link' => 'google.com',
                    'fb_link' => 'fb.com',
                    'insta_link' => 'insta.com',
                    'twitter_link' => 'tw.com',
                ]),
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:42:24',
            ],
            [
                'id' => 7,
                'language_id' => 1,
                'name' => 'contact-box',
                'title' => 'Contact-box with Title and description for English',
                'description' => 'Contact-box',
                'is_published' => 1,
                'have_items' => 0,
                'items' => json_encode([
                    'title' => 'How We Can Help You!',
                    'description' => 'labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.',
                ]),
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:36:22',
            ],
            [
                'id' => 8,
                'language_id' => 2,
                'name' => 'contact-box',
                'title' => 'Contact-box with Title and description for Greek',
                'description' => 'Contact-box',
                'is_published' => 1,
                'have_items' => 0,
                'items' => json_encode([
                    'title' => 'How We Can Help You! Greek',
                    'description' => 'Greek \r\nlabore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.',
                ]),
                'sort_order' => null,
                'deleted_at' => null,
                'created_at' => '2024-08-22 04:14:30',
                'updated_at' => '2024-08-22 04:37:53',
            ],
        ]);
    }
}
