<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;
use App\Models\Lga;
use App\Models\Equipment;
use App\Models\Equipment_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EquipmentController extends Controller
{
    //
    public function show(Request $request){
        $cat_id = session('cat_id');
        $state_id = session('state_id');
        $subcats = Subcategory::where('category_id', $cat_id)->get();
        $lgas= Lga::where('state_id', $state_id)->get();
        $request->session()->forget('cat_id','state_id');
        return view('equipment_ad',['subcats'=> $subcats, 'lgas'=> $lgas]);
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
            "condition"=>  "required|numeric",
            "biztype"=>   "required|numeric" 
        ]);
        // $price = number_format(request()->price, 2, '.');

        $equipment = new Equipment;
        $equipment->title = request()->title;
        $equipment->description = request()->description;
        $equipment->subcat_id = request()->category;
        $equipment->location_id = request()->lga;
        $equipment->price = request()->price;
        $equipment->quantity = request()->quantity;
        $equipment->condition = request()->condition;
        $equipment->businesstype = request()->biztype;
        if(request()->file('image')->isValid()){
            $filepath = request()->file('image')->store('uploads', 'public');
            $equipment->filename = $filepath;
        }
        $equipment->user_id =  request()->user()->id;

        $equipment->save();


        return redirect()->route('postad')->with("success", "Ad created successfully");

    }

    public function editShow($id){
        $product = Equipment::findOrFail($id);
        if(request()->user()->id != $product->user_id){
         return redirect()->route("myads");
     }
         $subcats = Subcategory::get();
         return view('Edit_equipment',['product'=> $product,  'cats'=> $subcats]);
     }
 
     public function editEquipment($id){
         $product = Equipment::findOrFail($id);
        if(request()->user()->id != $product->user_id){
         return redirect()->route("myads");
     }
 
         request()->validate([
            "title" => "required|max:255",
             "price" => "required|numeric",
             "description" => "required|max:1000",
             "quantity" => "required|numeric",
             "condition" => "required|numeric",
             "businesstype" => "required|numeric",
             "category" => "required",
             "image" => "mimes:png,jpg,jpeg|max:2048"
         ]);
         $product->title = request()->title;
         $product->description = request()->description;
         $product->subcat_id = request()->category;
         $product->price = request()->price;
         $product->quantity = request()->quantity;
         $product->condition = request()->condition;
         $product->businesstype = request()->businesstype;
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

     public function imgView($id){
        
        return view('Add_pics2',['id'=> $id]);
    }
    public function imageUpload($id){
        request()->validate([
            "imageup" => "required|file|mimes:png,jpg,jpeg|max:2048"]);

        if(request()->file('imageup')->isValid()){
            $filepath = request()->file('imageup')->store('uploads', 'public');
            $product_image = new Equipment_image;
            $product_image->filename = $filepath;
            $product_image->product_id = request()->id;
            $product_image->save();
        }

        return back()->with('image' , "/storage/$filepath")->with('success', "Picture has been uploaded");
    }
}
