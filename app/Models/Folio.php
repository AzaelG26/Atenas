<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use onlineOrderDetails;

class Folio extends Model
{
    use HasFactory;

    protected $table = 'folios';
    protected $primaryKey = 'id_folio';  // Especificando la clave primaria

    protected $fillable = [
        'identifier',
    ];

    // Relación inversa con OnlineOrderDetail
    public function onlineOrderDetails()
    {
        return $this->hasMany(OnlineOrderDetail::class, 'id_folio', 'id_folio');
    }

    public function order()
    {
        return $this->hasMany(OrderDetail::class, 'id_folio');
    }
}
