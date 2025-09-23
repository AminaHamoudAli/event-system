<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء 2 admin
        User::factory()->role('admin')->count(2)->create();

        // إنشاء 3 organizers
        User::factory()->role('organizer')->count(3)->create();

        // إنشاء 10 attendees
        User::factory()->role('attendee')->count(10)->create();
    }
}
