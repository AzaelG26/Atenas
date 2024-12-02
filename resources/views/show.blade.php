@extends('layout.sidebar')

@section('title', 'Detalles del Ticket')

@push('styles')
    <style>
        body {
            background-color: #000;
            color: #ffc107;
        }

        .btn-warning, .btn-primary {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-warning:hover, .btn-primary:hover {
            background-color: #e0a800;
            color: #fff;
        }

        .card {
            background-color: #333;
            color: #ffc107;
            border-radius: 8px;
            border: none;
            margin-top: 20px;
        }

        .card-header {
            background-color: #444;
            color: #ffc107;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            background-color: #333;
            color: #ffc107;
            padding: 20px;
        }

        .card-footer {
            background-color: #444;
            color: #ffc107;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            padding: 15px;
        }

        .table {
            width: 100%;
            background-color: #444;
            color: #ffc107;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #555;
        }

        .table th {
            background-color: #555;
            color: #ffc107;
        }

        .table td {
            background-color: #333;
        }

        .badge {
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            font-weight: bold;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge:hover {
            background-color: #218838;
        }

        .text-warning {
            color: #ffc107 !important;
        }

    </style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Detalles del Ticket</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Asunto</th>
                    <td>{{ $ticket->subject }}</td>
                </tr>
                <tr>
                    <th>Mensaje</th>
                    <td>{{ $ticket->message }}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>
                        <span class="badge 
                            {{ $ticket->status === 'abierto' ? 'badge-success' : 'badge-secondary' }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Creado en</th>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Teléfono del Usuario</th>
                    <td>{{ $ticket->phone ?? 'No disponible' }}</td>
                </tr>
                <tr>
                    <th>Correo Electrónico</th>
                    <td>{{ $ticket->email ?? 'No disponible' }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('tickets') }}" class="btn btn-primary">Volver a la lista de tickets</a>
        </div>
    </div>
</div>
@endsection
