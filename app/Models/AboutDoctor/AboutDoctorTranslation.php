<?php

namespace App\Models\AboutDoctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutDoctorTranslation extends Model
{
    use HasFactory;
    protected $table = 'about_doctor_translations';
    protected $fillable =   ['title','text'];
}
