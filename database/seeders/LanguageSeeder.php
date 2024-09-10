<?php

namespace Database\Seeders;
 
use App\Models\Language;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema as FacadesSchema;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $langs = [
            ['name' => 'English', 'code' => 'en', 'is_default' => true, 'icon' => 'vendor/blade-flags/country-us.svg'],
            ['name' => 'Greek', 'code' => 'el', 'is_default' => false, 'icon' => 'vendor/blade-flags/country-gr.svg'],
        ];
        FacadesSchema::disableForeignKeyConstraints();
        Language::truncate();
        FacadesSchema::enableForeignKeyConstraints();

        foreach ($langs as $value) {
            $lang = new Language();
            $lang->name = $value['name'];
            $lang->code = $value['code'];
            $lang->icon = $value['icon'];
            $lang->is_default = $value['is_default'];
            $lang->save();
        }
    }
}
