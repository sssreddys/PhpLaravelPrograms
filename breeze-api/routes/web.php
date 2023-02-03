<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    //return view('dashboard');
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(AdminController::class)->group(function(){
    Route::get('/logout', 'destroy')->name('logout');
    Route::get('/showProfile', 'showProfileData')->name('showProfile');
    Route::get('/editProfile', 'editProfileData')->name('editProfile');
    Route::post('/updateProfile', 'updateProfileData')->name('updateProfile');
    //Route::put('updateProfile/{id}','AdminController@updateProfileData')->name('updateProfile');
    //Route::get('image-upload-preview', [ImageUploadController::class, 'index']);
    //Route::post('upload-image', [ImageUploadController::class, 'store']);

});


Route::controller(ProductController::class)->group(function () {

    Route::get('showproducts', 'index')->middleware("auth")->name('SHOWPRODUCTS');
    Route::get('addproducts', 'create')->middleware("auth")->name('ADDPRODUCTS');
    Route::post('storeproducts', 'store')->middleware("auth")->name('STOREPRODUCTS');

});

Route::controller(CartController::class)->group(function () {
Route::get('mycart', 'index')->middleware("auth")->name('MYCART');

});

Route::post('/addcart/{id}', [ProductController::class,'addtocart']);

require __DIR__.'/auth.php';
