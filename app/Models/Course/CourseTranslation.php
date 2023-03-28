<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
    use HasFactory;
    protected $table = 'course_translations';
    protected $fillable =   ['title','features'];
}
