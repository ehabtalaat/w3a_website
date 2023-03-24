<?php

namespace App\Models\WebsiteReason;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteReason extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'website_reasons';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'website_reason_id';
    
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
