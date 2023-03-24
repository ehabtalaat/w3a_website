<?php

namespace App\Models\Experience;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'experiences';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'experience_id';
    
   
}
