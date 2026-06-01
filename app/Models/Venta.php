<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'usuario_id',
        'total',
        'estado',
        'metodo_pago',
        'metodo_entrega'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function detalles(){
        return $this->hasMany(DetalleVenta::class);
    }

    
}
