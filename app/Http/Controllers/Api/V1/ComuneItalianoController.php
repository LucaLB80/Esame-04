<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ComuneItalianoStoreRequest;
use App\Http\Requests\v1\ComuneItalianoUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\v1\ComuneItalianoResource;
use App\Http\Resources\v1\ComuneItalianoCollection;
use App\Models\ComuneItaliano;
use Illuminate\Support\Facades\Gate;

class ComuneItalianoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (Gate::allows("leggere")) {
            $risorsa = ComuneItaliano::all();
            return new ComuneItalianoCollection($risorsa);
        } else {
            abort(403,  "Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\ComuneItalianoStoreRequest  $request
     * @return jsonResource
     */
    public function store(ComuneItalianoStoreRequest $request)
    {
        if (Gate::allows("creare")) {
            // Recupera i dati validati dalla richiesta. Questo assicura che i dati passati alla creazione del nuovo record
            // siano conformi alle regole di validazione definite nella ComuneItalianoStoreRequest.
            $dati = $request->validated();

            // Crea un nuovo record di Comune nel database utilizzando i dati validati.
            // La funzione create() restituirà un'istanza del modello appena creato.
            $comuneItaliano = ComuneItaliano::create($dati);

            // Ritorna una nuova risorsa ComuneItalianoResource, che permetterà di strutturare la risposta
            // in un formato specifico (ad es. JSON) definito nella risorsa stessa. In questo modo si fornisce
            // al frontend una rappresentazione coerente e ben formattata dei dati appena creati.
            return new ComuneItalianoResource($comuneItaliano);
        } else {
            abort(403, 'Non sei autorizzato a creare un comune.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComuneItaliano  $idComune
     * @return Jsonresource
     */
    public function show(ComuneItaliano $comune)
    {
        if (Gate::allows("leggere")) {

            return new ComuneItalianoResource($comune);
        } else {
            abort(403,  "Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\ComuneItalianoUpdateRequest  $request
     * @param  ComuneItaliano $comune
     * @return JsonResource
     */
    public function update(ComuneItalianoUpdateRequest $request, ComuneItaliano $comune)
    {
        if (Gate::allows("aggiornare")) {
            $dati = $request->validated();
            $comune->fill($dati);
            $comune->save();
            return new ComuneItalianoResource($comune);
        } else {
            abort(403,  "Non sei autorizzato a modificare questo comune.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComuneItaliano  $comune
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComuneItaliano  $comune)
    {
        if (Gate::allows("eliminare")) {
            $comune->deleteOrFail();
            return response()->noContent();
        } else {
            abort(403,  "Non sei autorizzato ad eliminare questo comune.");
        }
    }
}
