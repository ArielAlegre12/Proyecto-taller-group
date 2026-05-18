<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
