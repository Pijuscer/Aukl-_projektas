<?php

namespace App\Http\Controllers;
use App\Models\users_profile;
use Illuminate\Http\Request;

class UsersProfileController extends Controller
{
    public function index(){
        $users_profiles = users_profile::all();
        return view('all_users_profiles', compact('users_profiles'));
        
    }
    public function index2(){
        $users_profiles = users_profile::all();
        return view('my_users_profiles', compact('users_profiles'));
        
    }
    public function viewForm(){
        //TODO: fentch countries from database
        $users_profiles  = users_profile::all();
        return view('add_user_profile', ['add_user_profile' => $users_profiles ]);

    }
    public function store(Request $request){
        //dd($request);
        //Validacija
        $validated = $request -> validate([
            'user_id',
            'name' => 'required|max:225',
            'surname' => 'required|max:225',
            'telephone_number' => 'required|max:225',
            'address' => 'required|max:225',

        ]);

        users_profile::create([
            'user_id'=> auth()->user()->id,
            'name' => request('name'),
            'surname' => request('surname'),
            'telephone_number' => request('telephone_number'),
            'address' => request('address'),
        ]);

        return redirect('/add_user_profile');
    }
    public function editForm($id){
        $users_profiles = users_profile::where('id', $id)->firstOrFail();

        return view('edit_users_profiles',compact("users_profiles"));
    }
    public function edit(Request $request, $id){
         //Validacija

         $validated = $request -> validate([
            'name' => 'required|max:225',
            'surname' => 'required|max:225',
            'telephone_number' => 'required|max:225',
            'address' => 'required|max:225',
    
         ]);

        $users_profiles = users_profile::where('id', $id)->firstOrFail();

        $users_profiles->name = request('name');
        $users_profiles->surname = request('surname');
        $users_profiles->telephone_number = request('telephone_number');
        $users_profiles->address = request('address');
        $users_profiles->save();

        return redirect('/my_user_profile');
    }
}
