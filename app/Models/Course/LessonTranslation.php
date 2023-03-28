<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonTranslation extends Model
{
    use HasFactory;
    protected $table = 'lesson_translations';
    protected $fillable =   ['title','text'];
}
