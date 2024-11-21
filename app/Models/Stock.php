<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    protected $primaryKey = 'id_stock';  // Asegúrate de que la clave primaria esté configurada


    protected $fillable = [
        'stock',
        'id_menu',
    ];

    /**
     * 
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }
}
