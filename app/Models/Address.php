<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'street',
        'id_client',
        'id_neighborhood',
        'reference',
        'interior_number',
        'outer_number',
    ];

    public function client()
    {
        return $this->belongsTo(People::class, 'id_client');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'id_neighborhood');
    }
}
