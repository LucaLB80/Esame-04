<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "film";
    protected $primaryKey = "idFilm";

    protected $fillable = [
        'idCategoria',
        'titolo',
        'descrizione',
        'durata',
        'regista',
        'attori',
        'anno',
        'idImmagine',
        'idFilmato'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }
    //     Spiegazione dei parametri:

    //     Categoria::class → è il nome del model collegato

    //     'idCategoria' → è il nome della foreign key nella tabella film

    //     'idCategoria' → è il nome della primary key nella tabella categorie
}
