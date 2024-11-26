@extends('layout.sidebar')

@section('title', 'Añadir reseña')

@push('styles')
    <style>
        body {
            background-color: #000;
            color: #ffc107;
        }

        .form-control,
        .btn-primary {
            background-color: #333;
            color: #ffc107;
        }

        .btn-primary:hover {
            background-color: #555;
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

@section('content')
    <header class="bg-dark text-center py-3">
        <h1 class="text-warning">Reseñas</h1>
    </header>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-warning text-center">Agrega tu reseña</h2>

                {{-- Mostrar mensaje de éxito solo si existe --}}
                @if(session('success'))
                    <div class="alert alert-success" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('reseñas.store') }}" method="POST" class="mt-4">
                    @csrf
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

@push('scripts')
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                
                successMessage.style.display = 'block';

                
                setTimeout(function() {
                    successMessage.style.transition = 'opacity 1s ease'; 
                    successMessage.style.opacity = 0; 
                }, 300); 

              
                setTimeout(function() {
                    successMessage.style.display = 'none';
                    successMessage.style.opacity = 1; 
                }, 600);
            }
        });
    </script>
@endpush
