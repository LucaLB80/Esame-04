<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContattoStato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contatti_stati';
    protected $primaryKey = 'idContattoStato';

    protected $fillable = [
        'nome',
    ];
}
