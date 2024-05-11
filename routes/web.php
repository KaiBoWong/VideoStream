<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/','App\Http\Controllers\MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'App\Http\Controllers\MoviesController@show')->name('movies.show');

Route::get('/tv','App\Http\Controllers\TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'App\Http\Controllers\TvController@show')->name('tv.show');

Route::get('/trending','App\Http\Controllers\MoviesTrenController@index')->name('trend.index');
Route::get('/trending/{id}', 'App\Http\Controllers\MoviesTrenController@show')->name('trend.show');

Route::get('/search/{search}', 'App\Http\Controllers\SearchController@show')->name('search.show');








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change.password');
Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update.password');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'showProfile'])->name('profile');
Route::post('/store-watch-history', [App\Http\Controllers\WatchHistoryController::class, 'storeWatchHistory'])->name('store.watch.history');
Route::get('/watch_history', [App\Http\Controllers\WatchHistoryController::class, 'showWatchHistory'])->name('watch_history');
Route::delete('/watch_history/{id}', [App\Http\Controllers\WatchHistoryController::class, 'deleteHistory'])->name('delete_history');
Route::get('/admin_view', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.users.index');
Route::delete('/admin_delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.delete');
Route::delete('/admin_delete/{user}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin_create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.register');
Route::post('/admin_create', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.create');
Route::get('/admin_delete', [App\Http\Controllers\AdminController::class, 'search'])->name('admin.search');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');




