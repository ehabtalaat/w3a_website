<?php

namespace App\Models\Consultation;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'consultations';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'consultation_id';
    
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
