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
Route::group(['middleware' => ['auth']], function () {
    Route::get('view_user', 'Controller@viewUser');
    Route::get('/index', 'userController@indexPage')->name('index');
    Route::get('/add', 'crudController@addStudents')->name('add');
    Route::post('/store', 'crudController@store')->name('store');
    Route::get('/home', 'crudController@tableLists')->name('home');
    Route::delete('/delete/{id_number}', 'crudController@deleteRow')->name('delete');
    Route::get('/edit/{id_number}', 'crudController@editRow')->name('edit');
    Route::post('/update/{old_id_number}/{old_student_type}', 'crudController@update')->name('update');
    Route::get('/search', 'crudController@search')->name('search');
});
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
