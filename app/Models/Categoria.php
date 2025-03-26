<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "categorie";
    protected $primaryKey = "idCategoria";
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'idCategoria',
        'nome'
    ];


    public function film()
    {
        return $this->hasMany(Film::class, 'idCategoria', 'idCategoria');
    }
    //     Spiegazione dei parametri:

    //     Film::class → è il nome del model collegato

    //     'idCategoria' → è il nome della foreign key nella tabella categorie

    //     'idCategoria' → è il nome della primary key nella tabella film

    public function serie()
    {
        return $this->hasMany(Serie::class, 'idCategoria', 'idCategoria');
    }
}
