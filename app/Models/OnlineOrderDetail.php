<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'online_orders_details';

    protected $fillable = [
        'id_online_order',
        'id_menu',
        'quantity',
        'specifications',
        'id_folio',
    ];

    public function onlineOrder()
    {
        return $this->belongsTo(OnlineOrder::class, 'id_online_order', 'id_online_order');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }

    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio', 'id_folio');
    }
}
