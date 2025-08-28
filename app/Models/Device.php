<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- IMPORT CORRETTO
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory; // <-- UTILIZZO DEL TRAIT

    protected $fillable = ['serial', 'imei', 'iccid'];


    public function races()
    {
        return $this->belongsToMany(Race::class);
    }

    public function deviceModel()
    {
        return $this->belongsTo(DeviceModel::class);
    }


}
