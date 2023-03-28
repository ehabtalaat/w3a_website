<?php

namespace App\Models\BookType;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'books';
    public $translatedAttributes = ['title','mini_text','text'];
    protected $translationForeignKey = 'book_id';
    
    protected $with = ["image"];

    protected $appends = ["pdf_link"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getPdfLinkAttribute()
    {
        return $this->pdf ? asset($this->pdf) : '';
    }
    
}
