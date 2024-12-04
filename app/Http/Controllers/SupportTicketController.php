<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    
    public function index()
    {
        $tickets = SupportTicket::all();  
        return view('tickets', compact('tickets')); 
    }

    public function show($id)
    {
        
        $ticket = SupportTicket::find($id);
       
        if (!$ticket) {
            abort(404, 'Ticket no encontrado');
            
        }
    
        return view('show', compact('ticket'));
    }
    
    public function create()
    {
        return view('create');  
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|regex:/^\+?[0-9\s\-()]*$/|unique:support_tickets,phone',
            'email' => 'nullable|email',
        ], [
            'phone.regex' => 'Por favor, ingrese un número de teléfono válido.',
            'phone.unique' => 'Este número de teléfono ya está registrado.',
            'email.email' => 'Por favor, ingrese un correo electrónico válido.',
        ]);
    
        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id();
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->phone = $request->phone;
        $ticket->email = $request->email;
        $ticket->status = 'Abierto';
        $ticket->save();
    
        return redirect()->route('tickets')->with('success', 'Ticket creado exitosamente.');
    }
    

    


    }
    
    

