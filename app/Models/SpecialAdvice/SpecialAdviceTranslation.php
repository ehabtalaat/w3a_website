<?php

namespace App\Models\SpecialAdvice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialAdviceTranslation extends Model
{
    use HasFactory;
    protected $table = 'special_advice_translations';
    protected $fillable =   ['title','text'];
}
