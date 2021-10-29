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

use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


Route::get('/test', function () {
    // Ejecute para crear un role admin
    // $role = Role::create(['name' => 'admin']);


    // ejecute para crear un usuario con role admin
    // $user = User::create([

    //     'name' => 'admin',
    //     'identification_card' => '12345345',
    //     'email' => 'admin@example.com',
    //     'cell_phone_number' => '5345654345',
    //     'password' => Hash::make('12345678'),
    // ]);
    // $user->assignRole('admin');

    // entrar con el id del primer usuario
    \Auth::login(User::find(1));
    return redirect('/');
});


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'moviTodo', 'middleware' => ['role:admin']], function () {
    Route::get('/', 'MoviTodoController@index')->name('moviTodo');
    Route::post('/store', 'MoviTodoController@store');
    Route::post('/update/{user}', 'MoviTodoController@update');
    Route::post('/delete/{id}', 'MoviTodoController@destroy');
});


Route::group(['prefix' => 'trip'], function () {
    Route::get('/', 'TripController@index')->name('trip');
    Route::post('/store', 'TripController@store');
    Route::post('/update/{trip}', 'TripController@update');
    Route::post('/delete/{id}', 'TripController@destroy');
});

Route::group(['prefix' => 'employeeLiquidation'], function () {
    Route::get('/', 'employeeLiquidationController@employeeLiquidation')->name('employeeLiquidation');
    Route::get('/bringUserByDocumentNumber/{identification_card}', 'employeeLiquidationController@bringUserByDocumentNumber');
});

Route::group(['prefix' => 'vehicle', 'middleware' => ['role:admin']], function () {
    Route::get('/', 'VehicleController@index')->name('Vehicle');
    Route::post('/store', 'VehicleController@store');
    Route::post('/update/{vehicle}', 'VehicleController@update');
    Route::post('/delete/{id}', 'VehicleController@destroy');
});

Route::group(['prefix' => 'PersonalInformation', 'middleware' => ['role:admin|driver']], function () {
    Route::get('/', 'PersonalInformationController@index')->name('moviTodo');
    Route::post('/store', 'PersonalInformationController@store');
    Route::post('/update/{user}', 'PersonalInformationController@update');
    Route::delete('/delete/id}', 'PersonalInformationController@destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
