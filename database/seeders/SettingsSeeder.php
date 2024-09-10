<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();
        
        DB::table('settings')->insert([
            [
                'id' => 1,
                'name' => 'email',
                'meta' => json_encode([
                    'email' => 'info@dev.com',
                    'bcc_email' => 'developer@yopmail.com'
                ]),
                'created_at' => '2024-08-22 01:45:57',
                'updated_at' => '2024-08-22 01:45:57',
            ],
            [
                'id' => 2,
                'name' => 'google',
                'meta' => json_encode([
                    'key' => '432423423423rewwerw'
                ]),
                'created_at' => '2024-08-22 01:46:25',
                'updated_at' => '2024-08-22 01:46:25',
            ],
            [
                'id' => 3,
                'name' => 'map',
                'meta' => json_encode([
                    'latitude' => '30.865665',
                    'longitude' => '70.865432'
                ]),
                'created_at' => '2024-08-22 01:46:55',
                'updated_at' => '2024-08-22 01:46:55',
            ],
            [
                'id' => 4,
                'name' => 'email smtp',
                'meta' => json_encode([
                    'MAIL_MAILER' => 'smtp',
                    'MAIL_HOST' => 'sandbox.smtp.mailtrap.io',
                    'MAIL_PORT' => '2525',
                    'MAIL_USERNAME' => 'ece50f77141069',
                    'MAIL_PASSWORD' => 'c2f8eed67b817e'
                ]),
                'created_at' => '2024-08-23 04:08:06',
                'updated_at' => '2024-08-23 04:08:06',
            ],
        ]);
    }
}
