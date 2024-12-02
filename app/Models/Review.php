<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'usuario_id', 'satisfaction_level'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
