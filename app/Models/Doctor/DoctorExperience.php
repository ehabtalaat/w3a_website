<?php

namespace App\Models\Doctor;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorExperience extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'doctor_experiences';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'doctor_experience_id';
    
   
}
