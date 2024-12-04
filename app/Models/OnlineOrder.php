<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model
{
    use HasFactory;

    protected $table = 'online_orders';
    protected $primaryKey = 'id_online_order';  // Especificando la clave primaria

    protected $fillable = [
        'order_name',
        'notes',
        'id_people',
        'total_price',
        'id_payment',
        'status',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'id_address', 'id_address');
    }


    public function people()
    {
        return $this->belongsTo(People::class, 'id_people');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }

    public function onlineOrderDetails()
    {
        return $this->hasMany(OnlineOrderDetail::class, 'id_online_order');
    }
    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio');
    }
}
