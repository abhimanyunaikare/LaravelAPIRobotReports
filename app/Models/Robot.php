<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Robotmodel;
use App\Models\City;
use App\Models\Inputsensor;

class Robot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
        'city_id',
        'robotmodel_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function robotmodel(){
        return $this->belongsTo(Robotmodel::class);
    }

    public function inputsensor(){
        return $this->hasMany(Inputsensor::class);
    }

}
