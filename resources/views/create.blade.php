@extends('layout.sidebar')

@section('title', 'Crear Ticket')

@section('content')
    <div class="container mt-5">
        <h1 class="text-warning">Crear un Nuevo Ticket</h1>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label text-warning">Asunto:</label>
                <input type="text" name="subject" id="subject" class="form-control bg-dark text-warning" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label text-warning">Mensaje:</label>
                <textarea name="message" id="message" class="form-control bg-dark text-warning" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label text-warning">Número de Teléfono (opcional):</label>
                <input type="text" name="phone" id="phone" class="form-control bg-dark text-warning" placeholder="Ej: +54 (123-456-7890)"
                    pattern="^\+?[0-9\s\-()]*$"
                    title="Por favor, ingrese un número de teléfono válido (solo números, espacios, guiones, paréntesis).">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-warning">Correo Electrónico (opcional):</label>
                <input type="email" name="email" id="email" class="form-control bg-dark text-warning" placeholder="Ej: usuario@dominio.com"
                    pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                    title="Por favor, ingrese un correo electrónico válido.">
            </div>

            <button type="submit" class="btn btn-warning text-dark">Enviar Ticket</button>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        body {
            background-color: #000;
            color: #ffc107;
        }

        .form-control,
        .btn-warning {
            background-color: #333;
            color: #ffc107;
        }

        .form-control:focus,
        .btn-warning:hover {
            background-color: #555;
            color: #fff;
        }

        .navbar, footer {
            background-color: #000;
            color: #ffc107;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none; 
        }
    </style>
@endpush
