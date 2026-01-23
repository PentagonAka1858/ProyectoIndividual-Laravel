<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruta extends Model
{
    use HasFactory;

    protected $table = 'frutas';

    protected $fillable = [
        'nombre',
        'fecha_recoleccion',
        'fecha_caducidad',
        'conservacion',
        'origen',
        'peso',
        'precio',
        'proveedor_id',
    ];

    protected $casts = [
        'fecha_recoleccion' => 'date',
        'fecha_caducidad' => 'date',
        'peso' => 'decimal:2',
        'precio' => 'decimal:2',
    ];

    // Relationship: A fruta belongs to a user (proveedor)
    public function proveedor()
    {
        return $this->belongsTo(User::class, 'proveedor_id');
    }
}   
