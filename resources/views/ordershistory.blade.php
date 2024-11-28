@extends('layout.sidebar')

@section('title', 'Historial de Pedidos')

@push('styles')
    <style>
        body {
            background-color: #f1f1f1; 
            color: #333; 
        }

        .container {
            background-color: #fff; 
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 900px;
            margin: 30px auto;
        }

        h2 {
            font-family: 'Roboto', sans-serif;
            font-size: 2rem;
            color: #555; 
        }

        p {
            color: #888; 
            font-size: 1.1rem;
        }

        .table {
            margin-top: 30px;
        }

        .table th {
            background-color: #4CAF50; 
            color: #fff;
            text-align: center;
        }

        .table td {
            text-align: center;
        }

        .btn-info {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .btn-info:hover {
            background-color: #218838; 
        }

        .alert-info {
            background-color: #17a2b8; 
            color: #fff;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .btn-back {
            background-color: #ff5722; 
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .btn-back:hover {
            background-color: #e64a19; 
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">¡Revisa tu Historial de Pedidos!</h2>
        <p class="text-center">Aquí puedes ver todos los pedidos que has realizado. ¡Gracias por confiar en nosotros!</p>
        
        @if($pedidos->isEmpty())
            <div class="alert-info">
                <strong>¡Aún no tienes pedidos!</strong> Realiza un pedido para comenzar tu historial.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Detalles de Pedido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->created_at->format('d-m-Y') }}</td>
                                <td>{{ ucfirst($pedido->estado) }}</td>
                                <td>${{ number_format($pedido->total, 2) }}</td>
                                <td>
                                    <a href="{{ route('pedidos.detalle', $pedido->id) }}" class="btn-info">Ver Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
