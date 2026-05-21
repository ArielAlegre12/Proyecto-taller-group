<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaAnimal extends Model
{
    protected $table = 'categoria_animales';
    protected $fillable = [
        'nombre'
    ];
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
