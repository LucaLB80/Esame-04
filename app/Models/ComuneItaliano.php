<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComuneItaliano extends Model
{
    use HasFactory;
    protected $table = "comuni_italiani";
    protected $primaryKey = "idComune";

    protected $fillable = [
        'comune',
        'regione',
        'provincia',
        'zona',
        'sigla_provincia',
        'codice_istat',
        'abitanti',
        'superficie',
        'cap',
        'altitudine',
        'popolazione_residente'
    ];
}
