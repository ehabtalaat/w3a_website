<?php

namespace App\Models\PaymentMethod;

use App\Models\Image\Image;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $table = 'payment_methods';
    public $translatedAttributes = ['title','text'];
    protected $translationForeignKey = 'payment_method_id';
    
    protected $with = ["image"];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function scopeOnline($query){
        return $query->where("offline_type",0)->orWhere("offline_type",2);
    }
    public function scopeOffline($query){
        return $query->where("offline_type",1)->orWhere("offline_type",2);
    }
}
