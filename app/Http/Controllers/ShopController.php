<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use App\Models\Equipment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function show(Request $request){
        return view('shopname',['user' => $request->user()]);
    }

    public function store(Request $request){
        request()->validate([
            "shopname" => "required|max:255",
            "description" => "required|max:2000",
            ]);
            $shop = new Shop;
            $shop->shopname = request()->shopname;
            $shop->description = request()->description;
            $shop->user_id = request()->user()->id;

        $shop->save();
        return redirect()->route('businessname')->with('success', 'Updated successfully');
    }

    public function update(Request $request){
        $id = request()->id;
        $shop =Shop::findOrfail($id);
        request()->validate([
            "shopname" => "required|max:255",
            "description" => "required|max:2000",
            ]);
            $shop->fill([
                "shopname" => $request->shopname,
                "description" => $request->description,
            ]);
            $shop->save();

            return redirect()->route('businessname')->with('success', 'Updated successfully');
    }

    public function shop($id){
        $user = User::find($id);
        $products = Product::with('lga.state')->where(['user_id'=> $id, 'status'=> 'approved'])->get();
        $equipments = Equipment::with('lga.state')->where(['user_id'=> $id, 'status'=> 'approved'])->get();
        $shop = Shop::where('user_id', $id)->first();

        return view('user_shop', ['products'=> $products, 'equipments'=> $equipments, 'shop'=> $shop, 'user'=> $user]);
    }
}
