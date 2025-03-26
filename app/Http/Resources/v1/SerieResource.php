<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
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
            // Campo 'idSerie', che rappresenta l'ID della serie
            'idSerie' => $this->idSerie,

            // Campo 'idCategoria', che rappresenta il idCategoria della serie
            'idCategoria' => $this->idCategoria,

            // Campo 'nome', che rappresenta il nome della serie
            'nome' => $this->nome,

            // Campo 'totaleStagioni', che rappresenta totaleStagioni della serie
            'totaleStagioni' => $this->totaleStagioni,

            // Campo 'regista', che rappresenta il regista della serie
            'regista' => $this->regista,

            // Campo 'attori', che rappresenta gli attori della serie
            'attori' => $this->attori,

            // Campo 'annoInizio', che rappresenta l'annoInizio della serie
            'annoInizio' => $this->annoInizio,

            // Campo 'annoFine', che rappresenta l'annoFine della serie
            'annoFine' => $this->annoFine
        ];
    }
}
