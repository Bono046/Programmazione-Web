<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\DeviceModel;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::factory()->count(20)->create();


        
        DeviceModel::insert([
            ['name' => 'BR001', 'category' => 'Lora'],
            ['name' => 'GL300A', 'category' => 'Ant ext'],
            ['name' => 'GL320MG', 'category' => 'Bat ext'],
        ]);

        
    }
}
