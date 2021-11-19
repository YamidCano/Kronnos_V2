<?php

use Illuminate\Support\Facades\Route;

//Rutas Controladores
use App\Http\Livewire\User\ListUser;
use App\Http\Livewire\DashboardView;
use App\Http\Livewire\EcommerceView;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Ruta Publicas
Route::get('/', function () {
    return view('livewire\ecommerce-view');
});

*/

Auth::routes();

//Ruta Publicas
Route::get('/', EcommerceView::class)->name('ecommerce');


//Rutas Protegidas
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/home', DashboardView::class)->name('home');
    Route::get('/usuarios', ListUser::class)->name('users');
});
