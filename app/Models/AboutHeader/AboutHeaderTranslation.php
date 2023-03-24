<?php

namespace App\Models\AboutHeader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutHeaderTranslation extends Model
{
    use HasFactory;
    protected $table = 'about_header_translations';
    protected $fillable =   ['title','text'];
}
