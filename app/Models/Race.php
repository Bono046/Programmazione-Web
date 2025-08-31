<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date', 'description'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date']; // comodo per le date


    public function devices()
    {
        return $this->belongsToMany(Device::class);
    }
}
