<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FilmStoreRequest;
use App\Http\Requests\v1\FilmUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\v1\FilmResource;
use App\Http\Resources\v1\FilmCollection;
use App\Models\Film;
use Illuminate\Support\Facades\Gate;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (Gate::allows("leggere")) {
            $risorsa = Film::all();
            return new FilmCollection($risorsa);
        } else {
            abort(403,  "GT | Non sei autorizzato per visualizzare il contenuto.");
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\FilmStoreRequest  $request
     * @return jsonResource
     */
    public function store(FilmStoreRequest $request)
    {
        if (Gate::allows("creare")) {
            // Recupera i dati validati dalla richiesta. Questo assicura che i dati passati alla creazione del nuovo record
            // siano conformi alle regole di validazione definite nella FilmStoreRequest.
            $dati = $request->validated();

            // Crea un nuovo record di Film nel database utilizzando i dati validati.
            // La funzione create() restituirà un'istanza del modello appena creato.
            $film = Film::create($dati);

            // Ritorna una nuova risorsa FilmResource, che permetterà di strutturare la risposta
            // in un formato specifico (ad es. JSON) definito nella risorsa stessa. In questo modo si fornisce
            // al frontend una rappresentazione coerente e ben formattata dei dati appena creati.
            return new FilmResource($film);
        } else {
            abort(403, "GT | Non sei autorizzato a creare un film.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Film  $film
     * @return Jsonresource
     */
    public function show(Film $film)
    {
        if (Gate::allows("leggere")) {

            return new FilmResource($film);
        } else {
            abort(403,  "GT | Non sei autorizzato per visualizzare il contenuto.");
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\FilmUpdateRequest  $request
     * @param  Film $film
     * @return JsonResource
     */
    public function update(FilmUpdateRequest $request, Film $film)
    {
        if (Gate::allows("aggiornare")) {
            $dati = $request->validated();
            $film->fill($dati);
            $film->save();
            return new FilmResource($film);
        } else {
            abort(403,  "GT | Non sei autorizzato a modificare questo film.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film  $film)
    {
        if (Gate::allows("eliminare")) {
            $film->deleteOrFail();
            return response()->noContent();
        } else {
            abort(403,  "GT | Non sei autorizzato ad eliminare questo film.");
        }
    }
}
