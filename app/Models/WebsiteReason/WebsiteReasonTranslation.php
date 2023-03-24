<?php

namespace App\Models\WebsiteReason;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteReasonTranslation extends Model
{
    use HasFactory;
    protected $table = 'website_reason_translations';
    protected $fillable =   ['title','text'];
}
