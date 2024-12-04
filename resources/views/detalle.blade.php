@extends('layout.sidebar')

@section('title', 'Detalles del Ticket')

@push('styles')
    <style>
        body {
            background-color: #0C1011;
        }

        .title-ticket {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #222;
            border-left: 5px solid #ce9d22;
            border-radius: 5px;
        }

        .card {
            background-color: #131718;
            border: 1px solid #444;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header, .card-footer {
            background-color: #222;
            color: #fff;
            border-bottom: 1px solid #444;
        }

        .card-body {
            background-color: #222;
            color: #ffc107;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #444;
        }

        .table th, .table td {
            padding: 12px;
            vertical-align: middle;
            border: 1px solid #555;
        }

        .table thead th {
            background-color: #131718;
            color: #f39c12;
            text-align: left;
        }

        .table tbody tr:hover {
            background-color: #1a1e21;
        }

        .badge {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 25px;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .badge-secondary {
            background-color: #6c757d;
        }

        .btn-accept {
            font-size: 14px;
            font-weight: bold;
            border: none;
            height: 45px;
            width: 10em;
            border-radius: 1.1em;
            background-color: #212121;
            cursor: pointer;
            color: white;
            transition: box-shadow 0.3s ease-in-out, background-color 0.1s ease-in-out, transform 0.1s ease-in-out;
        }

        .btn-accept:hover {
            box-shadow: 1px 3px 3px #121212, 0px 0px 13px #303030b6;
        }

        .btn-accept:active {
            box-shadow: 1px 3px 3px #121212, 0px 0px 13px #303030b6, 0px 0px 10px 5px rgb(13, 118, 136);
            background-color: rgb(13, 118, 136);
            transform: scale(0.9);
        }
    </style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title title-ticket">Detalles del Ticket</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th class="head">Asunto</th>
                    <td>{{ $ticket->subject }}</td>
                </tr>
                <tr>
                    <th class="head">Mensaje</th>
                    <td>{{ $ticket->message }}</td>
                </tr>
                <tr>
                    <th class="head">Estado</th>
                    <td>
                        <span class="badge 
                            @if ($ticket->status == 'abierto') badge-success 
                            @elseif ($ticket->status == 'cerrado') badge-secondary 
                            @else badge-warning 
                            @endif">
                            {{ ucfirst($ticket->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="head">Creado en</th>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th class="head">Teléfono del Usuario</th>
                    <td>{{ $ticket->phone ?? 'No disponible' }}</td>
                </tr>
                <tr>
                    <th class="head">Correo Electrónico</th>
                    <td>{{ $ticket->email ?? 'No disponible' }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('tickets') }}" class="btn-accept">Volver a la lista de tickets</a>
        </div>
    </div>
</div>
@endsection
