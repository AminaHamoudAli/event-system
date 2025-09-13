<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\User;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // نجيب أول 5 مستخدمين ليكونوا منظمين
        $organizers = User::take(5)->get();

        foreach ($organizers as $organizer) {
            Event::factory()->count(2)->create([
                'organizer_id' => $organizer->id,
            ]);
        }
    }
}
