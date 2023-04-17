<?php

namespace App\Models\WebsiteText;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteText extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['features_text','courses_text','store_text','doctors_text','blog_text','brief_text','website_reasons_text','experiences_text'];
    protected $translationForeignKey = 'website_text_id';
    protected $table = 'website_texts';
    protected $guarded = [];


}
