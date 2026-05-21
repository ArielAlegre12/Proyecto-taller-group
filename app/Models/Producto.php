<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model 
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'categoria_animal_id',
        'categoria_producto_id'
    ];

    public function detallesVenta(){
        return $this->hasMany(DetalleVenta::class);
    }

    public function categoriaProducto(){
        return $this->belongsTo(CategoriaProducto::class);
    }

    public function categoriaAnimal(){
        return $this->belongsTo(CategoriaAnimal::class);
    }
}
