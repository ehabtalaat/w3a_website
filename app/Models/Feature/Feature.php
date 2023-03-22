<?php

namespace App\Models\Feature;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'features';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'feature_id';
    
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
