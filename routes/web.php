<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


// welcome
Route::get('/', function () {
    return view('welcome');
});

// login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// category
Route::resource('category', CategoryController::class)
    ->middleware(['auth','can:view,\App\Model\Category']);


Route::middleware('auth')->group(function (){

    // post
    Route::resource('post', PostController::class);

    // approve
    Route::get('post/{post}/approve',[PostController::class,'approve'])->name('post.approve');

    // published post
    Route::get('post/{post}/published',[PostController::class,'published'])->name('post.published');

    // list users
    Route::get('publisher',[\App\Http\Controllers\PublisherController::class,'index'])
        ->name('publisher.index');

    // list post of publisher
    Route::get('publisher/{user}',[\App\Http\Controllers\PublisherController::class, 'show'])
        ->name('publisher.show');

    // block publisher
    Route::post('publisher/{user}/block',[\App\Http\Controllers\PublisherController::class, 'block'])
        ->name('publisher.block');

    // unblock publisher
    Route::post('publisher/{user}/unblock',[\App\Http\Controllers\PublisherController::class, 'unblock'])
        ->name('publisher.unblock');
});
