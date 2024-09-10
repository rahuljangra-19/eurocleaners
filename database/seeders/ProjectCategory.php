<?php

namespace Database\Seeders;

use App\Models\ProjectCategory as ModelsProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsProjectCategory::truncate();
        $data = [
            ['name' => 'Residential', 'sort_order' => 1, 'language_id' => 1],
            ['name' => 'Commercial', 'sort_order' => 2, 'language_id' => 1],
            ['name' => 'Factory', 'sort_order' => 3, 'language_id' => 1],
            ['name' => 'Roof Replacement', 'sort_order' => 4, 'language_id' => 1],

            ['name' => 'Residential', 'sort_order' => 1, 'language_id' => 2],
            ['name' => 'Commercial', 'sort_order' => 2, 'language_id' => 2],
            ['name' => 'Factory', 'sort_order' => 3, 'language_id' => 2],
            ['name' => 'Roof Replacement', 'sort_order' => 4, 'language_id' => 2]
        ];

        foreach ($data as $val) {
            $cat = new ModelsProjectCategory();
            $cat->name = $val['name'];
            $cat->language_id = $val['language_id'];
            $cat->sort_order = $val['sort_order'];
            $cat->save();
        }
    }
}
