<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CategorieStoreRequest;
use App\Http\Requests\v1\CategorieUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Resources\v1\CategoriaResource;
use App\Http\Resources\v1\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Support\Facades\Gate;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        if (Gate::allows("leggere")) {
            $risorsa = Categoria::all();
            return new CategoriaCollection($risorsa);
        } else {
            abort(403,  "GT | Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\CategorieStoreRequest  $request
     * @return jsonResource
     */
    public function store(CategorieStoreRequest $request)
    {
        if (Gate::allows("creare")) {
            // Recupera i dati validati dalla richiesta. Questo assicura che i dati passati alla creazione del nuovo record
            // siano conformi alle regole di validazione definite nella CategorieStoreRequest.
            $dati = $request->validated();

            // Crea un nuovo record di Categoria nel database utilizzando i dati validati.
            // La funzione create() restituirà un'istanza del modello appena creato.
            $categoria = Categoria::create($dati);

            // Ritorna una nuova risorsa CategoriaResource, che permetterà di strutturare la risposta
            // in un formato specifico (ad es. JSON) definito nella risorsa stessa. In questo modo si fornisce
            // al frontend una rappresentazione coerente e ben formattata dei dati appena creati.
            return new CategoriaResource($categoria);
        } else {
            abort(403, "GT | Non sei autorizzato a creare un categoria.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria $categoria
     * @return Jsonresource
     */
    public function show(Categoria $categoria)
    {
        if (Gate::allows("leggere")) {

            return new CategoriaResource($categoria);
        } else {
            abort(403,  "GT | Non sei autorizzato per visualizzare il contenuto.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\request\v1\CategorieUpdateRequest $request
     * @param  Categoria $categoria
     * @return JsonResource
     */
    public function update(CategorieUpdateRequest $request, Categoria $categoria)
    {
        if (Gate::allows("aggiornare")) {
            $dati = $request->validated();
            $categoria->fill($dati);
            $categoria->save();
            return new CategoriaResource($categoria);
        } else {
            abort(403,  "GT | Non sei autorizzato a modificare questo categoria.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria  $categoria)
    {
        if (Gate::allows("eliminare")) {
            $categoria->deleteOrFail();
            return response()->noContent();
        } else {
            abort(403,  "GT | Non sei autorizzato ad eliminare questo categoria.");
        }
    }
}
