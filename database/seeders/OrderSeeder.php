<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory()->count(20)->create(); // إنشاء 20 طلب بشكل عشوائي
    }
}
