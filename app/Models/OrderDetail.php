<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'id_order_detail';

    protected $fillable = [
        'id_order',
        'id_menu',
        'quantity',
        'notes',
        'specifications',
        'status',
    ];

    // Desactivar las marcas de tiempo automáticas
    public $timestamps = false;

    // O si quieres que solo maneje created_at
    const CREATED_AT = 'created_at';  // Mantener el manejo de created_at


    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }
}
