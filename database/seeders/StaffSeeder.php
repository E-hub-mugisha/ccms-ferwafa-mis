<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StaffSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $staff = [
            // APR FC Staff
            [
                'club_id' => 2,
                'name' => 'Adil Mohamed',
                'position' => 'Head Coach',
                'email' => 'adil@aprfc.rw',
                'phone' => '+250788010001',
                'photo' => 'staff/apr_adil.png',
                'bio' => 'Experienced coach with national and regional success.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'club_id' => 2,
                'name' => 'Jean Bizimana',
                'position' => 'Assistant Coach',
                'email' => 'jean@aprfc.rw',
                'phone' => '+250788010002',
                'photo' => 'staff/apr_jean.png',
                'bio' => 'Former APR player turned assistant coach.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Rayon Sports FC Staff
            [
                'club_id' => 3,
                'name' => 'Yves Rwasamanzi',
                'position' => 'Head Coach',
                'email' => 'yves@rayonsports.rw',
                'phone' => '+250788020001',
                'photo' => 'staff/rayon_yves.png',
                'bio' => 'Former Amavubi assistant and Rayon legend.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'club_id' => 3,
                'name' => 'Eric Nshimiyimana',
                'position' => 'Technical Director',
                'email' => 'eric@rayonsports.rw',
                'phone' => '+250788020002',
                'photo' => 'staff/rayon_eric.png',
                'bio' => 'Ex-national team coach with tactical expertise.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Police FC Staff
            [
                'club_id' => 4,
                'name' => 'Patrick Ruhumuriza',
                'position' => 'Head Coach',
                'email' => 'patrick@policefc.rw',
                'phone' => '+250788030001',
                'photo' => 'staff/police_patrick.png',
                'bio' => 'Known for defensive discipline and structure.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'club_id' => 4,
                'name' => 'Moses Rutikanga',
                'position' => 'Goalkeeping Coach',
                'email' => 'moses@policefc.rw',
                'phone' => '+250788030002',
                'photo' => 'staff/police_moses.png',
                'bio' => 'Former top goalkeeper with years of training experience.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // AS Kigali Staff
            [
                'club_id' => 5,
                'name' => 'Jimmy Mulisa',
                'position' => 'Head Coach',
                'email' => 'jimmy@askigali.rw',
                'phone' => '+250788040001',
                'photo' => 'staff/askigali_jimmy.png',
                'bio' => 'Former striker and forward-focused tactician.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'club_id' => 5,
                'name' => 'Claudine Uwase',
                'position' => 'Physiotherapist',
                'email' => 'claudine@askigali.rw',
                'phone' => '+250788040002',
                'photo' => 'staff/askigali_claudine.png',
                'bio' => 'Specialist in sports physiotherapy and recovery.',
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Etincelles FC Staff
            [
                'club_id' => 6,
                'name' => 'Jean Claude Niyonzima',
                'position' => 'Head Coach',
                'email' => 'jc@etincellesfc.rw',
                'phone' => '+250788050001',
                'photo' => 'staff/etincelles_jc.png',
                'bio' => 'Tactically sharp coach from Rubavu region.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'club_id' => 6,
                'name' => 'Sonia Mukamana',
                'position' => 'Team Doctor',
                'email' => 'sonia@etincellesfc.rw',
                'phone' => '+250788050002',
                'photo' => 'staff/etincelles_sonia.png',
                'bio' => 'Sports medicine professional ensuring player health.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('staff')->insert($staff);
    }
}
