<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'empresa',
        'telefono',
        'direccion',
    ];

    public function productos() { 
        return $this->belongsToMany(Proveedor::class, 
            'proveedor_productos', 
            'producto_id', 
            'proveedor_id'); 
    }

}
