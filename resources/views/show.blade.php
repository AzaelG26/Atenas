@extends('layout.sidebar')

@section('title', 'Detalles del Ticket')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Detalles del Ticket</h1>
        </div>
        <div class="card-body">
            <h5 class="card-title"><strong>Asunto:</strong> {{ $ticket->subject }}</h5>
            <p class="card-text"><strong>Mensaje:</strong> {{ $ticket->message }}</p>
            <p class="card-text"><strong>Estado:</strong> 
                <span class="badge 
                    {{ $ticket->status === 'abierto' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </p>
            <p class="card-text"><strong>Creado en:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
            
            <p class="card-text"><strong>Teléfono del Usuario:</strong> {{ $ticket->phone ?? 'No disponible' }}</p>
            <p class="card-text"><strong>correo Electronico:</strong> {{ $ticket->email ?? 'No disponible' }}</p>
         
        </div>
        <div class="card-footer">
            <a href="{{ route('tickets') }}" class="btn btn-primary">Volver a la lista de tickets</a>
        </div>
    </div>
</div>
@endsection
