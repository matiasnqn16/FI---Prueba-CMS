<?php

use App\Http\Controllers\{
    ProfileController,
    ClienteController,
    CompraController,
    DespachoController,
    UserController,
    CategoriaController,
    ProductoController,

};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::resource('users', UserController::class);

    Route::resource('clientes' , ClienteController::class);
    
    Route::resource('categorias' , CategoriaController::class);
    
    Route::resource('productos' , ProductoController::class);
    

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas');
    Route::get('/ventas-dia', [VentaController::class, 'index'])->name('ventas-dia');

    Route::get('/compras', [CompraController::class, 'index'])->name('compras');
    Route::get('/despachos', [DespachoController::class, 'index'])->name('despachos');
    Route::get('/repartos', [VentaController::class, 'index'])->name('repartos');
    Route::get('/proveedores', [VentaController::class, 'index'])->name('proveedores');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
