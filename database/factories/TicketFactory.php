<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class TicketFactory extends Factory
{
    protected $model = \App\Models\Ticket::class;

    public function definition()
    {
        return [
            'event_id' => Event::factory(), // أو تختار حدث موجود
            'attendee_id' => null, // سيبقى فارغ عند الإنشاء
            'ticket_type' => $this->faker->randomElement(['general', 'vip']),
            'price' => $this->faker->randomFloat(2, 10, 200), // بين 10 و200
            'status' => 'available',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
