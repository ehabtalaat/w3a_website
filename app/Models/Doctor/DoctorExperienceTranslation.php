<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorExperienceTranslation extends Model
{
    use HasFactory;
    protected $table = 'doctor_experience_translations';
    protected $fillable =   ['title','text'];
}
