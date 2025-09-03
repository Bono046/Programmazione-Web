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
        /*
    $race = Race::create([
        'name' => 'Gara Test',
        'start_date' => now(),
        'end_date' => now()->addDays(3),
    ]);
    */

    $races = Race::factory()->count(5)->create();

    $races->each(function ($race) {
        $race->devices()->attach(Device::inRandomOrder()->take(random_int(10, 20))->pluck('id'));
    });
}
}

