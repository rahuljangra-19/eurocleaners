<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::truncate();
        // Home 

        DB::table('pages')->insert([
            'page_name'        => 'Home',
            'title'            => 'Αρχική',
            'slug'             => '/',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 1,
            'language_id'         => '2',
            'is_published'         =>  true,
            'is_menu'           => true,
            // 'translated_page_id' => 2
        ]);

        DB::table('pages')->insert([
            'page_name'        => 'Home',
            'title'            => 'Home',
            'slug'             => '/',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 2,
            'language_id'         => '1',
            'is_published'         =>  true,
            'is_menu'           => true
        ]);

        // About
        // DB::table('pages')->insert([
        //     'page_name'        => 'About',
        //     'title'            => 'About',
        //     'slug'             => 'about',
        //     'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
        //     'sort_order'       => 3,
        //     'language_id'         => 'en',
        //     'is_published'     =>  false,
        //     'is_menu'           => false
        // ]);

        // DB::table('pages')->insert([
        //     'page_name'        => 'About',
        //     'title'            => 'About',
        //     'slug'             => 'el/about',
        //     'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
        //     'sort_order'       => 4,
        //     'language_id'         => 'el',
        //     'is_published'     =>  false,
        //     'is_menu'           => false
        // ]);


        // Projects

        DB::table('pages')->insert([
            'page_name'        => 'Projects',
            'title'            => 'Projects',
            'slug'             => 'projects',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 5,
            'language_id'         => '1',
            'is_published'     =>  true,
            'is_menu'           => true,
            'have_sub_menu'           => true,
        ]);
        DB::table('pages')->insert([
            'page_name'        => 'Projects',
            'title'            => 'Έργα',
            'slug'             => 'Έργα',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 6,
            'language_id'         => '2',
            'is_published'     =>  true,
            'is_menu'           => true,
            'have_sub_menu'           => true,
            // 'translated_page_id' => 3
        ]);

        // Professional Advice

        // DB::table('pages')->insert([
        //     'page_name'        => 'Advice',
        //     'title'            => 'Επαγγελματίας Συμβουλές',
        //     'slug'             => 'επαγγελματική-συμβουλή',
        //     'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
        //     'sort_order'       => 3,
        //     'language_id'         => '2',
        //     'is_published'     =>  true,
        //     'is_menu'           => true
        // ]);
        // DB::table('pages')->insert([
        //     'page_name'        => 'Advice',
        //     'title'            => 'Professional Advice',
        //     'slug'             => 'professional-advice',
        //     'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
        //     'sort_order'       => 4,
        //     'language_id'         => '1',
        //     'is_published'     =>  true,
        //     'is_menu'           => true
        // ]);

        // Equipment/

        // DB::table('pages')->insert([
        //     'page_name'        => 'Equipment',
        //     'title'            => 'Εξοπλισμός',
        //     'slug'             => 'Εξοπλισμός',
        //     'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
        //     'sort_order'       => 5,
        //     'language_id'         => '2',
        //     'is_published'     =>  true,
        //     'is_menu'           => true
        // ]);
        // DB::table('pages')->insert([
        //     'page_name'        => 'Equipment',
        //     'title'            => 'Equipment',
        //     'slug'             => 'equipment',
        //     'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
        //     'sort_order'       => 6,
        //     'language_id'         => '1',
        //     'is_published'     =>  true,
        //     'is_menu'           => true
        // ]);


        // Services

        DB::table('pages')->insert([
            'page_name'        => 'Services',
            'title'            => 'Υπηρεσίες',
            'slug'             => 'Υπηρεσίες',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 7,
            'language_id'         => '2',
            'is_published'     =>  true,
            'is_menu'           => true,
            'have_sub_menu'           => true,
            // 'translated_page_id' => 6
        ]);

        DB::table('pages')->insert([
            'page_name'        => 'Services',
            'title'            => 'Services',
            'slug'             => 'services',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 8,
            'language_id'         => '1',
            'is_published'     =>  true,
            'is_menu'           => true,
            'have_sub_menu'           => true
        ]);

        // Blog
        DB::table('pages')->insert([
            'page_name'        => 'Blogs',
            'title'            => 'Ιστολόγιο',
            'slug'             => 'Ιστολόγιο',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 9,
            'language_id'         => '2',
            'is_published'     =>  false,
            'is_menu'           => false,
            // 'translated_page_id' => 8
        ]);
        DB::table('pages')->insert([
            'page_name'        => 'Blogs',
            'title'            => 'Blogs',
            'slug'             => 'blogs',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 10,
            'language_id'         => '1',
            'is_published'     =>  true,
            'is_menu'           => true
        ]);


        // // Contact
        DB::table('pages')->insert([
            'page_name'        => 'Contact',
            'title'            => 'Επικοινωνία',
            'slug'             => 'Επικοινωνία',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 11,
            'language_id'         => '2',
            'is_published'     =>  true,
            'is_menu'           => true,
            // 'translated_page_id' => 10
        ]);

        DB::table('pages')->insert([
            'page_name'        => 'Contact',
            'title'            => 'Contact',
            'slug'             => 'contact',
            'description'      => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse, aliquid. Fugit expedita, obcaecati quidem eum explicabo dolores blanditiis dolore et voluptas voluptates velit dolor deleniti temporibus repellat nobis iure aperiam.",
            'sort_order'       => 12,
            'language_id'         => '1',
            'is_published'     =>  true,
            'is_menu'           => true,
        ]);
    }
}
