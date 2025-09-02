<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissingDevice extends Model
{
    protected $fillable = ['race_id', 'device_id', 'returned'];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
