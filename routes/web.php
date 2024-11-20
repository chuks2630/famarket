<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureCatIdIsset;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopAddController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\SavedadController;

Route::get('/',[UserController::class, 'home'])->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('famarket/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/myads',[AdController::class, 'showmyads'])->name('myads');
    Route::post('/myads',[AdController::class, 'destroy'])->name('myads.destroy');

    Route::get('/postad',[AdController::class, 'show'])->name('postad');
    Route::post('/postad',[AdController::class, 'form'])->name('postad.form');
   
    Route::get('/productad',[ProductController::class, 'show'])->middleware(EnsureCatIdIsset::class)->name('productad');
    Route::post('/productad',[ProductController::class, 'store'])->name('productad.store');
    Route::get('/p_addpics/{id}',[ProductController::class, 'imgView']);
    Route::post('/p_addpics/{id}',[ProductController::class, 'imageUpload'])->name('imageupload');
    Route::get('/editad/{id}',[ProductController::class, 'editShow'])->name('editad');
    Route::patch('/editad/{id}',[ProductController::class, 'editProduct'])->name('editproduct');
   
    Route::get('/equipmentad',[EquipmentController::class, 'show'])->middleware(EnsureCatIdIsset::class)->name('equipmentad');
    Route::post('/equipmentad',[EquipmentController::class, 'store'])->name('equipmentad.store');
    Route::get('/editeqad/{id}',[EquipmentController::class, 'editShow'])->name('editeq.show');
    Route::patch('/editeqad/{id}',[EquipmentController::class, 'editEquipment'])->name('editeq');
    Route::get('/e_addpics/{id}',[EquipmentController::class, 'imgView']);
    Route::post('/e_addpics/{id}',[EquipmentController::class, 'imageUpload'])->name('imageupload2');

    Route::get('/businessname',[ShopController::class, 'show'])->name('businessname');
    Route::post('/businessname',[ShopController::class, 'store'])->name('businessname.store');
    Route::patch('/businessname',[ShopController::class, 'update'])->name('businessname.update');

    Route::get('/storeaddress',[ShopAddController::class, 'show'])->name('storeadd');
    Route::get('/createstoreadd',[ShopAddController::class, 'showForm'])->name('storeaddress');
    Route::post('/createstoreadd',[ShopAddController::class, 'store'])->name('address.store');

    Route::get('/getlga',[LgaController::class, 'fetchLga'])->name('getlga');
    Route::post('/feedback',[CommentController::class, 'store'])->name('comment.store');
    Route::get('/messages', [ConversationController::class, 'show'])->name('messages.show');

Route::get('/api/conversation', [ConversationController::class, 'index'] );
Route::get('/api/conversation/{id}', [ConversationController::class, 'fetchConversation'] );
Route::post('/api/conversation', [ConversationController::class, 'store']);

Route::post('/api/messages', [MessageController::class, 'store']);
Route::patch('/api/messages', [MessageController::class, 'update']);
Route::get('/api/unread-message', [MessageController::class, 'getUnreadmessages']);

Route::get('/saved-ads', [SavedadController::class, 'show'])->name('savedAds.show');
Route::post('/saved-ads', [SavedadController::class, 'store'])->name('savedAds.store');
});


Route::get('/shop/{id}',[ShopController::class, 'shop'])->name('shop');



Route::get('/category/{id}',[CategoryController::class, 'show'])->name('category.show');
Route::post('/filter-price', [CategoryController::class, 'priceFilter']);
Route::get('/detail/{id}',[CategoryController::class, 'adDetail'])->name('addetail.show');
Route::get('/eqdetail/{id}',[CategoryController::class, 'eqDetail'])->name('eqdetail.show');

Route::get('/feedback/{id}',[CommentController::class, 'show'])->name('comment.show');
Route::get('/review/{id}',[CommentController::class, 'showEq'])->name('review.show');

Route::get('/products/search', [SearchController::class, 'ajaxSearch'])->name('search');
Route::get('/category/search', [SearchController::class, 'search'])->name('searchcat');
Route::get('/about-us', [UserController::class, 'about'])->name('aboutus');
Route::get('/terms', [UserController::class, 'termsAndCon'])->name('notice');


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
