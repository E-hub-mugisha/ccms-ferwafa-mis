<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matches;
use Carbon\Carbon;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matches::insert([
            [
                'match_date'   => Carbon::parse('2025-09-20 15:00:00'),
                'home_club_id' => 1,
                'away_club_id' => 2,
                'venue'        => 'Amahoro Stadium',
            ],
            [
                'match_date'   => Carbon::parse('2025-09-22 17:00:00'),
                'home_club_id' => 3,
                'away_club_id' => 4,
                'venue'        => 'Nyamirambo Stadium',
            ],
            [
                'match_date'   => Carbon::parse('2025-09-25 19:30:00'),
                'home_club_id' => 2,
                'away_club_id' => 5,
                'venue'        => 'Bugesera Stadium',
            ],
            [
                'match_date'   => Carbon::parse('2025-09-27 14:00:00'),
                'home_club_id' => 6,
                'away_club_id' => 1,
                'venue'        => 'Huye Stadium',
            ],
            [
                'match_date'   => Carbon::parse('2025-09-29 16:00:00'),
                'home_club_id' => 5,
                'away_club_id' => 3,
                'venue'        => 'Kigali Arena',
            ],
            [
                'match_date'   => Carbon::parse('2025-10-01 18:00:00'),
                'home_club_id' => 4,
                'away_club_id' => 6,
                'venue'        => 'Rubavu Stadium',
            ],
        ]);
    }
}
