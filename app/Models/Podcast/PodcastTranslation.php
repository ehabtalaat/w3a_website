<?php

namespace App\Models\Podcast;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastTranslation extends Model
{
    use HasFactory;
    protected $table = 'podcast_translations';
    protected $fillable =   ['title','text'];
}
