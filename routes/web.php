<?php

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


// rutas para los invitados
Route::get('/','WelcomeController@welcome')->name('welcome');
Route::get('/misionvision', function () {
    return view('misionvision');
});


Route::get('/','WelcomeController@welcome')->name('welcome');

Route::get('/quienessomos','QuienessomosController@quienessomos')->name('quienessomos');
Route::get('/muestrashistorias','QuienessomosController@muestrashistorias')->name('muestrashistorias');

Route::get('/tema/{tema}','TemaController@show')->name('tema.show'); //articulos de cada tema
Route::get('/buscador','SearchController@index'); //buscador de articulos de cada tema

//para el like de cada articulo

Route::get('temas/{id}/toggleLike', 'TemaController@toggleLike')->name('toggleLike');
//Route::get('temas/toggleLike/{id}', 'TemaController@toggleLike')->name('toggleLike');

// Rutas invitados axios
Route::get('/comprobar-alias-js/{alias?}','Auth\RegisterController@comprobarAlias');
Route::get('/buscador-predictivo','SearchController@buscadorPredictivo');


Auth::routes(['verify' => true]);
Route::delete('comentario-borrar/{id_comentario}','CommentaryController@destroyAxios');
Route::post('comentario-aniadir','CommentaryController@storeAxios');
Route::get('comentarios-mostrar/{articulo_id}','CommentaryController@comentariosMostrarAxios');



Auth::routes(['verify' => true]);
// rutas de los usuarios autenticados
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');//Ruta de cuando se logean
Route::put('/usuario-actualizar', 'UserController@update'); //Ruta de cuando se actualiza los datos del usuario

//rutas del administrador para los temas

//Route::middleware(['auth','role:administrador'])->group(function(){
Route::middleware(['auth','role:administrador'])->group(function(){

    Route::get('admin/temas','admin\TemaController@index');
    Route::delete('admin/temas/{tema}','admin\TemaController@destroy')->name('tema.delete');
    Route::get('admin/temas/{tema}/edit','admin\TemaController@edit')->name('tema.edit');
    Route::put('admin/temas/{tema}/','admin\TemaController@update')->name('tema.update');
    Route::get('admin/temas/create','admin\TemaController@create')->name('tema.create');
    Route::post('admin/temas/','admin\TemaController@store')->name('tema.store');

    //rutas del administrador para los articulos
    //Route::resource('admin/articulos','admin\ArticuloController',['except' => ['show']]); asi se pone cuando no se quiere una ruta 
    Route::resource('admin/articulos','admin\ArticuloController');
    
    
    //Route::get('admin/articulos/{id}/like', 'admin\ArticuloController@like')->name('articulos.like');
    //Route::get('admin/articulos/{id}/unlike', 'admin\ArticuloController@unlike')->name('articulos.unlike');
	//Route::get('admin/eliminar-todos-articulos','admin\ArticleController@eliminarTodosArticulos');
    //Route::get('admin/articulos-datatable','admin\ArticuloController@articulosDatatable');
    Route::get('admin/buscador/articulos','admin\SearchArticuloController@index');
    //nuevas
    Route::delete('admin/imagenes/{imagen}','admin\ArticuloImagenController@destroy')->name('imagen.delete');//Elimina la imagen con axios 
    Route::get('admin/inputs-file/{id}','admin\ArticuloController@showInputsFile');
   

   //ARTICULOS BORRADOS PAPELERA DE RECICLAJE ADMINISTRADOR   
    Route::get('admin/articulos-borrados','admin\ArticuloDeleteController@index')->name('articulos-borrados.index');
	Route::put('admin/articulos-borrados/{articulo_id}','admin\ArticuloDeleteController@restaurar')->name('articulos-borrados.restaurar');
	Route::delete('admin/articulos-borrados/{articulo_id}','admin\ArticuloDeleteController@destroy')->name('articulos-borrados.destroy');
	Route::get('admin/articulos-borrados/{articulo_id}','admin\ArticuloDeleteController@show')->name('articulos-borrados.show');
    
    //ruta de los usuarios
	Route::resource('admin/usuarios','admin\UserController')->only(['index','edit','update']);
	Route::get('admin/buscador/usuarios','admin\SearchUserController@index');
    
    //rutas de correos
	Route::get('admin/correo-masivo','admin\CorreoMasivoController@index');
	Route::post('admin/correo-masivo','admin\CorreoMasivoController@correoMasivo');

	//Route::delete('admin/eliminar-todos-articulos','admin\ArticuloDeleteAll@eliminarTodosArticulos');

	// Slider
	Route::resource('admin/slider','admin\SliderController')->only(['index','store','destroy']);
	Route::get('admin/imagenes-slider','admin\SliderController@imagenesMostrarAxios');
    Route::get('admin/imagenes-ordenar/{posicionInicial}/{posicionFinal}/{ultimo}','admin\SliderController@imagenesOrdenarAxios');
    
    //INTEGRANTES DEL GRUPO
    Route::resource('admin/grupos','admin\GrupoHubcentroController')->only(['index','store','edit','update','destroy']);
    //INSTITUCIONES
    Route::resource('admin/universidades','admin\UniversidadController')->only(['index','store','edit','update','destroy']);
    //Articulos mas Vistos
    Route::resource('admin/masvistos','admin\MasVistoController')->only(['index']);
    
});

// Rutas Moderador
//Route::middleware(['auth','verified','role:moderador'])->group(function(){
Route::middleware(['auth','verified','role:moderador'])->group(function(){
    //Route::resource('moderador/articulos','moderador\ArticuloController');
   
	Route::resource('moderador/articulos','moderador\ArticuloController', ['names' => [
		'index'  => 'moderador.articulos.index', 
	    'create' => 'moderador.articulos.create',
	    'store' => 'moderador.articulos.store',
	    'show' => 'moderador.articulos.show',
	    'edit' => 'moderador.articulos.edit',
	    'update' => 'moderador.articulos.update',
	    'destroy' => 'moderador.articulos.destroy',
    ]]);
    
    Route::get('moderador/imagenes/{imagen}','moderador\ArticuloImagenController@destroy')->name('moderador.imagen.delete');
    Route::get('moderador/buscador/articulos','moderador\SearchArticuloController@index');
});

