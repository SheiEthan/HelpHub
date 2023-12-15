<?php

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\FiltreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\DiffusionController;
use App\Http\Controllers\InfoBancaireController;
use App\Http\Controllers\ServicebenevoleController;
use App\Http\Controllers\ServiceComptableController;
use App\Http\Controllers\ServicejuridiqueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThematiqueController;
use App\Models\Association;
use App\Models\Signaler;
use Laravel\Sanctum\Http\Middleware\AuthenticateSession;

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
Route::get('/cookies', function () {
    return view('cookies');
});


Route::get('/publication/commentaire', function () {
    return view('publication');
});

// Pour la page de rechercher 
Route::get('/rechercher', [PublicationController::class, "afficherResultats"]);

#HOP ;)
Route::post('/publication/commentaire/{id_publication}', [CommentaireController::class, "storeComment"]);

// Pour la page d'inscription 
Route::get('/politiquesprotec', function () {
    return view('politiquesprotec');
});

// pour la page de voir plus les publication 
Route::get('/publication', function () {
    return view('publication');
});

// Pour la page compte
Route::get('/compte', function () {
    return view('page_compte');
});

Route::post('/data/likerpubli/{id_publication}', [PublicationController::class, "liker"]
);
Route::get('/data/likespubli', [PublicationController::class, "getLikes"]
);
// recupere les likes 
Route::get('/data/likes', [CommentaireController::class, "getLikes"]
);

// liker un commentaire 
Route::post('/data/commentaire/liker/{id_commentaire}', [CommentaireController::class, "liker"]
);
// signaler un commentaire 
Route::post('/data/commentaire/signaler/{id_commentaire}', [CommentaireController::class, "signaler"]
);



// pour les thematique 
Route::get('/', [PublicationController::class, 'GetPub3']);

// pour les filtre 
//Route::get('/rechercher', [FiltreController::class, 'getFiltres']);

// pour les publication 
Route::post('/rechercher', [PublicationController::class, 'afficherResultats']);

// pour les candidatures 
Route::post('/publication/candidature/{id_publication}', [CandidatureController::class, 'demandeCandidature']);

//Route::get('/', [ThematiqueController::class, "showComboBox"]);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mypublications',[PublicationController::class, "mypublications"])->middleware(['auth', 'verified'])->name('mypublications');
Route::get('/myalertes',[PublicationController::class, "myalertes"])->middleware(['auth', 'verified'])->name('myalertes');
Route::post('/myalertes',[PublicationController::class, "updateAlertes"])->middleware(['auth', 'verified'])->name('myalertes');


Route::get('/createassociation', function () { 
    return view('createassociation');
})->middleware(['auth', 'verified'])->name('createassociation');

Route::post('/createassociation', [AssociationController::class, 'createassociation'])->middleware(['auth', 'verified'])->name('createassociation');

Route::get('/infopublication', [AssociationController::class, "infopublication"])->middleware(['auth', 'verified'])->name('infopublication');

// Informations Bancaire
Route::get('/MesinfoBancaire', function () { 
    return view('MesinfoBancaire');
})->middleware(['auth', 'verified'])->name('MesinfoBancaire');
Route::get('/MesinfoBancaire', [InfoBancaireController::class, 'getinfo'])->middleware(['auth', 'verified'])->name('MesinfoBancaire');


// pour le service de diffusion 

// pour les commentaires signaler 
Route::get('/servicediffusion', [DiffusionController::class, 'getSignaler'])->middleware(['auth', 'verified'])->name('servicediffusion');
// suprrimer un com 
Route::post('/servicediffusion/{id_commentaire}', [DiffusionController::class, 'deletecom'])->middleware(['auth', 'verified'])->name('servicediffusion/{id_commentaire}');

// pour la validation des publication 
Route::get('/servicediffusionpublication', [DiffusionController::class, 'getPubValider'])->middleware(['auth', 'verified'])->name('servicediffusionpublication');
// 
Route::post('/servicediffusionpublication/valider/{id_publication}', [DiffusionController::class, 'validerpub'])->middleware(['auth', 'verified'])->name('/servicediffusionpublication/valider/{id_publication}');
Route::post('/servicediffusionpublication/refuser/{id_publication}', [DiffusionController::class, 'refuserpub'])->middleware(['auth', 'verified'])->name('/servicediffusionpublication/refuser/{id_publication}');
Route::post('/servicediffusionpublication/invisible/{id_publication}', [DiffusionController::class, 'cacherpub'])->middleware(['auth', 'verified'])->name('/servicediffusionpublication/invisible/{id_publication}');

// service diffusion ajout de thematique 
Route::get('/servicediffusionthematique', function () { 
    return view('servicediffusionthematique');
})->middleware(['auth', 'verified'])->name('servicediffusionthematique');
Route::post('/servicediffusionthematique/thematique', [DiffusionController::class, 'AjoutThematique'])->middleware(['auth', 'verified'])->name('/servicediffusionthematique/thematique');
Route::get('/servicediffusionthematique', [DiffusionController::class, 'getThematique'])->middleware(['auth', 'verified'])->name('servicediffusionthematique');

// service comptable 
Route::get('/comptabledon', [ServiceComptableController::class, 'MontantDon'])->middleware(['auth', 'verified'])->name('comptabledon');
Route::get('/comptablecontrat', [ServiceComptableController::class, 'getAsso'])->middleware(['auth', 'verified'])->name('comptablecontrat');
Route::post('/comptablecontrat/contrat', [ServiceComptableController::class, 'Contrat'])->middleware(['auth', 'verified'])->name('/comptablecontrat/contrat');


// service benevole 
Route::get('/servicebenevolat', [ServicebenevoleController::class, 'getCandidature'])->middleware(['auth', 'verified'])->name('servicebenevolat');
Route::post('/servicebenevolat/valider/{id_utilisateur}/{id_recherche_benevole}', [ServicebenevoleController::class, 'validerCandidature'])->middleware(['auth', 'verified'])->name('/servicebenevolat/valider/{id_utilisateur}/{id_recherche_benevole}');
Route::post('/servicebenevolat/refuser/{id_utilisateur}/{id_recherche_benevole}', [ServicebenevoleController::class, 'refuserCandidature'])->middleware(['auth', 'verified'])->name('/servicebenevolat/refuser/{id_utilisateur}/{id_recherche_benevole}');
Route::post('/servicebenevolat/information/{id_utilisateur}/{id_recherche_benevole}', [ServicebenevoleController::class, 'informationCandidature'])->middleware(['auth', 'verified'])->name('/servicebenevolat/information/{id_utilisateur}/{id_recherche_benevole}');
Route::post('/servicebenevolat/juridique/{id_utilisateur}/{id_recherche_benevole}', [ServicebenevoleController::class, 'JuridiqueCandidature'])->middleware(['auth', 'verified'])->name('/servicebenevolat/juridique/{id_utilisateur}/{id_recherche_benevole}');

// Service juridique
Route::get('/servicejuridique', [ServicejuridiqueController::class, 'GetCandidatureJuridique'])->middleware(['auth', 'verified'])->name('servicejuridique');
Route::post('/servicejuridique/valider/{id_utilisateur}/{id_recherche_benevole}', [ServicejuridiqueController::class, 'validerCandidatureJuridique'])->middleware(['auth', 'verified'])->name('/servicejuridique/valider/{id_utilisateur}/{id_recherche_benevole}');
Route::post('/servicejuridique/refuser/{id_utilisateur}/{id_recherche_benevole}', [ServicejuridiqueController::class, 'refuserCandidatureJuridique'])->middleware(['auth', 'verified'])->name('/servicejuridique/refuser/{id_utilisateur}/{id_recherche_benevole}');

// les candidatures 
Route::get('/mycandidatures', [CandidatureController::class, 'getMyCandidature'])->middleware(['auth', 'verified'])->name('mycandidatures');
Route::post('/mycandidatures/information/{id_utilisateur}/{id_recherche_benevole}', [CandidatureController::class, 'updateCandidature'])->middleware(['auth', 'verified'])->name('/mycandidatures/information/{id_utilisateur}/{id_recherche_benevole}');


// Association 
Route::get('/myassociation', [AssociationController::class, "mypublications"])->middleware(['auth', 'verified'])->name('myassociation');
Route::get('/gestionheures', [AssociationController::class, "mypublicationsbenevoles"])->middleware(['auth', 'verified'])->name('gestionheures');
Route::get('/gestionheures/{id_publication}', [AssociationController::class, "mypublicationbenevoles"])->middleware(['auth', 'verified'])->name('gestionheures/{id_publication}');
Route::post('/gestionheures/{id_publication}', [AssociationController::class, "updateheures"])->middleware(['auth', 'verified'])->name('gestionheures/{id_publication}');
Route::get('/gestioncandidature', function () { 
    return view('gestioncandidature');
})->middleware(['auth', 'verified'])->name('gestioncandidature');
Route::get('/gestioncandidature', [CandidatureController::class, 'getCandidature'])->middleware(['auth', 'verified'])->name('gestioncandidature');
Route::post('/gestioncandidature/valider/{id_utilisateur}/{id_recherche_benevole}', [CandidatureController::class, 'validerCandidature'])->middleware(['auth', 'verified'])->name('/gestioncandidature/valider/{id_utilisateur}/{id_recherche_benevole}');
Route::post('/gestioncandidature/refuser/{id_utilisateur}/{id_recherche_benevole}', [CandidatureController::class, 'refuserCandidature'])->middleware(['auth', 'verified'])->name('/gestioncandidature/refuser/{id_utilisateur}/{id_recherche_benevole}');



// Association creer une  publication et l'afficher 
Route::post('/createpublication', [AssociationController::class, "createpublication"])->middleware(['auth', 'verified'])->name('createpublication');
Route::get('/publication/{id_publication}',[PublicationController::class, "afficherPublication"]);
Route::get('/publication/editer/{id_publication}',[AssociationController::class, "infoupdatepublication"])->middleware(['auth', 'verified'])->name('publication/editer/{id_publication}');
Route::post('/publication/editer/{id_publication}',[AssociationController::class, "updatepublication"])->middleware(['auth', 'verified'])->name('publication/editer/{id_publication}');

//google
    Route::get('/login/google', [AuthenticatedSessionController::class, 'redirectToGoogle']);
    Route::get('/login/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback']);
    Route::get('/loginsms', [AuthenticatedSessionController::class, 'dauth'])->middleware(['auth', 'verified'])->name('loginsms');
    Route::post('/loginsms', [AuthenticatedSessionController::class, 'checkcode'])->middleware(['auth', 'verified'])->name('loginsms');


// pour le profil 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
