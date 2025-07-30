<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('clubs')->insert([
            [
                'name' => 'APR FC',
                'logo' => 'logos/apr.png',
                'stadium' => 'APR Stadium',
                'city' => 'Kigali',
                'phone' => '+250788000001',
                'email' => 'info@aprfc.rw',
                'description' => 'Armée Patriotique Rwandaise Football Club – the most decorated club in Rwanda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rayon Sports FC',
                'logo' => 'logos/rayon.png',
                'stadium' => 'Stade de Kigali',
                'city' => 'Kigali',
                'phone' => '+250788000002',
                'email' => 'info@rayonsports.rw',
                'description' => 'Popular Rwandan football club with a large fan base.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Police FC',
                'logo' => 'logos/police.png',
                'stadium' => 'Kicukiro Stadium',
                'city' => 'Kigali',
                'phone' => '+250788000003',
                'email' => 'info@policefc.rw',
                'description' => 'Police Football Club – known for discipline and resilience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AS Kigali',
                'logo' => 'logos/askigali.png',
                'stadium' => 'Nyamirambo Stadium',
                'city' => 'Kigali',
                'phone' => '+250788000004',
                'email' => 'contact@askigali.rw',
                'description' => 'City-sponsored football club in Rwanda’s capital.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Etincelles FC',
                'logo' => 'logos/etincelles.png',
                'stadium' => 'Umuganda Stadium',
                'city' => 'Rubavu',
                'phone' => '+250788000005',
                'email' => 'info@etincellesfc.rw',
                'description' => 'A respected club from the Western Province of Rwanda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
