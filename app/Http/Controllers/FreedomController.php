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
    ///Paimama is duomenu bazes visas valandas ir atvaiduoja puslapyje
    public function index(){
        $freedoms = freedom::all();
        return view('all_working_days', compact('freedoms'));
        
    }
    public function viewForm(){
        $freedoms  = freedom::all();
        return view('working_days', ['working_days' => $freedoms ]);

    }
    ///Ikelia dienas ir valandas i duomenu baze
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

        return redirect('/working_days')->with('message_freedom_add', 'Sėkmingai pridėjote!');
    }
    ///Atidaro redagavimo puslapi
    public function editForm($id){
        $freedoms = freedom::where('id', $id)->firstOrFail();

        return view('edit_working_days',compact("freedoms"));
    }
    ///Pakeiti redagavime informacija ir išsaugai
    public function edit(Request $request, $id){

         $validated = $request -> validate([
            'date' => 'required',
            'time' => 'required',
    
         ]);
         
        $freedoms = freedom::where('id', $id)->firstOrFail();

        $freedoms->date = request('date');
        $freedoms->time = request('time');
        $freedoms->save();

        return redirect('/all_working_days')->with('message_freedom_edit', 'Sėkmingai redagavote!');
    }
    public function removeForm($id){
        $freedoms = freedom::where('id', $id)->firstOrFail(); 

        return view('remove_working_days]',compact("freedom"));
    }
    ///Pasirinkus ir informacija paspaudžia Ištrinti mygtuka ir informacija ištrinama
    public function remove($id){
        $freedoms = freedom::where('id', $id)->firstOrFail();
        $freedoms->delete();

        return redirect('/all_working_days')->with('message_freedom_delete', 'Sėkmingai ištrynėte!');
    }
    ///Dienu ir valandu paieška
    public function search(){
        $freedoms = freedom::where('id', 'LIKE', '%' .$_GET['query'].'%')->
        orWhere('date', $_GET['query'])->
        orWhere('time', $_GET['query'])->get();

        return view('all_working_days', compact('freedoms'));
    }
    ///Tikrina valandas butent ta diena kuria vartotojas pasirenka ir atvaizduoja galimas valandas
    public function check_time(Request $request){
        ///gauna valandas iš pasirenktos dienos
        $hours=freedom::where("date",$request->date)->get();
        ///Jei nera valandu tiesiog grazina atgal
        if(count($hours)<1){
            return redirect()->back();
        }
        ///Atvaizduoja vaiko profili kur pagal jo tevo ID
        $kids=Kids_profile::where("user_profile_id", Users_profile::where("user_id", Auth::user()->id)->first()->id)->get();
        ///Paima ta diena pasirenkta vartotojo
        $day=$request->date;
        return view('order_cares',compact("hours", "kids", "day"));
    }

}
