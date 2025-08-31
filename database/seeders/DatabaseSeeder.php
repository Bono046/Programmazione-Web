<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeviceModel;
use App\Models\Device;
use App\Models\Race;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(DeviceSeeder::class);
        $this->call(RaceSeeder::class);
        

        //User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@unibs.it',
            'password' => Hash::make('pass'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@unibs.it',
            'password' => Hash::make('password'),
            'role' => 'operator',
        ]);

        User::factory()->create([
            'name' => 'Organization',
            'email' => 'organization@unibs.it',
            'password' => Hash::make('password'),
            'role' => 'organization',
        ]);

    }
}
