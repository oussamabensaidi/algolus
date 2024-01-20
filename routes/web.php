<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashController;
use App\Http\Controllers\dossierController;
use App\Http\Controllers\HistoryController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




Route::get('/dash/index', [dashController::class, 'index'])->name('dash.index');
Route::get('/dash/dossier/index', [dossierController::class, 'index'])->name('dash.dossier.index');
Route::get('/dash/dossier/show/{id}', [dossierController::class, 'show'])->name('dash.dossier.show');
Route::get('/dash/dossier/create', [dossierController::class, 'create'])->name('dash.dossier.create');
Route::post('/dash/dossier/store', [dossierController::class, 'store'])->name('dash.dossier.store');
Route::get('/dash/dossier/edit/{id}', [dossierController::class, 'edit'])->name('dash.dossier.edit');
Route::get('downloadFile/public/uploads/{user_service}/{user_id}/{f_name}', [dossierController::class, 'downloadFile']);
Route::delete('deleteFile/{id}', [dossierController::class, 'deleteFile'])->name('deleteFile');
Route::put('addFile', [dossierController::class, 'addFile'])->name('addFile');
Route::put('/dash/dossier/update/{id}', [dossierController::class, 'update'])->name('dash.dossier.update');
Route::delete('/dash/dossier/delete/{id}', [dossierController::class, 'destroy'])->name('dash.dossier.delete');


Route::get('/dash/history/index', [HistoryController::class, 'index'])->name('dash.history.index');
});

require __DIR__.'/auth.php';

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['guest'])->group(function () {
    Route::get('/dash/register', [dashController::class, 'register'])->name('dash.register');
    Route::get('/dash/login', [dashController::class, 'login'])->name('dash.login');
});

