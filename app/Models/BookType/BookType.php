<?php

namespace App\Models\BookType;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'book_types';
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'book_type_id';
    
    
}
