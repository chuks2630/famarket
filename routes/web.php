<?php
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopAddController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\EnsureCatIdIsset;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class, 'home'])->name('homepage');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('famarket/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('famarket/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/famarket/myads',[AdController::class, 'showmyads'])->name('myads');
    Route::post('/famarket/myads',[AdController::class, 'destroy'])->name('myads.destroy');

    Route::get('/famarket/postad',[AdController::class, 'show'])->name('postad');
    Route::post('/famarket/postad',[AdController::class, 'form'])->name('postad.form');
   
    Route::get('/famarket/productad',[ProductController::class, 'show'])->middleware(EnsureCatIdIsset::class)->name('productad');
    Route::post('/famarket/productad',[ProductController::class, 'store'])->name('productad.store');
    Route::get('/famarket/p_addpics/{id}',[ProductController::class, 'imgView']);
    Route::post('/famarket/p_addpics/{id}',[ProductController::class, 'imageUpload'])->name('imageupload');
    Route::get('/famarket/editad/{id}',[ProductController::class, 'editShow'])->name('editad');
    Route::patch('/famarket/editad/{id}',[ProductController::class, 'editProduct'])->name('editproduct');
   
    Route::get('/famarket/equipmentad',[EquipmentController::class, 'show'])->middleware(EnsureCatIdIsset::class)->name('equipmentad');
    Route::post('/famarket/equipmentad',[EquipmentController::class, 'store'])->name('equipmentad.store');
    Route::get('/famarket/editeqad/{id}',[EquipmentController::class, 'editShow'])->name('editeq.show');
    Route::patch('/famarket/editeqad/{id}',[EquipmentController::class, 'editEquipment'])->name('editeq');
    Route::get('/famarket/e_addpics/{id}',[EquipmentController::class, 'imgView']);
    Route::post('/famarket/e_addpics/{id}',[EquipmentController::class, 'imageUpload'])->name('imageupload2');

    Route::get('/famarket/businessname',[ShopController::class, 'show'])->name('businessname');
    Route::post('/famarket/businessname',[ShopController::class, 'store'])->name('businessname.store');
    Route::patch('/famarket/businessname',[ShopController::class, 'update'])->name('businessname.update');

    Route::get('/famarket/storeaddress',[ShopAddController::class, 'show'])->name('storeadd');
    Route::get('/famarket/createstoreadd',[ShopAddController::class, 'showForm'])->name('storeaddress');
    Route::post('/famarket/createstoreadd',[ShopAddController::class, 'store'])->name('address.store');

    Route::get('/getlga',[LgaController::class, 'fetchLga'])->name('getlga');
    Route::post('/famarket/feedback',[CommentController::class, 'store'])->name('comment.store');
});


Route::get('/famarket/shop/{id}',[ShopController::class, 'shop'])->name('shop');



Route::get('/famarket/category/{id}',[CategoryController::class, 'show'])->name('category.show');
Route::get('/famarket/detail/{id}',[CategoryController::class, 'adDetail'])->name('addetail.show');
Route::get('/famarket/eqdetail/{id}',[CategoryController::class, 'eqDetail'])->name('eqdetail.show');

Route::get('/famarket/feedback/{id}',[CommentController::class, 'show'])->name('comment.show');
Route::get('/famarket/review/{id}',[CommentController::class, 'showEq'])->name('review.show');

Route::get('/products/search', [SearchController::class, 'ajaxSearch'])->name('search');
Route::get('/category/search', [SearchController::class, 'search'])->name('searchcat');

//admin routes start here
// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware('auth:admin')->name('admin.dashboard');
    Route::get('adapproval',[AdminController::class, 'pendingAds'])->middleware('auth:admin')->name('approve.show');
    Route::get('addetail/{id}',[AdminController::class, 'detail'])->middleware('auth:admin')->name('approve.detail');
    Route::patch('addetail/{id}',[AdminController::class, 'approval'])->middleware('auth:admin')->name('ad.alter');

    Route::get('equipmentdetail/{id}',[AdminController::class, 'eq_detail'])->middleware('auth:admin')->name('eq.detail');
    Route::patch('equipmentdetail/{id}',[AdminController::class, 'eq_approval'])->middleware('auth:admin')->name('eq.alter');
    Route::get('users',[UserController::class, 'alluser'])->middleware('auth:admin')->name('alluser');
    Route::patch('users',[UserController::class, 'update'])->middleware('auth:admin')->name('update.user');
    Route::get('category',[CategoryController::class, 'allcat'])->middleware('auth:admin')->name('allcat.show');

    Route::get('addcategory',[SubcategoryController::class, 'show'])->middleware('auth:admin')->name('addcat.show');
    Route::post('addcategory',[SubcategoryController::class, 'store'])->middleware('auth:admin')->name('addcat.store');
    Route::get('editcategory/{id}',[SubcategoryController::class, 'catedit'])->middleware('auth:admin')->name('cat.edit');
    Route::put('editcategory/{id}',[SubcategoryController::class, 'update'])->middleware('auth:admin')->name('cat.update');
    Route::delete('editcategory/{id}',[SubcategoryController::class, 'delete_cat'])->middleware('auth:admin')->name('cat.delete');

    Route::get('addsubcategory',[SubcategoryController::class, 'subcatshow'])->middleware('auth:admin')->name('addsubcat.show');
    Route::post('addsubcategory',[SubcategoryController::class, 'subcatstore'])->middleware('auth:admin')->name('subcategories.store');
    Route::get('editsubcategory/{id}',[SubcategoryController::class, 'subupdate'])->middleware('auth:admin')->name('subupdate');
    Route::put('editsubcategory/{id}',[SubcategoryController::class, 'subcatupdate'])->middleware('auth:admin')->name('subcategories.update');
    Route::delete('editsubcategory/{id}',[SubcategoryController::class, 'delete'])->middleware('auth:admin')->name('subcategories.delete');
});
//admin routes end here

require __DIR__.'/auth.php';
