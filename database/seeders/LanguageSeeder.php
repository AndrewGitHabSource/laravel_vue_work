<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        DB::table('languages')->insert([
            'title' => 'Ukrainian',
        ]);
        DB::table('languages')->insert([
            'title' => 'Russian',
        ]);
        DB::table('languages')->insert([
            'title' => 'English',
        ]);
    }
}
