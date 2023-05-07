<?php

namespace App\Models\Doctor;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class DoctorCertificate extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'doctor_certificate_id';
    protected $table = 'doctor_certificates';
    protected $guarded = [];
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
