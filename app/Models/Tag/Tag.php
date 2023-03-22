<?php

namespace App\Models\Tag;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'tags';
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'tag_id';
    
    
}
