<?php

namespace App\Models\Doctor;

use App\Models\Day\Day;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDayTime extends Model
{
    use HasFactory;
    protected $table = 'doctor_day_times';
    protected $guarded = [];

    protected $appends =['from_time_format','to_time_format'];

    public function doctor_day(){
        return $this->belongsTo(DoctorDay::class);
    }

    public function day(){
        return $this->belongsTo(Day::class);
    }
 

    public function getFromTimeFormatAttribute(){
        return $this->from_time ? Carbon::parse($this->from_time)->format('g:i A') : null;
    }

    public function getToTimeFormatAttribute(){
        return $this->from_time ? Carbon::parse($this->to_time)->format('g:i A') : null;
    }
}
