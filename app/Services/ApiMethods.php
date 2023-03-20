<?php

namespace App\Services;

use  App\Traits\ApiTrait;

class ApiMethods
{
    use ApiTrait;
   


    public static function checkTableModel($model,$id,$word){

        $table = $model::where("id",$id)->first();

      if(!$table){

        $msg = "لا يوجد " .$word . " ". "بهذا الاسم";

        return response()->json([
            'status' => false,
            'message' => $msg,
        ], 200);
      }
    
    }

    public static function checkModelIds($model,array $ids,$word){

      foreach($ids as $id){
      $table = $model::where("id",$id)->first();

      if(!$table){

          $msg = "لا يوجد " . $word  . ' بهذا الاسم';
          
          return response()->json([
            'status' => false,
            'message' => $msg,
        ], 200);
      }
  }
  }
   
}