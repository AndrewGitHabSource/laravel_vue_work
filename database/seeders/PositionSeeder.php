<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
{
    public function run()
    {
        DB::table('positions')->insert([
            'title' => 'php developer',
            'description' => 'php developer php developer php developer php developer php developer',
        ]);
        DB::table('positions')->insert([
            'title' => 'js developer',
            'description' => 'js developer js developer js developer js developer js developer',
        ]);
    }
}
