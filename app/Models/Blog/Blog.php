<?php

namespace App\Models\Blog;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'blogs';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'blog_id';
    
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
