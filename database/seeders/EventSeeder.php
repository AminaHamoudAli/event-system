<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $organizers = User::where('role', 'organizer')->get();

        foreach ($organizers as $organizer) {
            Event::factory()->count(3)->create([
                'organizer_id' => $organizer->id,
            ]);
        }
    }
}
