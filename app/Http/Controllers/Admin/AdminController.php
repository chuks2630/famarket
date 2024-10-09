<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Equipment;
use App\Models\Lga;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        return view('admin.dashboard'); // Create this view for the admin dashboard
    }
   
    public function pendingAds(Request $request){
        $ads = Product::where('status', 'pending')->get();
        $eqads = Equipment::where('status', 'pending')->get();

        $prods =Product::all();
        $count_p = $prods->count();
        $equips = Equipment::all();
        $count_e = $equips->count();
        $total = $count_e + $count_p;
        return view('admin_ad_approval', ['ads' => $ads, 'eqads' => $eqads, 'user' => $request->user(), 'total'=> $total]);
    }

    public function detail($id){
        $product = Product::with(['product_images', 'bulk_sizes'])->find($id);
        $user_id =$product->user_id;
        $user = User::find($user_id);
        $location = Lga::find($product->location_id);
        $state = $location->state;

        $s = Shop::where('user_id',$user_id)->first();
        $shop_id = $s->id;
        $shop = Shop::with('shop_adds')->find($shop_id);
        return view('admin_ad_detail', ['product'=> $product, 'shop'=> $shop, 'state'=> $state, 'user'=> $user]);
    }

    public function eq_detail($id){
        $equipment = Equipment::with('equipment_images')->find($id);
        $user_id =$equipment->user_id;
        $user = User::find($user_id);
        $location = Lga::find($equipment->location_id);
        $state = $location->state;

        $s = Shop::where('user_id',$user_id)->first();
        $shop_id = $s->id;
        $shop = Shop::with('shop_adds')->find($shop_id);
        session(['equipment'=>$equipment->id]);
        return view('admin_ad_detail', ['product'=> $equipment, 'shop'=> $shop, 'state'=> $state, 'user'=> $user]);
    }

    public function approval($id){
        $product = Product::findOrFail($id);
        request()->validate([
            'approval' => 'required|integer'
        ]);

        if(request()->approval == 1){
            $product->status = 'approved';
        }elseif(request()->approval == 2){
            $product->status = 'declined';
        }
        $product->save();

        return redirect()->route('approve.show')->with('success', 'Change has been applied ');

    }

    public function eq_approval($id){
        $product = Equipment::findOrFail($id);
        request()->validate([
            'approval' => 'required|integer'
        ]);

        if(request()->approval == 1){
            $product->status = 'approved';
        }elseif(request()->approval == 2){
            $product->status = 'declined';
        }
        $product->save();

        return redirect()->route('approve.show')->with('success', 'Change has been applied ');

    }
}
