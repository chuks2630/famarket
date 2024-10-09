<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');

        // Fetch products based on search query
        $products = Product::where('title', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->get();

        // Return a partial view (or JSON response if you prefer)
        return view('search-result', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        // Fetch products based on search query
        $products = Product::where('title', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->get();

        // Return a partial view (or JSON response if you prefer)
        return view('search-result', compact('products'));
    }
}
