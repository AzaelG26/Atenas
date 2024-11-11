<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'id_category',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'menu_details', 'id_menu', 'id_ingredient');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

}
