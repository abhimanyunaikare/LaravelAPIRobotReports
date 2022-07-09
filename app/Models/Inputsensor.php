<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parameter;
use App\Models\Robot;

class Inputsensor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parameter_id',
        'robot_id',
        'value'
    ];

    public function robot(){
        return $this->belongsTo(Robot::class);
    }

    public function parameter(){
        return $this->belongsTo(Parameter::class);
    }
}
