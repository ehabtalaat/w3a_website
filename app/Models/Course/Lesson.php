<?php

namespace App\Models\Course;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'lessons';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'lesson_id';
    
    protected $with = ["image"];

    protected $appends = ["video_link"];
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getVideoLinkAttribute()
    {
        return $this->video ? asset($this->video) : '';
    }

}
