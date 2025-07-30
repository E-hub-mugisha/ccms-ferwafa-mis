<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StadiumsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stadiums')->insert([
            [
                'name' => 'Kigali Pele Stadium',
                'location' => 'Nyamirambo, Kigali',
                'capacity' => '22000',
                'image' => 'stadiums/kigali_pele.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amahoro Stadium',
                'location' => 'Gasabo, Kigali',
                'capacity' => '30000',
                'image' => 'stadiums/amahoro.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Huye Stadium',
                'location' => 'Huye District, Southern Province',
                'capacity' => '20000',
                'image' => 'stadiums/huye.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bugesera Stadium',
                'location' => 'Bugesera District, Eastern Province',
                'capacity' => '10000',
                'image' => 'stadiums/bugesera.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rubavu Stadium',
                'location' => 'Rubavu District, Western Province',
                'capacity' => '15000',
                'image' => 'stadiums/rubavu.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
