<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    
    public static function getCategoryById($id)
    {
        $model = self::find($id);
        return $model ? $model->category : null;
    }
}
