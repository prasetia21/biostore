<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            [
                'support_phone' => '0274xxxx',
                'phone_one' => '0274xxxx',
                'email' => 'email@mail.com',
                'company_address' => 'sidik',
                'facebook' => 'fb',
                'twitter' => 'x',
                'youtube' => 'yt',
                'copyright' => '2023',
            ],
        ]);
    }
}
