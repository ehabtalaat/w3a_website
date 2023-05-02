<?php

namespace App\Models\Podcast;

use App\Models\Image\Image;
use App\Models\User\User;
use App\Models\User\UserPodcast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;

class Podcast extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'podcast_id';
    protected $table = 'podcasts';
    protected $guarded = [];
    protected $with = ["image"];

    protected $appends = ["audio_link"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getAudioLinkAttribute()
    {
        return $this->audio ? asset($this->audio) : '';
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,"podcast_tags","podcast_id","tag_id");
    }

    public function getDateAttribute()
    {
        return $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d') : "";
    }
    public function scopeMostlistened($query){
        return $query;
    }
    public function IsBuyed($token) :bool{
        $user = User::where("api_token",$token)->first();

        $user_podcast = UserPodcast::where([["podcast_id","=",$this->id],["user_id","=",$user->id ?? null]])->first();
        $is_buyed = false;

        if($user_podcast){
            $is_buyed = true;
        }
        return $is_buyed;
    }
}
