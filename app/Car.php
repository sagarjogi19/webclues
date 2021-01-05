<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'color', 
        'make_date',
        'fuel_type',
        'description',
        'location',
        'lat',
        'lng',
        'is_active',
    ];
    
    public function images()
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }
}
