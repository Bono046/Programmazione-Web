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
        Device::factory()->count(100)->create();


        
        DeviceModel::insert([
            ['name' => 'BR001', 'category' => 'Lora'],
            ['name' => 'GL300A', 'category' => 'Ant ext'],
            ['name' => 'GL320MG', 'category' => 'Bat ext'],
        ]);


        $deviceModels = DeviceModel::all();

        Device::all()->each(function ($device) use ($deviceModels) {
            $model = $deviceModels->random();
            $device->device_model_id = $model->id;
            $device->category = rand(0, 1) === 1 ? $model->category : null;
            $device->save();
        });

    }
}
