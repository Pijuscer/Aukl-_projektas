<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Users_profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(){
        if(auth()->user()->roles!=0){
            $reservation = Reservation::all();
        }
        else{
            $reservation = Reservation::where("user_profile", Users_profile::where("user_id",auth()->user()->id)->first()->id)->get();
        }
      
        return view('reservations', compact('reservation'));
        
    }

    public function store(Request $request){
        

        if($request->date<now()){
            return redirect()->route("choose_time");

        }

        foreach($request->kid as $kid){
            foreach($request->hours as $hour){

                $validated = $request -> validate([
                    'date' => 'required',
                    'hours' => 'required',
                    
                ]);
                
                if(15<=count(Reservation::where("date", $request->date)->where("time", $hour)->get())){
                    $child=Reservation::create([
                        'date' => request('date'),
                        'time' => $hour,
                        'kid_profile' => $kid,
                        'user_profile' => Users_profile::where("user_id", Auth::user()->id)->first()->id
                        
                    ]);
                }
                                
                Reservation::where("date",$child->date)->where("time",$child->time)->where("kid_profile",$child->kid_profile)->where("id","!=",$child->id)->delete();
                
            }
        }
        return redirect()->route("reservation");
    }
    public function search(){
        $reservation = Reservation::where('id', 'LIKE', '%' .$_GET['query'].'%')->
        orWhere('date', $_GET['query'])->
        orWhere('time', $_GET['query'])->
        orWhere('kid_profile', $_GET['query'])->
        orWhere('user_profile', $_GET['query'])->get();

        return view('reservations', compact('reservation'));
    }

}
