@extends('layout.sidebar')

@section('title', 'Detalles del Pedido')

@push('styles')
    <style>
        body {
            background-color: #121212; /* Fondo oscuro para toda la página */
            color: #f1f1f1; /* Texto en color blanco suave */
        }

        .container {
            background-color: #2c2f33; /* Fondo gris oscuro para el contenedor */
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
            padding: 30px;
            max-width: 700px;
            margin: 20px auto;
        }

        h2 {
            font-family: 'Roboto', sans-serif;
            color: #f1f1f1; /* Color blanco para el título */
        }

        .card {
            border-radius: 10px;
            background-color: #4caf50; /* Fondo verde suave para la tarjeta */
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
            background-color: #007bff; /* Fondo azul para el botón */
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el cursor */
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            font-size: 1rem;
            color: #f1f1f1; /* Color dorado para el enlace */
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">¡Aquí están los detalles de tu Pedido #{{ $pedido->id }}!</h2>
        <p class="text-center">Fecha del Pedido: {{ $pedido->created_at->format('d-m-Y') }}</p>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Estado: {{ ucfirst($pedido->estado) }}</h5>
                <p class="card-text">Total: ${{ number_format($pedido->total, 2) }}</p>
                <p class="card-text">Pedido realizado por: {{ $pedido->user->name }}</p>
            </div>
        </div>

        <a href="{{ route('historial') }}" class="back-link">Volver al Historial de Pedidos</a>
    </div>
@endsection
