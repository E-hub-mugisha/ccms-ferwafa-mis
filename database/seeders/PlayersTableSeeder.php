<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlayersTableSeeder extends Seeder
{
    public function run()
    {
        $clubs = DB::table('clubs')->get();

        $players = [
            'APR FC' => [
                ['Emmanuel', 'Iradukunda', '1998-06-12', 'Midfielder', 'Rwanda'],
                ['Jean Claude', 'Niyonzima', '1995-09-08', 'Defender', 'Rwanda'],
                ['Eric', 'Nsabimana', '2000-01-15', 'Goalkeeper', 'Rwanda'],
                ['Alain', 'Mugisha', '1997-03-22', 'Forward', 'Rwanda'],
                ['Patrick', 'Munyaneza', '1996-12-30', 'Midfielder', 'Rwanda'],
            ],
            'Rayon Sports FC' => [
                ['Hussein', 'Ndayishimiye', '1999-05-20', 'Midfielder', 'Rwanda'],
                ['Didier', 'Mugenzi', '1997-07-10', 'Defender', 'Rwanda'],
                ['Theogene', 'Habimana', '1996-08-25', 'Goalkeeper', 'Rwanda'],
                ['Elie', 'Niyibizi', '1994-02-18', 'Forward', 'Rwanda'],
                ['Alexis', 'Nsengiyumva', '2000-10-02', 'Defender', 'Rwanda'],
            ],
            'Police FC' => [
                ['Fidele', 'Nshimiyimana', '1995-04-01', 'Midfielder', 'Rwanda'],
                ['Eric', 'Muvunyi', '1998-11-11', 'Defender', 'Rwanda'],
                ['Alphonse', 'Kamanzi', '1993-06-17', 'Goalkeeper', 'Rwanda'],
                ['Blaise', 'Hategekimana', '1999-03-12', 'Forward', 'Rwanda'],
                ['Jean Marie', 'Habiyambere', '2001-07-27', 'Midfielder', 'Rwanda'],
            ],
            'AS Kigali' => [
                ['Innocent', 'Munyakazi', '1997-08-15', 'Midfielder', 'Rwanda'],
                ['Pascal', 'Uwamahoro', '1996-09-09', 'Defender', 'Rwanda'],
                ['Emile', 'Rutayisire', '1995-12-19', 'Goalkeeper', 'Rwanda'],
                ['Egide', 'Nshimiyimana', '1998-10-05', 'Forward', 'Rwanda'],
                ['Samuel', 'Twagirayezu', '2000-01-25', 'Midfielder', 'Rwanda'],
            ],
            'Etincelles FC' => [
                ['Claude', 'Hagenimana', '1996-02-14', 'Midfielder', 'Rwanda'],
                ['Fabrice', 'Niyonsaba', '1999-04-24', 'Defender', 'Rwanda'],
                ['Jean Paul', 'Ntirenganya', '1994-06-30', 'Goalkeeper', 'Rwanda'],
                ['Patrick', 'Rugwiro', '1995-03-10', 'Forward', 'Rwanda'],
                ['Ange', 'Uwimana', '2000-11-01', 'Midfielder', 'Rwanda'],
            ],
        ];

        foreach ($clubs as $club) {
            foreach ($players[$club->name] as $player) {
                DB::table('players')->insert([
                    'club_id'     => $club->id,
                    'first_name'  => $player[0],
                    'last_name'   => $player[1],
                    'birth_date'  => $player[2],
                    'position'    => $player[3],
                    'photo'       => null,
                    'nationality' => $player[4],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
