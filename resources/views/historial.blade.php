@extends('layout.sidebar')

@section('title', 'Historial de Pedidos')

@push('styles')
    <style>
        body {
            background-color: #f1f1f1; /* Fondo claro y suave */
            color: #333; /* Texto oscuro para mejor contraste */
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            margin: 20px auto;
        }

        h2 {
            color: #333; /* Títulos en un gris oscuro */
            font-size: 2rem;
            font-weight: 600;
        }

        p {
            font-size: 1.1rem;
            color: #555; /* Texto más claro para la información */
            margin-bottom: 20px;
        }

        .alert {
            background-color: #f8d7da; /* Fondo suave para la alerta */
            color: #721c24; /* Texto en color rojo para el mensaje */
            border-radius: 10px;
            padding: 15px;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #007bff; /* Fondo azul para las cabeceras */
            color: white;
        }

        .table td {
            background-color: #f9f9f9; /* Fondo claro para las celdas */
        }

        .btn-info {
            background-color: #17a2b8; /* Botón de información */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn-info:hover {
            background-color: #138496; /* Hover en el botón */
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            font-size: 1rem;
            color: #007bff; /* Color azul para el enlace */
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">Historial de Pedidos</h2>
        <p class="text-center">Revisa los pedidos realizados.</p>

        @if($pedidos->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                <strong>No tienes pedidos anteriores.</strong> Realiza un pedido para comenzar tu historial.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->created_at->format('d-m-Y') }}</td>
                                <td>{{ ucfirst($pedido->estado) }}</td>
                                <td>${{ number_format($pedido->total, 2) }}</td>
                                <td>
                                    <a href="{{ route('pedidos.detalle', $pedido->id) }}" class="btn btn-info">Ver Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('home') }}" class="back-link">Volver a la página principal</a>
    </div>
@endsection
