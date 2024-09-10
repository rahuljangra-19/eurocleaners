<?php

namespace Database\Seeders;
 
use App\Models\CountryFlag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountryFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = public_path('blade-flags');
        $svgFiles = File::files($data);

        CountryFlag::truncate();
        
        foreach ($svgFiles as $file) {
            $svgContent = File::get($file);
            $name = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $name = str_replace('-', ' ',$name);
            CountryFlag::create([
                'name' => $name,
                'flag' => $svgContent,
            ]);
        }
    }
}
