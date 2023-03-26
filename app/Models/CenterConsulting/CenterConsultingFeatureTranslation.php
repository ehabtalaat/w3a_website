<?php

namespace App\Models\CenterConsulting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterConsultingFeatureTranslation extends Model
{
    use HasFactory;
    protected $table = 'center_consulting_feature_translations';
    protected $fillable =   ['title','text'];
}
