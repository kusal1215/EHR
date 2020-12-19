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
    return view('loginRegister.login');
});

Route::get('/ehr/register', function () {
    return view('loginRegister.register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/ehr')->group(function () {
    Route::get('/admin', 'AdminController@index')->name('AdminManager.admin');
    Route::get('/admin/doctor', 'AdminController@doctor')->name('AdminManager.doctor');
    Route::get('/admin/addDoctor', 'AdminController@addDoctorPage')->name('AdminManager.addDoctor');

    Route::get('/doctor', 'DoctorController@index')->name('DoctorManager.doctor');

    Route::get('/patient', 'PatientController@index')->name('PatientManager.patient');
});
