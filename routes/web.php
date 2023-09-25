<?php

use App\Models\Option;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController as ControllersPropertyController;
use App\Models\Property;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [ControllersPropertyController::class, 'index'])->name('property.index');
// route en get avec condition parametre 
Route::get('/biens/{slug}-{property}', [ControllersPropertyController::class, 'show'])->name('property.show')->where([
    'property' => $idRegex,
    'slug' => $slugRegex
]);
Route::post('/biens/{property}/contact',[ControllersPropertyController::class, 'contact'])->name('property.contact')->where([
    'property' => $idRegex
]);
// AUTH
Route::get('/login',[AuthController::class, 'login'])
    // deconnecter
    ->middleware('guest')
    ->name('login');
Route::post('/login',[AuthController::class, 'doLogin']);
Route::delete('/logout',[AuthController::class, 'logout'])
    // middleware admin / faut être connecté 
    ->middleware('auth')
    ->name('logout');


// route prefixé avec le nom admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    // route resource  prendre en compte tout les action  d'un CRUD dans une ligne avec le controller
    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);

});
