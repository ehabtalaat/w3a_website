<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'user_courses';
    
}
