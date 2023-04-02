<?php

namespace App\Models\Doctor;

use App\Models\Day\Day;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDay extends Model
{
    use HasFactory;
    protected $table = 'doctor_days';
    protected $guarded = [];
    public function times(){
        return $this->hasMany(DoctorDayTime::class)->where("active", 1);;
    }
    public function day(){
        return $this->belongsTo(Day::class);
    }

}
