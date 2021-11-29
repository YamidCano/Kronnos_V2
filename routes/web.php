<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//Rutas Controladores
use App\Http\Livewire\User\UserView;
use App\Http\Livewire\User\ProfileView;
use App\Http\Livewire\User\RoleView;
use App\Http\Livewire\DashboardView;
use App\Http\Livewire\EcommerceView;

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'es'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');

Auth::routes();

//Ruta Publicas
Route::get('/', EcommerceView::class)->name('ecommerce');


//Rutas Protegidas
Route::group(['middleware' => ['auth:sanctum', 'AuthActive']], function () {

    Route::get('/home', DashboardView::class)->name('home');
    Route::get('/usuarios', UserView::class)->name('usuarios');
    Route::get('/perfil', ProfileView::class)->name('perfil');

    Route::get('/rolesPermisos', RoleView::class)->name('rolesPermisos')
    ->middleware('can_view:Role y Permisos - Tabla');


    Route::get('/clear', function() {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return "home";
    })->name('clear.cache');
});
