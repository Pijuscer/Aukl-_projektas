<?php

namespace App\Http\Controllers;

use App\Models\prices;
use Illuminate\Http\Request;

class PricesController extends Controller
{
    public function index(){
        $prices = prices::all();
        return view('add_prices', compact('prices'));
    }
    public function viewForm(){
        //TODO: fentch countries from database
        $prices = prices::all();
        return view('prices', ['prices' => $prices]);
    }
    public function store(Request $request){
        //dd($request);
        //Validacija
        $validated = $request -> validate([
            'type' => 'required|max:225',
            'indicated_price' => 'required|max:225|regex:/^[0-9]+$/',

        ]);

        prices::create([
            'type' => request('type'),
            'indicated_price' => request('indicated_price'),
        ]);

        return redirect('/prices');
    }
    public function editForm($id){
        $prices = prices::where('id', $id)->firstOrFail();

        return view('edit_prices',compact("prices"));
    }
    public function edit(Request $request, $id){
         //Validacija

         $validated = $request -> validate([
            'type' => 'required|max:225',
            'indicated_price' => 'required|max:225|regex:/^[0-9]+$/',
    
         ]);

        $prices = prices::where('id', $id)->firstOrFail();

        $prices->type = request('type');
        $prices->indicated_price = request('indicated_price');
        $prices->save();

        return redirect('/prices');
    }
    public function removeForm($id){
        $prices = prices::where('id', $id)->firstOrFail(); 

        return view('remove_prices]',compact("prices"));
    }
    public function remove($id){
        $prices = prices::where('id', $id)->firstOrFail();
        $prices->delete();

        return redirect('/prices');
    }
}
