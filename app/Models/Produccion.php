<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Produccion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'producciones';

    protected $fillable = ['nombreProdu', 'nombreEstablo', 'tipoAnimal', 'cantidad', 'motivo', 'tipoServicio', 'fechaYHora'];
}
