<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

<<<<<<< HEAD:app/Models/Reseña.php
    protected $fillable = ['contenido', 'usuario_id', 'folio','rating'];
=======
    protected $fillable = ['review', 'usuario_id', 'satisfaction_level'];
>>>>>>> a69e2cfdbfdad96ee927ee1abb1a573aeb9857a9:app/Models/Review.php

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
