<?php

namespace App\Models\Reservation;

use App\Models\Consultation\Consultation;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorDayTime;
use App\Models\Image\Image;
use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $guarded = [];
    protected $appends = ["contact_type_title","from_time_format","to_time_format","created_at_format"];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function result(){
        return $this->hasOne(ReservationResult::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function day_time(){
        return $this->belongsTo(DoctorDayTime::class,"doctor_day_time_id");
    }

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }
    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }
    public function getContactTypeTitleAttribute(){
        if($this->contact_type == 1){
            return __('messages.online');
        }elseif($this->contact_type == 2){
            return __('messages.offline');
        }
    }
    
    public function getFromTimeFormatAttribute(){
        return $this->day_time ? Carbon::parse($this->day_time->from_time)->format('g:i A')  : "";
    }

    public function getToTimeFormatAttribute(){
        return $this->day_time ? Carbon::parse($this->day_time->to_time)->format('g:i A') : "";
    }

    public function getCreatedAtFormatAttribute(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }

}
