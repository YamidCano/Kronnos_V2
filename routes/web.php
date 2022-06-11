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
use App\Http\Livewire\InventoriesView;
use App\Http\Livewire\BrandsView;
use App\Http\Livewire\ShoppingView;
use App\Http\Livewire\ShoppingCreateView;
use App\Http\Livewire\TaxesView;

//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'es'])) {
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

    Route::get('/proveedores', ProvidersView::class)->name('proveedores')
        ->middleware('can_view:Proveedor - Tabla');

    Route::get('/productos', ProductsView::class)->name('productos')
        ->middleware('can_view:Producto - Tabla');

    Route::get('/ajusteInventario', InventoriesView::class)->name('ajusteInventario')
        ->middleware('can_view:Producto - Tabla');

    Route::get('/marcas', BrandsView::class)->name('marcas')
        ->middleware('can_view:Brands - Tabla');

    Route::get('/compras', ShoppingView::class)->name('compras')
        ->middleware('can_view:Shopping - Tabla');

    Route::get('/comprasCrear', ShoppingCreateView::class)->name('comprasCrear')
        ->middleware('can_view:Shopping - Tabla');

    Route::get('/impuestos', TaxesView::class)->name('impuestos')
        ->middleware('can_view:Taxes - Tabla');

    });
