<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Lga;
use App\Models\Shop;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function show($id){
        $subcategory = Subcategory::find($id); 
        // Access the parent category
        $category = $subcategory->category;
        $cat_id = $category->id; 
        $subcategories = Subcategory::where('category_id', $cat_id)->get(); 
        if($cat_id == 6){
            $products = Equipment::with('lga.state')->where(['subcat_id'=> $id, 'status'=> 'approved'])->get();
        }else{
            $products = Product::with('lga.state')->where(['subcat_id'=> $id, 'status'=> 'approved'])->get();
        }
        return view('category', ['products'=> $products, 'subcategories'=> $subcategories]);
    }

    public function adDetail($id){
        $product = Product::with(['product_images', 'bulk_sizes'])->find($id);
        $user_id =$product->user_id;
        $user = User::find($user_id);
        $location = Lga::find($product->location_id);
        $state = $location->state;

        $s = Shop::where('user_id',$user_id)->first();
        $shop_id = $s->id;
        $shop = Shop::with('shop_adds')->find($shop_id);
        return view('ad_detail', ['product'=> $product, 'shop'=> $shop, 'state'=> $state, 'user'=> $user]);
    }

    public function eqDetail($id){
        $equipment = Equipment::with('equipment_images')->find($id);
        $user_id =$equipment->user_id;
        $user = User::find($user_id);
        $location = Lga::find($equipment->location_id);
        $state = $location->state;

        $s = Shop::where('user_id',$user_id)->first();
        $shop_id = $s->id;
        $shop = Shop::with('shop_adds')->find($shop_id);
        session(['equipment'=>$equipment->id]);
        return view('ad_detail', ['product'=> $equipment, 'shop'=> $shop, 'state'=> $state, 'user'=> $user]);
    }

    public function allcat(Request $request){
        $cats = Category::with('subcategories')->get();
        
        return view('admin_category', ['cats'=> $cats, 'user' => $request->user()]);
    }

    public function priceFilter(Request $request){

        $validated = $request->validate([
            'catId' => 'required|numeric',
            'minPrice' =>'numeric',
            'maxPrice' => 'numeric',
        ]);

        $products = Product::with('lga.state')->where('subcat_id', $validated['catId'])->whereBetween('price', [$validated['minPrice'], $validated['maxPrice']])->get();

        return response()->json(['products'=>$products]);
        
    }
}
