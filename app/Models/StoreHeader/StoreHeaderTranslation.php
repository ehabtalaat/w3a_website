<?php

namespace App\Models\StoreHeader;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreHeaderTranslation extends Model
{
    use HasFactory;
    protected $table = 'store_header_translations';
    protected $fillable =   ['title','text'];
}
