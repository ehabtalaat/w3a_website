<?php

namespace App\Models\Reservation;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReservationResult extends Model
{
    use HasFactory;

    protected $table = 'reservation_results';
    protected $guarded = [];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    

  
}
