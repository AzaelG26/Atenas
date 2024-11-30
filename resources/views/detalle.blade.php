@extends('layout.sidebar')

@section('title', 'Detalles del Pedido')

@push('styles')
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1; 
        }

        .container {
            background-color: #2c2f33;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
            padding: 30px;
            max-width: 700px;
            margin: 20px auto;
        }

        h2 {
            font-family: 'Roboto', sans-serif;
            color: #f1f1f1; 
        }

        .card {
            border-radius: 10px;
            background-color: #4caf50; 
            color: white;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .btn-primary {
            background-color: #007bff; 
            border: none;
            padding: 12px 25px;
            font-size: 1.1rem;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3; 
        }

        .btn-primary:focus {
            outline: none;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">¡Aquí están los detalles de tu Pedido #{{ $order->id_order }}!</h2>
        <p class="text-center">Fecha de Tu Pedido: {{ $order->created_at->format('d-m-Y') }}</p>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Estado: {{ ucfirst($order->status) }}</h5>
                <p class="card-text">Total: ${{ number_format($order->total_price, 2) }}</p>
                <p class="card-text">Pedido realizado por: {{ $order->employee->name }}</p>
            </div>
        </div>

        <a href="{{ route('orders.index') }}" class="btn-primary">Volver al Historial de Pedidos</a>
    </div>
@endsection
