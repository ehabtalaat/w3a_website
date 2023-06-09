<?php

namespace App\Models\AboutDoctor;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class AboutDoctor extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'about_doctor_id';
    protected $table = 'about_doctors';
    protected $guarded = [];
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
