<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\BookType\Book;
use App\Models\Course\Course;
use App\Models\Image\Image;
use App\Models\Podcast\Podcast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ["image"];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function books(){
        return $this->belongsToMany(Book::class ,'user_books', 'user_id','book_id');
    }

    public function courses(){
        return $this->belongsToMany(Course::class ,'user_courses', 'user_id','course_id');
    }

    public function podcasts(){
        return $this->belongsToMany(Podcast::class ,'user_podcasts', 'user_id','podcast_id');
    }

   
}
