@extends('layout.sidebar')

@section('title', 'Crear Ticket')

@push('styles')
    <style>
        .title-style {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 10px 20px;
            background-color: #131718;
            border-left: 6px solid #ce9d22;
            border-radius: 5px;
        }

        .form-container {
            background-color: #1c1f22;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #343a40;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .form-label {
            font-size: 1.25rem;
            font-weight: bold;
            color: #ffc107;
        }

        .form-control {
            background-color: #333;
            color: #ffc107;
            font-size: 1.2rem;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #555;
        }

        .form-control::placeholder {
            color: #cfae57; /* Un color menos brillante */
            font-style: italic;
            opacity: 0.7; /* Menos opacidad para hacer el placeholder más sutil */
        }

        .form-control:focus {
            background-color: #444;
            border-color: #ce9d22;
            color: #fff;
            box-shadow: 0 0 5px #ce9d22;
        }

        .btn-warning {
            background-color: #ce9d22;
            color: #000;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 8px;
        }

        .btn-warning:hover {
            background-color: #d4a431;
            color: #fff;
        }

        label {
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <h1 class="title-style">Crear un Nuevo Ticket</h1> <!-- Título estilizado -->

        <div class="form-container">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="subject" class="form-label">Asunto:</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Ej: Problema con el pedido" required>
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label">Mensaje:</label>
                    <textarea name="message" id="message" class="form-control" rows="5" placeholder="Describe el problema aquí..." required></textarea>
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">Número de Teléfono (opcional):</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Ej: +54 (123-456-7890)"
                        pattern="^\+?[0-9\s\-()]*$"
                        title="Por favor, ingrese un número de teléfono válido (solo números, espacios, guiones, paréntesis).">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Correo Electrónico (opcional):</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Ej: usuario@dominio.com"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                        title="Por favor, ingrese un correo electrónico válido.">
                </div>

                <button type="submit" class="btn btn-warning w-100">Enviar Ticket</button>
            </form>
        </div>
    </div>
@endsection
