<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Hourlydata extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
