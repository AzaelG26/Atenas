@extends('layout.sidebar')

@section('title', 'Lista de Tickets')

@push('styles')
    <style>
        body {
            background-color: #000;
            color: #ffc107;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .list-group-item {
            background-color: #333;
            color: #ffc107;
            border: 1px solid #444;
        }

        .list-group-item:hover {
            background-color: #444;
            color: #fff;
        }

        .badge {
            background-color: #28a745;
            color: #000;
        }

        .badge:hover {
            background-color: #218838;
            color: #fff;
        }

        .list-group-item-action {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        .bg-info:hover {
            background-color: #138496 !important;
        }

        /* Estilos para el botón de crear ticket */
        .create-ticket-btn {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .create-ticket-btn:hover {
            background-color: #e0a800;
            color: #fff;
        }

        /* Estilo de la etiqueta "Ver detalles" */
        .badge {
            background-color: #ffffff;
            color: #000;
        }

        .badge:hover {
            background-color: #e0a800;
            color: #fff;
        }

    </style>
@endpush

@section('content')
    <div class="container mt-5">
        <h1 class="display-4 text-center text-warning mb-4">Lista de Tickets</h1>

        <!-- Botón para crear un nuevo ticket -->
        <a href="{{ route('tickets.create') }}" class="btn btn-warning text-dark mb-4 create-ticket-btn">Crear un nuevo ticket</a>

        <div class="list-group">
            @foreach($tickets as $ticket)
                <a href="{{ route('tickets.show', $ticket->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2 rounded">
                    <div>
                        <h5 class="mb-1">{{ $ticket->subject }}</h5>
                        <p class="mb-1">Estado: <strong>{{ $ticket->status }}</strong></p>
                        <small>Creado el: {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }}</small>
                    </div>
                    <span class="badge rounded-pill">Ver detalles</span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
