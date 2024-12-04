<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['contenido', 'usuario_id', 'folio','rating'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
