<?php

namespace App\Models\Reservation;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $guarded = [];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

  
}
