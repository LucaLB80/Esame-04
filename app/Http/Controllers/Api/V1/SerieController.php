<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SerieStoreRequest;
use App\Http\Requests\v1\SerieUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\v1\SerieResource;
use App\Http\Resources\v1\SerieCollection;
use App\Models\Serie;
use Illuminate\Support\Facades\Gate;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (Gate::allows("leggere")) {
            $risorsa = Serie::all();
            return new SerieCollection($risorsa);
        } else {
            abort(403,  "GT | Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\SerieStoreRequest  $request
     * @return jsonResource
     */
    public function store(SerieStoreRequest $request)
    {
        if (Gate::allows("creare")) {
            // Recupera i dati validati dalla richiesta. Questo assicura che i dati passati alla creazione del nuovo record
            // siano conformi alle regole di validazione definite nella SerieStoreRequest.
            $dati = $request->validated();

            // Crea un nuovo record di Serie nel database utilizzando i dati validati.
            // La funzione create() restituirà un'istanza del modello appena creato.
            $serie = Serie::create($dati);

            // Ritorna una nuova risorsa SerieResource, che permetterà di strutturare la risposta
            // in un formato specifico (ad es. JSON) definito nella risorsa stessa. In questo modo si fornisce
            // al frontend una rappresentazione coerente e ben formattata dei dati appena creati.
            return new SerieResource($serie);
        } else {
            abort(403, "GT | Non sei autorizzato a creare un serie.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie $serie
     * @return Jsonresource
     */
    public function show(Serie $serie)
    {
        if (Gate::allows("leggere")) {

            return new SerieResource($serie);
        } else {
            abort(403,  "GT | Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\SerieUpdateRequest $request
     * @param  Serie $serie
     * @return JsonResource
     */
    public function update(SerieUpdateRequest $request, Serie $serie)
    {
        if (Gate::allows("aggiornare")) {
            $dati = $request->validated();
            $serie->fill($dati);
            $serie->save();
            return new SerieResource($serie);
        } else {
            abort(403,  "GT | Non sei autorizzato a modificare questo serie.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie  $serie)
    {
        if (Gate::allows("eliminare")) {
            $serie->deleteOrFail();
            return response()->noContent();
        } else {
            abort(403,  "GT | Non sei autorizzato ad eliminare questo serie.");
        }
    }
}
