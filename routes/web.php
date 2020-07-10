<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('/pertanyaan', 'PertanyaanController');
Route::resource('/user', 'UserController');
Route::post('/komentar_pertanyaan/{id}', 'KomentarController@pertanyaan')->name('komentar.pertanyaan.simpan');
Route::get('/komentar_jawaban_edit/{id}', 'KomentarController@jawabanedit')->name('komentar.jawaban.edit');
Route::post('/komentar_jawaban/{id}', 'KomentarController@jawaban')->name('komentar.jawaban.simpan');
Route::post('/jawaban_verif/{id}', 'JawabanController@verifikasi')->name('jawaban.verif');
Route::post('/jawaban/{id}', 'JawabanController@store')->name('jawaban.simpan');

Route::get('/home', 'HomeController@index')->name('home');
