<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorCertificateTranslation extends Model
{
    use HasFactory;
    protected $table = 'doctor_certificate_translations';
    protected $fillable =   ['title','text'];
}
