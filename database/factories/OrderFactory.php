<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Ticket;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition()
    {
        $ticket = Ticket::inRandomOrder()->first();

        return [
            'user_id' => User::where('role', 'attendee')->inRandomOrder()->first()->id,
            'ticket_id' => $ticket->id,
            'quantity' => $this->faker->numberBetween(1, 3),
            'total' => $ticket->price * $this->faker->numberBetween(1, 3),
            'pdf_path' => null, // لاحقًا يمكن توليد PDF عند الطلب
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
