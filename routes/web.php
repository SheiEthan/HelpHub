<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThematiqueController;

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

// Pour la page de connexion 
Route::get('/connexion', function () {
    return view('connexion');
});

// Pour la page de rechercher 
Route::get('/rechercher', function () {
    return view('rechercher');
});

// Pour la page d'inscription 
Route::get('/inscription', function () {
    return view('inscription');
});

// Pour la page compte
Route::get('/compte', function () {
    return view('page_compte');
});

Route::post('/inscription', [UtilisateurController::class, "createUtilisateur"]
);


// pour les thematique 
Route::get('/', [ThematiqueController::class, 'getThematique']);

// pour les publication 
Route::get('/rechercher', [PublicationController::class, 'afficherResultats']);

//Route::get('/', [ThematiqueController::class, "showComboBox"]);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// pour 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
