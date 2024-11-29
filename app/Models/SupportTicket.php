<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $table = 'support_tickets';

    protected $primaryKey = 'id';
    public $incrementing = true; 
    protected $keyType = 'int'; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
