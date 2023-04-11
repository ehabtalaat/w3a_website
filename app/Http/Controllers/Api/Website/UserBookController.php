<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\BookResource;
use App\Models\BookType\Book;
use App\Models\User\UserBook;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
class UserBookController extends Controller
{
    use ApiTrait;
  
    public function buy(Request $request){
        try{

               //validation

               $rules = [
                "book_id" => "required|exists:books,id",
                "payment_method_id" => "required|exists:payment_methods,id",
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }


             $user =  auth()->user();

             $book = Book::whereId($request->book_id)->first();

             $data["book_id"] = $book->id;
             $data["price"] = $book->price;
             $data["user_id"] = $user->id;
             $data["payment_method_id"] = $request->payment_method_id;


             UserBook::create($data);
                
            $msg = "تمت عمليه الشراء بنجاح";


            return $this->successResponse($msg,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }

    public function index(){
        try{ 
            
            $user = auth()->user();
            $books = $user->books;

            //response

          
            
            $msg = "your_books";
            $data =  BookResource::collection($books);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

   
}
