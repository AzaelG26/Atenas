<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model
{
    use HasFactory;

    protected $table = 'online_orders';

    protected $fillable = [
        'order_name',
        'notes',
        'id_people',
        'total_price',
        'id_payment',
        'status',
    ];

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
}
