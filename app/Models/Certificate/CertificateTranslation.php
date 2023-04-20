<?php

namespace App\Models\Certificate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateTranslation extends Model
{
    use HasFactory;
    protected $table = 'certificate_translations';
    protected $fillable =   ['title','text'];
}
