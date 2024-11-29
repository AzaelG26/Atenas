<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_logs'; 

    protected $fillable = [
        'table_name',
        'action_type',
        'record_id',
        'old_data',
        'new_data',
        'user_id',
    ];
}
