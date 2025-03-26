<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class NazioneResource extends JsonResource
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
            // Campo 'idNazione', che rappresenta l'ID della nazione
            'idNazione' => $this->idNazione,

            // Campo 'nome', che rappresenta il nome della nazione
            'nome' => $this->nome,

            // Campo 'continente', che rappresenta il continente della nazione
            'continente' => $this->continente,

            // Campo 'iso', che rappresenta iso della nazione
            'iso' => $this->iso,

            // Campo 'iso3', che rappresenta iso3 della nazione
            'iso3' => $this->iso3,

            // Campo 'prefissoTelefonico', che rappresenta prefissoTelefonico della nazione
            'prefissoTelefonico' => $this->prefissoTelefonico
        ];
    }
}
