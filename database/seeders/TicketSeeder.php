<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            Ticket::factory()->count(5)->create([
                'event_id' => $event->id,
                'ticket_type' => 'general',
                'price' => rand(10, 100),
                'quantity' => rand(50, 200),
            ]);
        }
    }
}
