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

}
