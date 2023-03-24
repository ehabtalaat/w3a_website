<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodTranslation extends Model
{
    use HasFactory;
    protected $table = 'payment_method_translations';
    protected $fillable =   ['title','text'];
}
