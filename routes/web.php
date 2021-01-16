<?php

use App\Http\Controllers\Painel\CommentsController;
use App\Http\Controllers\Painel\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Painel\{
	UsersController,
	DashboardController,
	ArquivosController,
    NotesController,
    TenanantsController
	};
//use Mail;
use App\Mail\SendMailUser;

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

Route::group(['middleware' => 'auth'], function () {
	//Route::get('painel/arquivos/', [ArquivosController::class, 'index'])->name('arquivo.index');
	//Route::get('/painel/clientes/listar', [UsersController::class, 'index'])->name('user.index');
	//Route::get('/painel/cliente/{id}/editar/', [UsersController::class, 'edit'])->name('user.edit');
	//Route::delete('/painel/cliente/delete/{id}', [UsersController::class, 'destroy'])->name('user.delete');
	//Route::get('/painel/clientes/listar', [UsersController::class, 'index'])->name('user.historic'); // apenas para o admin
	//Route::get('/painel', [DashboardController::class, 'index'])->name('painel.dashboard');
	//Route::get('/painel/cliente/cadastro', [UsersController::class, 'create'])->name('user.create');
	//Route::post('/painel/cliente/store', [UsersController::class, 'store'])->name('user.store');
	Route::get('/painel/arquivos', [ArquivosController::class, 'index'])->name('arquivo.index');
	Route::get('/painel/confirmadown/{id?}', [ArquivosController::class, 'update'])->name('arquivo.update');


	Route::get('painel/arquivo/download/{id}', [ArquivosController::class, 'download'])->name('arquivo.download');
	//Route::put('cliente/update/{id}', [UsersController::class, 'update'])->name('user.update');


    // resource tenants

    Route::resource('painel/empresas', TenanantsController::class);

    //resource admin
    Route::resource('painel/upload', UploadController::class);
    Route::resource('painel/usuarios', UsersController::class);
	Route::resource('painel/notas', NotesController::class);
	Route::resource('painel/', DashboardController::class);
    Route::get('/painel/usuarios/historico/{id}', [UsersController::class, 'historic'])->name('usuarios.historic'); // apenas para o admin
    Route::post('/painel/cliente/upload', [UsersController::class, 'upload'])->name('usuarios.upload');

    //resource not

    Route::resource('painel/notas', NotesController::class);

	/* Route::get('/painel/email', function(){


	}); */
    Route::resource('painel/comentarios', CommentsController::class);
    Route::resource('painel/arquivos', ArquivosController::class);

});




/*
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {







Route::get('/painel/clientes/{id}/arquivo', [UsersController::class, 'index'])->name('user.index');




// Rotas Arquivos
Route::get('painel/cliente/arquivo/enviar', [ArquivosController::class, 'upload'])->name('arquivo.')

 */

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
