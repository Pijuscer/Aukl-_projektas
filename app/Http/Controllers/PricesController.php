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
}
