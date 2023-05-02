<?php

namespace App\Models\BookType;

use App\Models\Image\Image;
use App\Models\User\User;
use App\Models\User\UserBook;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'books';
    public $translatedAttributes = ['title','mini_text','text'];
    protected $translationForeignKey = 'book_id';
    
    protected $with = ["image"];

    protected $appends = ["pdf_link"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getPdfLinkAttribute()
    {
        return $this->pdf ? asset($this->pdf) : '';
    }
    public function IsBuyed($token) :bool{
        $user = User::where("api_token",$token)->first();

        $user_book = UserBook::where([["book_id","=",$this->id],["user_id","=",$user->id ?? null]])->first();
        $is_buyed = false;

        if($user_book){
            $is_buyed = true;
        }
        return $is_buyed;
    }
}
