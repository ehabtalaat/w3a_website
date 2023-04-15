<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ReservationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Reservation\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $view = 'admin_dashboard.reservations.';
    protected $route = 'reservations.';


    public function index(ReservationDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    public function change_status(Request $request){
        $reservation = Reservation::whereId($request->id)->first();
        $data["status"] = $request->status;
        $reservation->update($data);
        $msg = __("messages.save successful");

        return response()->json(["status" => true,"message" => $msg]);
    }

    public function show($id)
    {
        $reservation = Reservation::whereId($id)->firstOrFail();
        return view($this->view . 'show', compact('reservation'));
    }
    
    public function result($id)
    {
        $reservation = Reservation::whereId($id)->firstOrFail();
        return view($this->view . 'result', compact('reservation'));
    }
    public function save_result($id,Request $request){
        $reservation = Reservation::whereId($id)->firstOrFail();

        $reservation->result()->updateOrCreate([
            "doctor_notes" => $request->doctor_notes
        ]);


        if($request->images && count($request->images) > 0){
            foreach($reservation->result->images ?? [] as $image){

             $image->image ? delete_image($image->image) : null;

            }

            foreach($request->images as $image){
                $data_image["image"] = upload_image($image, "reservations");
                 //save image 
            $reservation->result->images()->create($data_image);
            }
            }

        return redirect()->route($this->route . "index")
        ->with(['success'=> __("messages.editmessage")]);
    }

}
