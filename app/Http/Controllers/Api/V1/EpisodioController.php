<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\EpisodiStoreRequest;
use App\Http\Requests\v1\EpisodiUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\v1\EpisodioResource;
use App\Http\Resources\v1\EpisodioCollection;
use App\Models\Episodio;
use Illuminate\Support\Facades\Gate;

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (Gate::allows("leggere")) {
            $risorsa = Episodio::all();
            return new EpisodioCollection($risorsa);
        } else {
            abort(403,  "Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\EpisodiStoreRequest $request
     * @return jsonResource
     */
    public function store(EpisodiStoreRequest $request)
    {
        if (Gate::allows("creare")) {
            // Recupera i dati validati dalla richiesta. Questo assicura che i dati passati alla creazione del nuovo record
            // siano conformi alle regole di validazione definite nella EpisodiStoreRequest.
            $dati = $request->validated();

            // Crea un nuovo record di Episodio nel database utilizzando i dati validati.
            // La funzione create() restituirà un'istanza del modello appena creato.
            $episodio = Episodio::create($dati);

            // Ritorna una nuova risorsa EpisodioResource, che permetterà di strutturare la risposta
            // in un formato specifico (ad es. JSON) definito nella risorsa stessa. In questo modo si fornisce
            // al frontend una rappresentazione coerente e ben formattata dei dati appena creati.
            return new EpisodioResource($episodio);
        } else {
            abort(403, 'Non sei autorizzato a creare un episodio.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episodio $episodio
     * @return Jsonresource
     */
    public function show(Episodio $episodio)
    {
        if (Gate::allows("leggere")) {

            return new EpisodioResource($episodio);
        } else {
            abort(403,  "Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\EpisodiUpdateRequest $request
     * @param  Episodio $episodio
     * @return JsonResource
     */
    public function update(EpisodiUpdateRequest $request, Episodio $episodio)
    {
        if (Gate::allows("aggiornare")) {
            $dati = $request->validated();
            $episodio->fill($dati);
            $episodio->save();
            return new EpisodioResource($episodio);
        } else {
            abort(403,  "Non sei autorizzato a modificare questo episodio.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episodio $episodio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episodio  $episodio)
    {
        if (Gate::allows("eliminare")) {
            $episodio->deleteOrFail();
            return response()->noContent();
        } else {
            abort(403,  "Non sei autorizzato ad eliminare questo episodio.");
        }
    }
}
