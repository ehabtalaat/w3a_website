<?php


 function upload_image($image, $folder)
 {
     $img = Image::make($image);
     $mime = $img->mime();
     $mim = explode('/', $mime)[1];
     $extension = '.' . $mim;
     $rand = rand(10, 100000);
     $name = $rand .time() . $extension;
     $upload_path = 'uploads/' . $folder;
     $image_url = $upload_path . '/' . $name;

     if (!file_exists(public_path($upload_path))) {
         mkdir(public_path($upload_path), 775, true);
     }

     $img->save(public_path($image_url));
     return $image_url;
 }














 function delete_image($path)
 {
     if ($path != "uploads/default.jpg") {
         File::delete(public_path($path));
     }
     
 }
    




 function upload_video($video, $file)
 {
     $videoName = time() . rand(1, 9999) . '.' . $video->getClientOriginalExtension();
     $path = $video->storeAs($file, $videoName, 'uploads');
     return 'uploads/' . $path;
 }


 function upload_pdf($pdf, $file)
 {
     $pdfName = time() . rand(1, 9999) . '.' . $pdf->getClientOriginalExtension();
     $path = $pdf->storeAs($file, $pdfName, 'uploads');
     return 'uploads/' . $path;
 }



 function hash_user_password($password)
 {
     return  Hash::make($password);
 }
  function get_distance($lat1, $lon1, $lat2, $lon2, $unit = "k") {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
  
    if ($unit == "k") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
    
  }
