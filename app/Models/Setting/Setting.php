<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Setting extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['address'];
    protected $translationForeignKey = 'setting_id';
    protected $table = 'settings';
    protected $guarded = [];
}
