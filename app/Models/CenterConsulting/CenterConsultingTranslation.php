<?php

namespace App\Models\CenterConsulting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterConsultingTranslation extends Model
{
    use HasFactory;
    protected $table = 'center_consulting_translations';
    protected $fillable =   ['title','text'];
}
