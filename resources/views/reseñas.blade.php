@extends('layout.sidebar')

@section('title', 'Añadir reseña')
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

        /* Estilos para las estrellas */
        .radio {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-direction: row-reverse;
        }

        .radio > input {
            position: absolute;
            appearance: none;
        }

        .radio > label {
            cursor: pointer;
            font-size: 30px;
            position: relative;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .radio > label > svg {
            fill: #666;
            transition: fill 0.3s ease;
        }

        .radi
@push('styles')
   o > label:hover > svg,
        .radio > label:hover ~ label > svg {
            fill: #ff9e0b;
            filter: drop-shadow(0 0 15px rgba(255, 158, 11, 0.9));
        }

        .radio > input:checked + label > svg,
        .radio > input:checked + label ~ label > svg {
            fill: #ff9e0b;
            filter: drop-shadow(0 0 15px rgba(255, 158, 11, 0.9));
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

                    <!-- Campo de Folio -->
                    <div class="mb-3">
                        <label for="folio" class="form-label text-white">Folio (para calificar la comida):</label>
                        <input type="text" id="folio" name="folio" class="form-control" placeholder="Escribe el folio de tu pedido" required>
                    </div>

                    <!-- Calificación con estrellas -->
                    <div class="mb-3">
                        <label class="form-label text-white">Calificación:</label>
                        <div class="radio">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                        </div>
                    </div>

                    <!-- Texto de Reseña -->
                    <div class="mb-3">
                        <label for="contenido" class="form-label text-white">Reseña:</label>
                        <textarea id="contenido" name="contenido" class="form-control" rows="4" placeholder="Escribe tu reseña aquí..." required></textarea>
                    </div>

                    <!-- Botón de Envío -->
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
