<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodioResource extends JsonResource
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
            // Campo 'idEpisodio', che rappresenta l'ID dell'episodio
            'idEpisodio' => $this->idEpisodio,

            // Campo 'idSerie', che rappresenta il idSerie dell'episodio
            'idSerie' => $this->idSerie,

            // Campo 'titolo', che rappresenta il titolo dell'episodio
            'titolo' => $this->titolo,

            // Campo 'numeroStagione', che rappresenta numeroStagione dell'episodio
            'numeroStagione' => $this->numeroStagione,

            // Campo 'numeroEpisodio', che rappresenta il numero di episodio 
            'numeroEpisodio' => $this->numeroEpisodio,

            // Campo 'durata', che rappresenta durata dell'episodio
            'durata' => $this->durata
        ];
    }
}
