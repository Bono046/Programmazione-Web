<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Race;
use App\Models\Device;

class RaceSeeder extends Seeder
{
   public function run()
    {
    $race = Race::create([
        'name' => 'Gara Test',
        'start_date' => now(),
        'end_date' => now()->addDays(3),
    ]);

    $race->devices()->attach(Device::inRandomOrder()->take(5)->pluck('id'));
    }
}

