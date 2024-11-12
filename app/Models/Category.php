<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id_category'; // Definimos la clave primaria correcta

    protected $fillable = [
        'name',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_category', 'id_category'); // Mantenemos la relación con id_category
    }
}
