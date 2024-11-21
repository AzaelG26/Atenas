<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';


    protected $fillable = [
        'user_id',
        'name',
        'paternal_lastname',
        'maternal_lastname',
        'gender',
        'cellphone_number',
        'birthdate',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'id_client', 'id');
    }

}
