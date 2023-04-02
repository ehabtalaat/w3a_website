<?php

namespace App\Models\Day;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayTranslation extends Model
{
    use HasFactory;
    protected $table = 'day_translations';
    protected $fillable =  ['title'];
}
