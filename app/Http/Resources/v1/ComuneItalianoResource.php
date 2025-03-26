<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ComuneItalianoResource extends JsonResource
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
            // Campo 'idComune', che rappresenta l'ID del comune
            'idComune' => $this->idComune,

            // Campo 'comune', che rappresenta il comune di appartenenza
            'comune' => $this->comune,

            // Campo 'regione', che rappresenta la regione del comune
            'regione' => $this->regione,

            // Campo 'provincia', che rappresenta la provincia del comune
            'provincia' => $this->provincia,

            // Campo 'sigla_provincia', che rappresenta sigla_provincia del comune
            'sigla_provincia' => $this->sigla_provincia,

            // Campo 'cap', che rappresenta il cap del comune
            'cap' => $this->cap
        ];
    }
}
