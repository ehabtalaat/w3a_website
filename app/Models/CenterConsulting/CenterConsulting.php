<?php

namespace App\Models\CenterConsulting;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class CenterConsulting extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'center_consulting_id';
    protected $table = 'center_consultings';
    protected $guarded = [];
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function features(){
        return $this->hasMany(CenterConsultingFeature::class);
    }
}
