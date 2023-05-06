<?php

namespace App\Models\BookType;

use App\Models\Image\Image;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRate extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'book_rates';

    
    public function getDateFormatAttribute(){
        return Carbon::parse($this->created_at)->format('Y-m-d g:i A') ;
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
