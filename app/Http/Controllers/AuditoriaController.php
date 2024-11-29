<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog; 

class AuditoriaController extends Controller
{
    public function index()
    {
        
        $auditoria = AuditLog::all();

        
        return view('auditoria', compact('auditoria'));
    }
}
