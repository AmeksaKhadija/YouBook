<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = DB::select('select * from books where isDisponible = 1');
        return view('reservation',['reservations'=>$reservations]); 
    }

}
