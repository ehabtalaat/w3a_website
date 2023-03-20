<?php

namespace App\Models\MainHeader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainHeaderTranslation extends Model
{
    use HasFactory;
    protected $table = 'main_header_translations';
    protected $fillable =   ['title','text'];
}
