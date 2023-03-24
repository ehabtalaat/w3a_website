<?php

namespace App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceTranslation extends Model
{
    use HasFactory;
    protected $table = 'experience_translations';
    protected $fillable =   ['title','text'];
}
