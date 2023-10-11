<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barcode',
        'plu',
        'descripcion_producto',
        'precio_venta_producto',
        'precio_compra_producto',
        'precio_reparto_producto',
        'estado_producto',
        'fecha',
        'imagen_producto',
        'existencia',
    ];

    public function proveedores() { 
        return $this->belongsToMany(Proveedor::class, 
            'proveedor_productos', 
            'producto_id', 
            'proveedor_id'); 
    }
    
    public function categorias() { 
        return $this->belongsToMany(Proveedor::class, 
            'categoria_productos', 
            'producto_id', 
            'categoria_id'); 
    }




}
