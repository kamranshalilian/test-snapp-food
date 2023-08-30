<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Agent;
use App\Models\Order;
use App\Models\Trip;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Vendor::factory(5)->create();
        Agent::factory(5)->create();
        Order::factory(20)->create();
    }
}
