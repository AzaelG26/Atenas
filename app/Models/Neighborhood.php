<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $table = 'neighborhood';

    protected $fillable = [
        'name',
        'id_settlement_type',
        'id_postal_codes',
    ];

    public function settlementType()
    {
        return $this->belongsTo(SettlementType::class, 'id_settlement_type', 'id_settlement_type');
    }

    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class, 'id_postal_codes', 'id_postal_codes');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'id_neighborhood', 'id_neighborhood');
    }
}
