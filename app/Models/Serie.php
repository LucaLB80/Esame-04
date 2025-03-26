<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "serie";
    protected $primaryKey = "idSerie";

    protected $fillable = [
        'idCategoria',
        'nome',
        'descrizione',
        'totaleStagioni',
        'numeroEpisodio',
        'regista',
        'attori',
        'annoInizio',
        'annoFine',
        'idImmagine',
        'idFilmato'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }
    //     Spiegazione dei parametri:

    //     Categoria::class → è il nome del model collegato

    //     'idCategoria' → è il nome della foreign key nella tabella serie

    //     'idCategoria' → è il nome della primary key nella tabella categorie
    public function episodi()
    {
        return $this->hasMany(Episodio::class, 'idSerie', 'idSerie');
    }
}
