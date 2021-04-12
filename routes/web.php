<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Auth\LoginController;

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
/*
Route::get('/', function () {
    return view('contenido');
});
*/

//Para los usuarios invitados
Route::group(['middleware'=>['guest']],function(){
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

//Para los usuarios autenticados
Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/main', function () {
        return view('contenido');
    })->name('main');
    
    Route::group(['middleware'=>['Vendedor']],function(){
        Route::get('/categoria', [CategoriaController::class, 'index']);
        Route::post('/categoria/registrar', [CategoriaController::class, 'store']);
        Route::put('/categoria/actualizar', [CategoriaController::class, 'update']);
        Route::put('/categoria/desactivar', [CategoriaController::class, 'desactivar']);
        Route::put('/categoria/activar', [CategoriaController::class, 'activar']);
        Route::get('/categoria/selectCategoria', [CategoriaController::class, 'selectCategoria']);    
    
        Route::get('/articulo', [ArticuloController::class, 'index']);
        Route::post('/articulo/registrar', [ArticuloController::class, 'store']);
        Route::put('/articulo/actualizar', [ArticuloController::class, 'update']);
        Route::put('/articulo/desactivar', [ArticuloController::class, 'desactivar']);
        Route::put('/articulo/activar', [ArticuloController::class, 'activar']);
        
    });

    Route::group(['middleware'=>['Bodeguero']],function(){
        Route::get('/articulo', [ArticuloController::class, 'index']);
        Route::post('/articulo/registrar', [ArticuloController::class, 'store']);
        Route::put('/articulo/actualizar', [ArticuloController::class, 'update']);
        Route::put('/articulo/desactivar', [ArticuloController::class, 'desactivar']);
        Route::put('/articulo/activar', [ArticuloController::class, 'activar']);
    });
   
    Route::group(['middleware'=>['Administrador']],function(){
        Route::get('/categoria', [CategoriaController::class, 'index']);
        Route::post('/categoria/registrar', [CategoriaController::class, 'store']);
        Route::put('/categoria/actualizar', [CategoriaController::class, 'update']);
        Route::put('/categoria/desactivar', [CategoriaController::class, 'desactivar']);
        Route::put('/categoria/activar', [CategoriaController::class, 'activar']);
        Route::get('/categoria/selectCategoria', [CategoriaController::class, 'selectCategoria']);    
    
        Route::get('/articulo', [ArticuloController::class, 'index']);
        Route::post('/articulo/registrar', [ArticuloController::class, 'store']);
        Route::put('/articulo/actualizar', [ArticuloController::class, 'update']);
        Route::put('/articulo/desactivar', [ArticuloController::class, 'desactivar']);
        Route::put('/articulo/activar', [ArticuloController::class, 'activar']);

        Route::get('/rol', [RolController::class, 'index']);
    });

});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');