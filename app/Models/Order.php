<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'diner_name',
        'total_price',
        'status',
        'id_employee',
        'id_payment',
        'id_folio',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee', 'id_employee');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment', 'id_payment');
    }

    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio', 'id_folio');
    }
}
