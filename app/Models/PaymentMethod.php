<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = [
        'method_name',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_payment_method', 'id_payment_method');
    }
}