<?php

namespace App\Models\WebsiteText;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteTextTranslation extends Model
{
    use HasFactory;
    protected $table = 'website_text_translations';
    protected $fillable = ['features_text','courses_text','store_text','doctors_text','blog_text','brief_text','website_reasons_text','experiences_text'];
}
