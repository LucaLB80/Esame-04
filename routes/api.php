<?php

use App\Http\Controllers\Api\V1\AccediController;
use App\Http\Controllers\Api\V1\NazioneController;
use App\Http\Controllers\Api\V1\ComuneItalianoController;
use App\Http\Controllers\Api\V1\FilmController;
use App\Http\Controllers\Api\V1\EpisodioController;
use App\Http\Controllers\Api\V1\SerieController;
use App\Http\Controllers\Api\V1\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Helpers\AppHelper;


//<------------------------------------------- API PUBBLICHE ---------------------------------------------------------------->

Route::post('/registrazione', [AccediController::class, 'registrazione']);
Route::get('/accedi/{utente}/{hash?}', [AccediController::class, 'show']);
Route::put('/modificaPassword', [AccediController::class, 'modificaPassword']);
Route::post('/logout', [AccediController::class, 'logout']);


//<------------------------------------------- API CON AUTENTICAZIONE UTENTE ---------------------------------------------------------------->

Route::middleware(['autenticazione', 'contattiRuoli:Amministratore,Utente'])->group(function () {

    // CRUD NAZIONI
    Route::get('/nazioni', [NazioneController::class, 'index']);  // Lista nazione
    Route::get('/nazioni/{nazione}', [NazioneController::class, 'show']); // Dettaglio nazione

    // CRUD COMUNI ITALIANI
    Route::get('/comuni', [ComuneItalianoController::class, 'index']);  // Lista comune Italiano
    Route::get('/comuni/{comune}', [ComuneItalianoController::class, 'show']); // Dettaglio comune Italiano

    // CRUD FILM
    Route::get('/film', [FilmController::class, 'index']); // Lista film
    Route::get('/film/{film}', [FilmController::class, 'show']); // Dettaglio film

    // CRUD EPISODI
    Route::get('/episodi', [EpisodioController::class, 'index']); // Lista episodi
    Route::get('/episodi/{episodio}', [EpisodioController::class, 'show']); // Dettaglio episodi   

    // CRUD SERIE
    Route::get('/serie', [SerieController::class, 'index']); // Lista serie
    Route::get('/serie/{serie}', [SerieController::class, 'show']); // Dettaglio serie   

    // CRUD CATEGORIE
    Route::get('/categorie', [CategoriaController::class, 'index']); // Lista categoria
    Route::get('/categorie/{categoria}', [CategoriaController::class, 'show']); // Dettaglio categoria   

});
//<------------------------------------------- API CON AUTENTICAZIONE AMMINISTRATORE ---------------------------------------------------------------->

Route::middleware(['autenticazione', 'contattiRuoli:Amministratore'])->group(function () {

    // CRUD NAZIONI
    Route::post('/nazioni', [NazioneController::class, 'store']); // Creazione nazione  
    Route::put('/nazioni/{nazione}', [NazioneController::class, 'update']); // Modifica nazione     
    Route::delete('/nazioni/{nazione}', [NazioneController::class, 'destroy']); // Eliminazione nazione

    // CRUD COMUNI ITALIANI
    Route::post('/comuni', [ComuneItalianoController::class, 'store']); // Creazione comune Italiano  
    Route::put('/comuni/{comune}', [ComuneItalianoController::class, 'update']); // Modifica comune Italiano 
    Route::delete('/comuni/{comune}', [ComuneItalianoController::class, 'destroy']); // Eliminazione comune Italiano

    // CRUD FILM
    Route::post('/film', [FilmController::class, 'store']); // Creazione film 
    Route::put('/film/{film}', [FilmController::class, 'update']); // Modifica film  
    Route::delete('/film/{film}', [FilmController::class, 'destroy']); // Eliminazione film

    // CRUD EPISODI
    Route::post('/episodi', [EpisodioController::class, 'store']); // Creazione episodi
    Route::put('/episodi/{episodio}', [EpisodioController::class, 'update']); // Modifica episodi   
    Route::delete('/episodi/{episodio}', [EpisodioController::class, 'destroy']); // Eliminazione episodi

    // CRUD SERIE
    Route::post('/serie', [SerieController::class, 'store']); // Creazione serie 
    Route::put('/serie/{serie}', [SerieController::class, 'update']); // Modifica serie  
    Route::delete('/serie/{serie}', [SerieController::class, 'destroy']); // Eliminazione serie

    // CRUD CATEGORIE
    Route::post('/categorie', [CategoriaController::class, 'store']); // Creazione categoria 
    Route::put('/categorie/{categoria}', [CategoriaController::class, 'update']); // Modifica categoria  
    Route::delete('/categorie/{categoria}', [CategoriaController::class, 'destroy']); // Eliminazione categoria
});



//<-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
//<-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

Route::get('/testLogin', function () { // COMMENTARE DOPO IL CONTROLLO POSITIVO DEL LOGIN
    $hashUser = "4a8f80d84f37e0ff32b8893d65ab1288d48b552adff2f9817c28c9786f0a4a4028ae27b187e766fccc7bec12e13a9fd9ac8e926c8db882e775dd02a57dc3ceda";
    $pwd = "804f50ddbaab7f28c933a95c162d019acbf96afde56dba10e4c7dfcfe453dec4bacf5e78b1ddbdc1695a793bcb5d7d409425db4cc3370e71c4965e4ef992e8c4";
    $salt = "a0c299b71a9e59d5ebb07917e70601a3570aa103e99a7bb65a58e780ec9077b1902d1dedb31b1457beda595fe4d71d779b6ca9cad476266cc07590e31d84b206";

    $hashSalePsw = AppHelper::nascondiPassword($pwd, $salt);

    AccediController::testLogin($hashUser, $hashSalePsw);
});
