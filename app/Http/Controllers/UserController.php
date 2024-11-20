<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    //
    public function home(){
        $products = Cache::remember('product.all', now()->addMinutes(60), function(){
            return Product::with('lga.state')->take(10)->where('status','approved')->get();
        });

        $categories = Cache::remember('category.all', now()->addMinutes(60), function(){
            return Category::with('subcategories')->get();
        });
        return view("index", compact('categories', 'products'));
    }

    public function signup(){
        return view("register");
    }
    public function login(){
        return view("login");
    }

    public function alluser(){
        $users = User::get();
        $count = $users->count();
        return view('admin_users', ['users'=> $users, 'count'=> $count]);
    }

    public function update(){
        request()->validate([
            'email'=> 'required|email'
        ]);

        $user = User::where('email', request()->email)->first();
        if($user->status == 'active'){
            $user->status ='inactive';
        }else{
            $user->status = 'active';
        }

        $user->save();

        return redirect()->route('alluser')->with('success', 'User status changed');
    }

    public function about(){
        return view('aboutus');
    }

    public function termsAndCon(){

        return view('terms_and_condition');
    }
}
