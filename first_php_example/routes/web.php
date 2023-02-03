<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\empController;

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

Route::get('Docs', function () {
    return view('Docs');
})->name('Docs');


Route::get('contact', function () {
    return view('contact');
});

Route::get('About',function(){
    return view('About');

})->name('Aboutpage')->middleware('checkSal'); 




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(PostController::class)->group(function(){
    Route::get('/posts','index');
    Route::get('/posts/{id}','show');
});



Route::resource('emp', EmpController::class);

require __DIR__.'/auth.php';


Route::get('anonymous', function () {
    return view('components.first-anonymous-component');
});
