<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory; 

    protected $fillable = ['serial', 'imei', 'iccid', 'device_model_id', 'category'];


    public function races()
    {
        return $this->belongsToMany(Race::class);
    }

    public function deviceModel()
    {
        return $this->belongsTo(DeviceModel::class);
    }


}
