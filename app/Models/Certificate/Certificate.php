<?php

namespace App\Models\Certificate;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Certificate extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'certificate_id';
    protected $table = 'certificates';
    protected $guarded = [];
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
