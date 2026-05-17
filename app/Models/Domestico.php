<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domestico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'domesticos';

    protected $fillable = ['usuario_id','nombreDueño', 'nombreMascota','tipoMascota', 'motivo', 'fechaYHora'];
}
