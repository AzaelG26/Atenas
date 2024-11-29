<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{   
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'estado', 'total', ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

}

