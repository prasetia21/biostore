<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seos')->insert([
            [
                'meta_title' => 'Bio WebStore',
                'meta_author' => 'Bio',
                'meta_keyword' => 'Bio WebStore',
                'meta_description' => 'Bio WebStore',
            ],
        ]);
    }
}
