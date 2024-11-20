<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Equipment;
use App\Models\Product_image;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
class AdController extends Controller
{
    //

    public function show(){

        $cats = Category::get();
        $states = State::get();
        // dd($cats);
        return view('Adtype_quest',['categories'=> $cats, 'states' => $states]);
    }

    public function form(){
        request()->validate([
            "category" => "required",
            "state" => "required"
        ]);
        $cat_id = request()->category;
        $state_id =  request()->state;
        session(['cat_id'=> $cat_id]);
        session(['state_id'=> $state_id]);
        if($cat_id == 6){
            return redirect()->route('equipmentad');
        }else{
            return redirect()->route('productad');
        }
    }

    public function loadLga(){
        request()->validate([
            "state" => "required"
        ]);
        $state_id= request()->state;
        $lgas= Lga::where('state_id', $state_id)->get();
        return $lgas;
    }

    public function showmyads(Request $request){
        $ads = Product::with('lga.state')->where('user_id', request()->user()->id)->get();
        $eqads = Equipment::with('lga.state')->where('user_id', request()->user()->id)->get();
        return view('user_ads', ['ads' => $ads, 'eqads' => $eqads, 'user' => $request->user()]);
    }

    public function destroy(){
        if(request()->check){
            $record = Equipment::find(request()->delid);
        }else{
            $record = Product::find(request()->delid);
        }
        
        if ($record) {
            // Delete the record
            if (Storage::exists($record->filename)) {
                Storage::delete($record->filename);
                }
            $record->delete();
            }
        return redirect()->route('myads')->with('success', 'Ad deletion successful');
}

}
