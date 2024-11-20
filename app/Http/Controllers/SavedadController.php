<?php

namespace App\Http\Controllers;
use App\Models\SavedAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedadController extends Controller
{
    //

    public function show(){

        $products = SavedAd::with( 'product.lga.state')->where('user_id', Auth::id())->get();
        return view('savedads', ['products'=> $products]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $exists = SavedAd::where('product_id', $validated['product_id'])
        ->where('user_id', Auth::id())
        ->first();

    if ($exists) {
        $exists->delete();
        return response()->json(['message' => 'Removed bookmarked'], 200);
    }

        SavedAd::create([
            'product_id' => $validated['product_id'],
            'user_id' => Auth::id()
        ]);

        return response()->json(['message' => 'Added to bookmarks'], 200);
    }
}
