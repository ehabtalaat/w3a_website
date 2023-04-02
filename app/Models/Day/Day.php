<?php

namespace App\Models\Day;

use App\Models\Doctor\Doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Day extends Model
{
    use HasFactory,Translatable;

    protected $guarded = [];
    protected $table = 'days';
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'day_id';
}
