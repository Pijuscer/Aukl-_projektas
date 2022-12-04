<?php

namespace App\Http\Controllers;
use App\Models\kids_profile;
use App\Models\User;
use App\Models\Users_profile;
use Illuminate\Http\Request;

class KidsProfileController extends Controller
{
    public function index(){
        $kids_profiles = kids_profile::all();
        return view('all_kids_profiles', compact('kids_profiles'));
        
    }
    public function index3(){
        
        $kids_profiles = kids_profile::all();
        $users_profiles = Users_profile::where("user_id", auth()->user()->id)->first();
        if(!$users_profiles){
            
            return view('my_kids_profiles', compact('kids_profiles'));
        }
        return view('my_kids_profiles', compact('kids_profiles',"users_profiles"));
        
    }
    
    public function viewForm(){
        $kids_profiles  = kids_profile::all();
        return view('add_kids_profiles', ['add_kids_profiles' => $kids_profiles ]);

    }
    public function store(Request $request){

        $validated = $request -> validate([
            'user_profile_id',
            'kid_name' => 'required|max:225',
            'kid_surname' => 'required|max:225',
            'date_of_birth' => 'required',
            'additional_information' => 'required|max:225',

        ]);

        kids_profile::create([
            'user_profile_id'=> Users_profile::where("user_id",auth()->user()->id,)->first()->id,
            'kid_name' => request('kid_name'),
            'kid_surname' => request('kid_surname'),
            'date_of_birth' => request('date_of_birth'),
            'additional_information' => request('additional_information'),
        ]);

        return redirect('/my_kid_profiles')->with('message_kid_profile_add', 'Sėkmingai pridėjote!');
    }
    public function editForm($id){
        $kids_profiles = kids_profile::where('id', $id)->firstOrFail();

        return view('edit_kids_profiles',compact("kids_profiles"));
    }
    public function edit(Request $request, $id){

         $validated = $request -> validate([
            'kid_name' => 'required|max:225',
            'kid_surname' => 'required|max:225',
            'date_of_birth' => 'required',
            'additional_information' => 'required|max:225',
    
         ]);

        $kids_profiles = kids_profile::where('id', $id)->firstOrFail();

        $kids_profiles->kid_name = request('kid_name');
        $kids_profiles->kid_surname = request('kid_surname');
        $kids_profiles->date_of_birth = request('date_of_birth');
        $kids_profiles->additional_information = request('additional_information');
        $kids_profiles->save();

        return redirect('/my_kid_profiles')->with('message_kid_profile_edit', 'Sėkmingai redagavote!');
    }
    public function search(){
        $kids_profiles = kids_profile::where('id', 'LIKE', '%' .$_GET['query'].'%')->
        orWhere('user_profile_id', $_GET['query'])->
        orWhere('kid_name', $_GET['query'])->
        orWhere('kid_surname', $_GET['query'])->
        orWhere('date_of_birth', $_GET['query'])->
        orWhere('additional_information', $_GET['query'])->get();

        return view('all_kids_profiles', compact('kids_profiles'));
    }
}
