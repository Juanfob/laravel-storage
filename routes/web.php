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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload', 'HomeController@upload')->name('upload');

Route::get('/archivo/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = '/storage/public/'.$archivo;

    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists($archivo))
    {
        return response()->download($url);
    }else{
        //si no se encuentra lanzamos un error 404.
        //abort(404);
        echo $url;
    }
});


Route::get('media', function (){
    $fichero = 'image1.jpg';
   return view('media')->withFile($fichero);
});

Route::post('media', function (){
   //request()->validate(['file' => 'image']);
   return 'guardaro ' . request()->file->storeAs('uploads', request()->file->getClientOriginalName());
});

Route::get('/uploads/{file}', function ($file){
    //$ruta = Storage::url('uploads/'.$file);
    //return view('media')->withTitle($ruta);
    //return Storage::url('uploads/'.$file);
    return Storage::response('uploads/'.$file);
});
