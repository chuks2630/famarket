<?php

namespace App\Http\Controllers;
use App\Models\State;
use App\Models\Shop;
use App\Models\Shop_add;
use Illuminate\Http\Request;

class ShopAddController extends Controller
{
    //

    public function show(Request $request){
        return view('storeadd', ['user' => $request->user()]);
    }

    public function showForm(Request $request){
        $states = State::get();
        return view('storeaddform', ['user' => $request->user(), 'states'=> $states]);
    }

    public function store(){
        $id = request()->user()->id;
        $shop =Shop::where('user_id', $id)->first();
        request()->validate([
            "storename" => "required|max:255",
            "lga" => "required|numeric",
            "address" => "required|max:255",
        ]);

        $shopadd = new Shop_add;
        $shopadd->storename = request()->storename;
        $shopadd->address = request()->address;
        $shopadd->location_id = request()->lga;
        $shopadd->shop_id = $shop->id;
        $shopadd->save();

        return redirect()->route('storeadd')->with('success', 'shop address added');
    }
}
