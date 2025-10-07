<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Notification::create([
            'user_id' => 1,
            'title' => 'Transfer Approved',
            'message' => 'Player John Doe has been approved by the admin.',
            'type' => 'success'
        ]);

        Notification::create([
            'user_id' => 1,
            'title' => 'Pending Review',
            'message' => 'New player transfer request awaiting approval.',
            'type' => 'warning'
        ]);
    }
}
