<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Usuario;


class Produccion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'producciones';

    protected $fillable = ['usuario_id', 'nombreProdu', 'nombreEstablo', 'tipoAnimal', 'cantidad', 'motivo', 'tipoServicio', 'fechaYHora'];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
