<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\BookRateResource;
use App\Http\Resources\Website\BookResource;
use App\Http\Resources\Website\BookTypeResource;
use App\Models\BookType\Book;
use App\Models\BookType\BookRate;
use App\Models\BookType\BookType;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Validator;
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

    public function fetch_categories(){
        try{ 
            
            $categories = BookType::orderBy("id","desc")->get();

            //response

            $msg = "fetch_categories";
            $data =  BookTypeResource::collection($categories);

            return $this->dataResponse($msg, $data,200);

        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }

    public function fetch_books_by_category_id(Request $request){
        try{

               //validation

               $rules = [
                "category_id" => "required|exists:book_types,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }


             $books = Book::whereBookTypeId($request->category_id)->get();


                
            $msg = "fetch_books_by_category_id";

            $data =  BookResource::collection($books);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }

    public function fetch_book_details(Request $request){
        try{

               //validation

               $rules = [
                "book_id" => "required|exists:books,id"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $book = Book::whereId($request->book_id)->first();

             $books = Book::where("id","!=",$book->id)->paginate(3);


                
            $msg = "fetch_book_details";

            $data["details"] = new  BookResource($book);
            $data["other_books"] =  BookResource::collection($books);
            $data["rates"] =  BookRateResource::collection($book->rates);

            return $this->dataResponse($msg, $data,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
    public function rate_book(Request $request){
        try{

               //validation

               $rules = [
                "book_id" => "required|exists:books,id",
                "rate" => "required|numeric",
                "comment" => "required"
  
             ];
             $validator = Validator::make($request->all(), $rules);
         
             if ($validator->fails()) {
        
                 return $this->getvalidationErrors($validator);
                 
             }

             $user = auth()->user();

             $data["user_id"] = $user->id;
             $data["book_id"] = $request->book_id;
             $data["rate"] = $request->rate;
             $data["comment"] = $request->comment;

             BookRate::create($data);

            $msg = "تم التقييم بنجاح";

          

            return $this->successResponse($msg,200);

           } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }

    }
}
