<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';

    protected $fillable = ['usuario_id', 'nombre', 'telefono', 'email', 'tipo_animal', 'nombre_animal', 'especie', 'tipo_campo', 'raza', 'edad', 'peso', 'tipo_consulta', 'fecha_hora', 'descripcion', 'estado'];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
