<?php

namespace App\Models\AboutPodcast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPodcastTranslation extends Model
{
    use HasFactory;
    protected $table = 'about_podcast_translations';
    protected $fillable =   ['title','text'];
}
