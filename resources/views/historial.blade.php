@extends('layout.sidebar')

@section('title', 'Historial de Pedidos')

@push('styles')
    <style>
        /* Estilos para la vista del historial */
        body {
            background-color: #f7f7f7;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            max-width: 900px;
            margin: 30px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 20px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .table td {
            background-color: #f9f9f9;
            font-size: 1rem;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            color: #007bff;
            font-size: 1rem;
            text-align: center;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Estilos para el botón de volver */
        .btn-back {
            display: block;
            margin-top: 30px;
            background-color: #ff5722;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 1rem;
        }

        .btn-back:hover {
            background-color: #e64a19;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <h2>Historial de Pedidos</h2>

    @if($pedidos->isEmpty())
        <div class="alert-info">
            <strong>No tienes pedidos registrados.</strong> Realiza un pedido para comenzar tu historial.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->created_at->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($pedido->estado) }}</td>
                        <td>${{ number_format($pedido->total, 2) }}</td>
                        <td>
                            <a href="{{ route('historial.detalle', $pedido->id) }}" class="btn-info">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Botón para volver a la página principal -->
    <a href="{{ route('Menu') }}" class="back-link">Volver al Menu</a>
</div>
@endsection
