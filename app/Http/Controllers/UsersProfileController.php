<?php

namespace App\Http\Controllers;
use App\Models\users_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(users_profile::where("user_id", Auth::user()->id)->first()){
             return redirect()->back();
        }
        
        return view('add_user_profile');

    }
    public function store(Request $request){
        if(users_profile::where("user_id", auth()->user()->id)->first()){
            return redirect()->back();
        }
        $validated = $request -> validate([
            'user_id',
            'name' => 'required|max:225|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/',
            'surname' => 'required|max:225|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/',
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

        return redirect('/my_user_profile')->with('message_user_profile_add', 'Sėkmingai pridėjote!');
    }
    public function editForm($id){
        $users_profiles = users_profile::where('id', $id)->firstOrFail();

        return view('edit_users_profiles',compact("users_profiles"));
    }
    public function edit(Request $request, $id){

         $validated = $request -> validate([
            'name' => 'required|max:225|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/',
            'surname' => 'required|max:225|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/',
            'telephone_number' => 'required|max:225',
            'address' => 'required|max:225',
    
         ]);

        $users_profiles = users_profile::where('id', $id)->firstOrFail();

        $users_profiles->name = request('name');
        $users_profiles->surname = request('surname');
        $users_profiles->telephone_number = request('telephone_number');
        $users_profiles->address = request('address');
        $users_profiles->save();

        return redirect('/my_user_profile')->with('message_user_profile_edit', 'Sėkmingai redagavote!');
    }
    public function search(){
        $users_profiles = users_profile::where('id', 'LIKE', '%' .$_GET['query'].'%')->
        orWhere('user_id', $_GET['query'])->
        orWhere('name', $_GET['query'])->
        orWhere('surname', $_GET['query'])->
        orWhere('telephone_number', $_GET['query'])->
        orWhere('address', $_GET['query'])->get();

        return view('all_users_profiles', compact('users_profiles'));
    }

}
