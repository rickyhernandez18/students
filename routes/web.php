<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    

    Route::get('/dashboard',[StudentController::class,'index'])->middleware('auth','verified')->name('dashboard');

    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/add','create')->name('add.form');
        Route::post('/add','store')->name('add');
        Route::get('/edit/{id}','edit')->name('edit.form');
        Route::put('/edit/{id}','update')->name('edit');
        Route::delete('delete/{id}','destroy')->name('delete');
        
    });

    Route::resource('/photo', PhotoController::class);

    Route::resource('post',PostController::class);
});


Route::middleware('auth')->prefix('students')->name('students.')->controller(StudentController::class)->group(function(){
        Route::get('/','show')->name('show');
        Route::get('view','student')->name('view');
        Route::get('/edit/{id}','student_edit_form')->name('edit.form');
        Route::put('edit','student_edit')->name('edit');
        Route::post('add','student_add')->name('add');
        Route::delete('delete/{id}','student_delete')->name('delete');
    });

Route::fallback(function(){
    return "Page not Found";
});

require __DIR__.'/auth.php';

