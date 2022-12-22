<?php

namespace App\Http\Controllers;

use App\Models\Kids_profile;
use App\Models\Reservation;
use App\Models\Users_profile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\ElementNode;

class ReservationController extends Controller
{
    public function index(){
        if(auth()->user()->roles!=0){
            $reservation = Reservation::all();
            $users = Users_profile::all();
            $kids = Kids_profile::all();
        }
        else{
            $reservation = Reservation::where("user_profile", Users_profile::where("user_id", Auth::user()->id)->first()->id)->get();
            $user = Users_profile::where("user_id", Auth::user()->id)->first();
            $users = array($user);
            
            $kids = Kids_profile::where("user_profile_id",$user->id)->get();
        }
      
        return view('reservations', compact('reservation', 'users', 'kids'));
        
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
                if(15>=count(Reservation::where("date", $request->date)->where("time", $hour)->get())){
                    $reservation=Reservation::create([
                        'date' => request('date'),
                        'time' => $hour,
                        'kid_profile' => $kid,
                        'user_profile' => Users_profile::where("user_id", Auth::user()->id)->first()->id
                        
                    ]);
                    
                }            
                Reservation::where("date",$reservation->date)->where("time",$reservation->time)->where("kid_profile",$reservation->kid_profile)->where("id","!=",$reservation->id)->delete();
                
            }
        }
        return redirect()->route("reservation")->with('message_reservation', 'Sėkmingai rezervavotes laiką!');
    }
    public function search(){
        $reservation = Reservation::where('id', 'LIKE', '%' .$_GET['query'].'%')->
        orWhere('date', $_GET['query'])->
        orWhere('time', $_GET['query'])->get();

        $users = Users_profile::all();
        $kids = Kids_profile::all();
        return view('reservations', compact('reservation', 'users', 'kids'));
    }

}
