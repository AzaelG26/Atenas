<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    use HasFactory;

    protected $table = 'menu_details';

    protected $fillable = [
        'id_menu',
        'id_ingredient',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'id_ingredient', 'id_ingredient');
    }
}
