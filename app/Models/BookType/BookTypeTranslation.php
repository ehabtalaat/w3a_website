<?php

namespace App\Models\BookType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTypeTranslation extends Model
{
    use HasFactory;
    protected $table = 'book_type_translations';
    protected $fillable =   ['title'];
}
