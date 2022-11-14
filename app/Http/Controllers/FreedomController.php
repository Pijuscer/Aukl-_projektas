<?php

namespace App\Http\Controllers;
use App\Models\freedom;
use App\Models\Kids_profile;
use App\Models\User;
use App\Models\Users_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreedomController extends Controller
{
    public function index(){
        $freedoms = freedom::all();
        return view('all_working_days', compact('freedoms'));
        
    }
    public function viewForm(){
        //TODO: fentch countries from database
        $freedoms  = freedom::all();
        return view('working_days', ['working_days' => $freedoms ]);

    }
    public function store(Request $request){
        //dd($request);
        //Validacija
        $validated = $request -> validate([
            'date' => 'required',
            'time' => 'required',
            
        ]);

        freedom::create([
            'date' => request('date'),
            'time' => request('time'),
        ]);

        return redirect('/working_days');
    }
    public function editForm($id){
        $freedoms = freedom::where('id', $id)->firstOrFail();

        return view('edit_working_days',compact("freedoms"));
    }
    public function edit(Request $request, $id){
         //Validacija

         $validated = $request -> validate([
            'date' => 'required',
            'time' => 'required',
    
         ]);
         
        $freedoms = freedom::where('id', $id)->firstOrFail();

        $freedoms->date = request('date');
        $freedoms->time = request('time');
        $freedoms->save();

        return redirect('/all_working_days');
    }

    public function removeForm($id){
        $freedoms = freedom::where('id', $id)->firstOrFail(); 

        return view('remove_working_days]',compact("freedom"));
    }
    public function remove($id){
        $freedoms = freedom::where('id', $id)->firstOrFail();
        $freedoms->delete();

        return redirect('/all_working_days');
    }
    public function search(){
        $freedoms = freedom::where('id', 'LIKE', '%' .$_GET['query'].'%')->
        orWhere('date', $_GET['query'])->
        orWhere('time', $_GET['query'])->get();

        return view('all_working_days', compact('freedoms'));
    }
    public function check_time(Request $request){

        $hours=freedom::where("date",$request->date)->get();

        $kids=Kids_profile::where("user_profile_id", Users_profile::where("user_id", Auth::user()->id)->first()->id)->get();
        
        $day=$request->date;
        return view('order_cares',compact("hours", "kids", "day"));
    }

}
