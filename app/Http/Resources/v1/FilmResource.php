<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->getCampi();
    }
    //--- METODI PROTETTI -----------------------------------------------------------
    //-------------------------------------------------------------------------------

    /**
     * Metodo protetto per ottenere i campi personalizzati della risorsa.
     * Questo metodo definisce manualmente i campi che devono essere inclusi
     * nella risposta JSON, fornendo maggiore controllo sulla struttura della risposta.
     *
     * @return array Un array associativo con i campi della risorsa.
     */
    protected function getCampi()
    {
        return [
            // Campo 'idFilm', che rappresenta l'ID del film
            'idFilm' => $this->idFilm,

            // Campo 'idCategoria', che rappresenta il idCategoria del film
            'idCategoria' => $this->idCategoria,

            // Campo 'titolo', che rappresenta il titolo del film
            'titolo' => $this->titolo,

        ];
    }
}
