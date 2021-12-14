<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//Rutas Controladores
use App\Http\Livewire\User\UserView;
use App\Http\Livewire\User\ProfileView;
use App\Http\Livewire\User\RoleView;
use App\Http\Livewire\DashboardView;
use App\Http\Livewire\EcommerceView;
use App\Http\Livewire\ProductsView;
use App\Http\Livewire\ProductCategoryView;
use App\Http\Livewire\ProvidersView;

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
    Route::get('/usuarios', UserView::class)->name('usuarios')
    ->middleware('can_view:Usuario - Tabla');
    Route::get('/perfil', ProfileView::class)->name('perfil');

    Route::get('/rolesPermisos', RoleView::class)->name('rolesPermisos')
    ->middleware('can_view:Role y Permisos - Tabla');

    Route::get('/ProductoCategoria', ProductCategoryView::class)->name('ProductoCategoria')
    ->middleware('can_view:Categoria-Producto - Tabla');

    Route::get('/proveedor', ProvidersView::class)->name('proveedor')
    ->middleware('can_view:Proveedor - Tabla');

    Route::get('/productos', ProductsView::class)->name('productos')
    ->middleware('can_view:Producto - Tabla');

    Route::get('/clear-cache', function() {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('route:cache');
        Artisan::call('optimize');
        return "Cache is cleared";
    });
});
