<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    protected $table = 'postal_codes';

    protected $fillable = [
        'postal_code',
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'id_postal_codes', 'id_postal_codes');
    }
}
