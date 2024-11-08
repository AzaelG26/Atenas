<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'existence',
    ];

    public function menuItems()
    {
        return $this->belongsToMany(Menu::class, 'menu_details', 'id_ingredient', 'id_menu');
    }
}
