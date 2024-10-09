<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function home(){
        $products = Product::with('lga.state')->take(10)->where('status','approved')->get();
        $categories = Category::with('subcategories')->get();
        return view("index",['categories'=> $categories, 'products'=> $products]);
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
}
