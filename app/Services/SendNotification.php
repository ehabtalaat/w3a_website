<?php

namespace App\Services;

use Admin\Models\Pharmacy\Pharmacy;
use Admin\Models\Pharmacy\PharmacyAttachment;

class SendNotification
{

    protected static $URL = "https://fcm.googleapis.com/fcm/send";  

  

    public static function send(array $tokens , $title,$text,$type = "public",$pharmacy_id = null,$data=null,$message = null)
    {
        $pharmacy_attachment = PharmacyAttachment::wherePharmacyId($pharmacy_id)->first();
          //$NOTIFICATION_KEY =  $pharmacy_attachment->notification_key ?? "";  

          $NOTIFICATION_KEY = "AAAA16nATpI:APA91bHUK6LMnLvcAp2oQVmkRyqKiTSBxo7mMzR5o4wNO6_yt_cOaAnG0HNygi8N2IhEtIC7OHge3Yes_LGAdro1Y-l6L-GONKNcYVo600vkzZHfewlWFKvxVtKTEqZ5d2WEmw2WkBxU";
        $data = [
          //  "to" =>$token,
            'registration_ids' => $tokens,
            "data" =>[
                    "title" => $title,
                    'body' => $text,
                    "type"=>$type,
                    "order"=>$data,
                    "message" => $message,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK"
                ], 
               
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $NOTIFICATION_KEY, 
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result=curl_exec($ch);
        return true;
    }
}