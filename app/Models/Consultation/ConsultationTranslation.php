<?php

namespace App\Models\Consultation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationTranslation extends Model
{
    use HasFactory;
    protected $table = 'consultation_translations';
    protected $fillable =   ['title','text'];
}
