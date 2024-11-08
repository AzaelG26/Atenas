<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'id_people',
        'admin',
        'curp',
        'nss',
        'rfc',
    ];

    public function people()
    {
        return $this->belongsTo(People::class, 'id_people');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_employee');
    }
}
