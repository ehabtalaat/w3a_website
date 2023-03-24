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
}
