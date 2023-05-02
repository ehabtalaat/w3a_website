<?php

namespace App\Models\Doctor;

use App\Models\Consultation\Consultation;
use App\Models\Day\Day;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laratrust\Traits\LaratrustUserTrait;

class Doctor extends Authenticatable
{
    use HasFactory,Translatable,LaratrustUserTrait;
    public $translatedAttributes = ['mini_description','description'];
    protected $translationForeignKey = 'doctor_id';
    protected $table = 'doctors';
    protected $guarded = [];

    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    
    public function experiences(){
        return $this->hasMany(doctorExperience::class);
    }

    public function consultations(){
            return $this->belongsToMany(Consultation::class,'doctor_consultations',
            'doctor_id','consultation_id')->withPivot(["time", "price"]);
    }


   

    public function days(){
        return $this->belongsToMany(Day::class ,'doctor_days', 'doctor_id','day_id');
    }

  
    
    public function doctor_days(){
        return $this->hasMany(DoctorDay::class)->where("active",1)->where("offline",0);
    }
    public function doctor_offline_days(){
        return $this->hasMany(DoctorDay::class)->where("active",1)->where("offline",1);
    }

 
    public function scopeDoctor($query)
    {
        return $query->whereType(2);
    }
   
    public function scopeActive($query){
        $query->where('active' , 1);
    }

    public function getRateAttribute():float
    {
        return doubleval(0);
    } 

}
