<?php

namespace App\Models\CenterConsulting;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterConsultingFeature extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'center_consulting_features';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'center_consulting_feature_id';
    
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
