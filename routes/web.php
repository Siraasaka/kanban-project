<?php
use App\Http\Controllers\TaskController; // Ditambahkan
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home'); // name ditambahkan

Route::prefix('tasks')
    ->name('tasks.')
    ->controller(TaskController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');  // Ditambahkan
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::put('{id}/update', 'update')->name('update');
        // Route untuk halaman penghapusan task
        Route::get('/tasks/{id}/delete', 'delete')->name('delete');
        // Route untuk operasi delete task
        Route::delete('/tasks/{id}/destroy', 'destroy')->name('destroy');
    });