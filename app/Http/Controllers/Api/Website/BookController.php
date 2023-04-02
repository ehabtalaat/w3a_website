<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\BookResource;
use App\Models\BookType\Book;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiTrait;
    public function fetch_home_books(){
        try{ 
            
            $books = Book::orderBy("id","desc")->paginate(2);

            //response

          
            
            $msg = "fetch_home_books";
            $data =  BookResource::collection($books);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

}
