
@extends('layout.sidebar')    

@section('title', 'Añadir reseña')

@push('styles')    
    <!-- Bootstrap CSS -->
    <style>
        body {
            background-color: #000; /* Fondo negro */
            color: #ffc107; /* Texto amarillo */
        }

        .form-control,
        .btn-primary {
            background-color: #333; /* Fondo oscuro */
            color: #ffc107; /* Texto amarillo */
        }

        .btn-primary:hover {
            background-color: #555; /* Fondo más claro al pasar el mouse */
        }

        .navbar, footer {
            background-color: #000; /* Fondo negro */
            color: #ffc107; /* Texto amarillo */
        }
    </style>
@endpush


@section('content') 
    <header class="bg-dark text-center py-3">
        <h1 class="text-warning">Reseñas</h1>
    </header>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-warning text-center">Agrega tu reseña</h2>
                <form action="{{ route('reseñas.store') }}" method="POST" class="mt-4">
                    @csrf
                    
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" id="correo" name="correo" class="form-control" placeholder="Escribe tu correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Reseña</label>
                        <textarea id="contenido" name="contenido" class="form-control" rows="4" placeholder="Escribe tu reseña aquí..." required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Enviar Reseña</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-center py-3 mt-5">
        <p class="mb-0">&copy; 2024 Reseñas. Todos los derechos reservados.</p>
    </footer>
@endsection
