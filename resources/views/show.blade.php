@extends('layout.sidebar')

@section('title', 'Detalles Soporte ')

@push('styles')
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background-color: #1f1f1f;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ffc107;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 1.5rem;
            color: #ffc107;
            margin: 0;
        }

        .details-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .details-table th,
        .details-table td {
            padding: 10px 15px;
            text-align: left;
        }

        .details-table th {
            background-color: #343a40;
            color: #ffc107;
            font-weight: bold;
            border-bottom: 2px solid #ffc107;
        }

        .details-table td {
            background-color: #1f1f1f;
            border-bottom: 1px solid #333;
        }

        .badge {
            background-color: #ffc107;
            color: #000;
            font-size: 0.85rem;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            background-color: #ffc107;
            color: #000;
            border: none;
            padding: 10px 20px;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 5px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn:hover {
            background-color: #e0a800;
            color: #fff;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="header">
        <h1>Detalles Soporte </h1>
    </div>

    <table class="details-table">
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
                <span class="badge {{ $ticket->status === 'abierto' ? '' : 'badge-secondary' }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Creado en</th>
            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $ticket->phone ?? 'No disponible' }}</td>
        </tr>
        <tr>
            <th>Correo</th>
            <td>{{ $ticket->email ?? 'No disponible' }}</td>
        </tr>
    </table>

    <div class="btn-container">
        <a href="{{ route('tickets') }}" class="btn">Volver</a>
    </div>
</div>
@endsection
