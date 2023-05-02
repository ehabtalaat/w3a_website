<?php

namespace App\Models\Course;

use App\Models\Image\Image;
use App\Models\User\User;
use App\Models\User\UserCourse;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'courses';
    public $translatedAttributes = ['title','features'];
    protected $translationForeignKey = 'course_id';
    
    protected $with = ["image"];

    protected $appends = ["video_link"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getVideoLinkAttribute()
    {
        return $this->video ? asset($this->video) : '';
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function IsBuyed($token) :bool{
        $user = User::where("api_token",$token)->first();

        $user_course = UserCourse::where([["course_id","=",$this->id],["user_id","=",$user->id ?? null]])->first();
        $is_buyed = false;

        if($user_course){
            $is_buyed = true;
        }
        return $is_buyed;
    }

}
