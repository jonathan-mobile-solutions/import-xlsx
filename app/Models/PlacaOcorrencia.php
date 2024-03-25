<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacaOcorrencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'arquivo',
        'ocorrencia',
        'placa',
        'cidade',
        'estado',
        'data',
    ];
}
