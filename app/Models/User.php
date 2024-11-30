<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\People;
use App\Models\Cart;
use App\Models\Order; // Asegúrate de importar el modelo Order

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */

    /**
     * 
     * 
     */
    protected $table = 'users';
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'active',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function people()
    {
        return $this->hasOne(People::class);
    }

    // Cambié la relación de 'pedidos' a 'orders' y la clase a Order
    public function orders()
    {
        return $this->hasMany(Order::class); // Relación con el modelo Order
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
