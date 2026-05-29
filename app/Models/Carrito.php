<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';

    protected $fillable = [
        'usuario_id'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function items(){
        return $this->hasMany(CarritoItem::class);
    }
}
