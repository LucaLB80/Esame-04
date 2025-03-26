<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\NazioneStoreRequest;
use App\Http\Requests\v1\NazioneUpdateRequest;
use App\Http\Resources\v1\NazioneCollection;
use App\Http\Resources\v1\NazioneResource;
use Illuminate\Http\Request;
use App\Models\Nazione;
use Illuminate\Support\Facades\Gate;

class NazioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows("leggere")) {

            $nazioni = Nazione::all();
            $risorsa = new NazioneCollection($nazioni);
            return $risorsa;
        } else {
            abort(403,  "Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\NazioneStoreRequest  $request
     * @return jsonResource
     */
    public function store(NazioneStoreRequest $request)
    {
        if (Gate::allows("creare")) {
            // Recupera i dati validati dalla richiesta. Questo assicura che i dati passati alla creazione del nuovo record
            // siano conformi alle regole di validazione definite nella NazioneStoreRequest.
            $dati = $request->validated();

            // Crea un nuovo record di Nazione nel database utilizzando i dati validati.
            // La funzione create() restituirà un'istanza del modello appena creato.
            $tipoNazione = Nazione::create($dati);

            // Ritorna una nuova risorsa NazioneResource, che permetterà di strutturare la risposta
            // in un formato specifico (ad es. JSON) definito nella risorsa stessa. In questo modo si fornisce
            // al frontend una rappresentazione coerente e ben formattata dei dati appena creati.
            return new NazioneResource($tipoNazione);
        } else {
            abort(403, 'Non sei autorizzato a creare una nazione.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nazione $nazione)
    {
        if (Gate::allows("leggere")) {

            return new NazioneResource($nazione);
        } else {
            abort(403,  "Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\NazioneUpdateRequest  $request
     * @param  Nazione $nazione
     * @return JsonResource
     */
    public function update(NazioneUpdateRequest $request, Nazione $nazione)
    {
        if (Gate::allows("aggiornare")) {
            $dati = $request->validated();
            $nazione->fill($dati);
            $nazione->save();
            return new NazioneResource($nazione);
        } else {
            abort(403,  "Non sei autorizzato a modificare questa nazione.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nazione  $nazione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nazione  $nazione)
    {
        if (Gate::allows("eliminare")) {
            $nazione->deleteOrFail();
            return response()->noContent();
        } else {
            abort(403,  "Non sei autorizzato ad eliminare questa nazione.");
        }
    }
}
