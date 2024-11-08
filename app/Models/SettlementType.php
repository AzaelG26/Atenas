<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    use HasFactory;

    protected $table = 'settlement_type';

    protected $fillable = [
        'settlement_type_name',
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'id_settlement_type', 'id_settlement_type');
    }
}
