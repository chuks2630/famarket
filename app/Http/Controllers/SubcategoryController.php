<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    //

    public function show(){
        return view('admin_add_cat');
    }

    public function subcatshow(){
        $categories = Category::all();
        return view('admin_add_subcat', ['categories'=> $categories]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function subcatstore(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Subcategory created successfully!');
    }

    public function catedit($id){
        $category = Category::findOrFail($id);

        return view('admin_edit_cat',['category'=> $category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('allcat.show')->with('success', 'Category updated successfully!');
    }

    public function delete_cat($id){
        Category::destroy($id);

        return redirect()->route('allcat.show')->with('success', 'Category deleted successfully!');
    }

    public function subupdate($id){
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin_edit_subcat',['subcategory'=> $subcategory, 'categories'=> $categories]);
    }
    //create edit form view tommorow morning
    public function subcatupdate(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('allcat.show')->with('success', 'Subcategory updated successfully!');
    }

    public function delete($id){
        $subcategory = Subcategory::find($id);

        if ($subcategory) {
            $subcategory->delete();
        }
        return redirect()->route('allcat.show')->with('success', 'Subcategory deleted successfully!');
    }

}
