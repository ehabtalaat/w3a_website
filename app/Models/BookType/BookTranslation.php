<?php

namespace App\Models\BookType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTranslation extends Model
{
    use HasFactory;
    protected $table = 'book_translations';
    protected $fillable =  ['title','mini_text','text'];
}
