<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;
use App\Models\Lga;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Bulk_size;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function show(Request $request){
        $cat_id = session('cat_id');
        $state_id = session('state_id');
        $subcats = Subcategory::where('category_id', $cat_id)->get();
        $lgas= Lga::where('state_id', $state_id)->get();
        $request->session()->forget('cat_id','state_id');
        return view('create_ad',['subcats'=> $subcats, 'lgas'=> $lgas]);
    }

    public function store(){
       
        request()->validate([
            "title" => "required|max:255",
            "price" => "required|numeric",
            "description" => "required|max:1000",
            "quantity" => "required|numeric",
            "lga" => "required",
            "category" => "required",
            "image" => "required|file|mimes:png,jpg,jpeg|max:2048",
            "bulkprice"=> isset(request()->bulkquant) ? "required|numeric": '',
            "bulkquant"=>  isset(request()->bulkprice) ? "required|numeric": ''
            
        ]);
        // $price = number_format(request()->price, 2, '.');

        $product = new Product;
        $product->title = request()->title;
        $product->description = request()->description;
        $product->subcat_id = request()->category;
        $product->location_id = request()->lga;
        $product->price = request()->price;
        $product->quantity = request()->quantity;
        if(request()->file('image')->isValid()){
            $filepath = request()->file('image')->store('uploads', 'public');
            $product->filename = $filepath;
        }
        $product->user_id =  request()->user()->id;

        $product->save();
        $product_id = $product->id;

        

        if(!empty(request()->bulkquant) || !empty(request()->bulkprice)){
            // $bulkprice = number_format(request()->bulkprice, 2, '.');
            $bulksize = new Bulk_size;
            $bulksize->price = request()->bulkprice;
            $bulksize->size = request()->bulkquant;
            $bulksize->product_id =$product_id;
            $bulksize->save();
        }
        
        return redirect()->route('postad')->with("success", "Ad created successfully");

    }

    public function imgView($id){
        
        return view('Add_pics',['id'=> $id]);
    }
    public function imageUpload($id){
        request()->validate([
            "imageup" => "required|file|mimes:png,jpg,jpeg|max:2048"]);

        if(request()->file('imageup')->isValid()){
            $filepath = request()->file('imageup')->store('uploads', 'public');
            $product_image = new Product_image;
            $product_image->filename = $filepath;
            $product_image->product_id = request()->id;
            $product_image->save();
        }

        return back()->with('image' , "/storage/$filepath")->with('success', "Picture has been uploaded");
    }

    public function editShow($id){
       $product = Product::findOrFail($id);
       if(request()->user()->id != $product->user_id){
        return redirect()->route("myads");
    }
        $subcats = Subcategory::get();
        return view('Edit_product',['product'=> $product,  'cats'=> $subcats]);
    }

    public function editProduct($id){
        $product = Product::findOrFail($id);
       if(request()->user()->id != $product->user_id){
        return redirect()->route("myads");
    }

        request()->validate([
           "title" => "required|max:255",
            "price" => "required|numeric",
            "description" => "required|max:1000",
            "quantity" => "required|numeric",
            "category" => "required",
            "image" => "mimes:png,jpg,jpeg|max:2048"
        ]);
        $product->title = request()->title;
        $product->description = request()->description;
        $product->subcat_id = request()->category;
        $product->price = request()->price;
        $product->quantity = request()->quantity;
        $product->status = 'pending';
        if(request()->file('image') != ""){
             if (Storage::exists($product->filename)) {
            Storage::delete($product->filename);
            }
            $filepath = request()->file('image')->store('uploads', 'public');
            $product->filename = $filepath;
        }

        $updated = $product->save();

        return redirect()->route("myads")->with("success", "Post updated successfully");
    }
}
