@extends('layout.sidebar')

@section('title', 'Añadir reseña')

@push('styles')
<style>
    body {
        background-color: #000;
        color: #ffc107;
    }

    .btn-primary {
        background-color: #333;
        color: #ffc107;
        border: 1px solid #555;
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

    /* Estilo para inputs */
    .container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        position: relative;
        color: white;
        margin-bottom: 30px; /* Separación entre campos */
    }

    .container .label {
        font-size: 15px;
        padding-left: 10px;
        position: absolute;
        top: 13px;
        transition: 0.3s;
        pointer-events: none;
    }

    .input {
        width: 100%;
        height: 45px;
        border: none;
        outline: none;
        padding: 0px 10px;
        border-radius: 6px;
        color: #fff;
        font-size: 15px;
        background-color: transparent;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 1),
                    -1px -1px 6px rgba(255, 255, 255, 0.4);
    }

    .input:focus {
        border: 2px solid transparent;
        color: #fff;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 1),
                    -1px -1px 6px rgba(255, 255, 255, 0.4),
                    inset 3px 3px 10px rgba(0, 0, 0, 1),
                    inset -1px -1px 6px rgba(255, 255, 255, 0.4);
    }

    .container .input:valid ~ .label,
    .container .input:focus ~ .label {
        transition: 0.3s;
        padding-left: 2px;
        transform: translateY(-35px);
    }

    /* Ajuste del diseño de estrellas */
    .radio {
        display: flex;
        justify-content: center;
        gap: 10px; /* Espaciado entre estrellas */
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

    .radio > label:hover > svg,
    .radio > label:hover ~ label > svg {
        fill: #ff9e0b;
        filter: drop-shadow(0 0 15px rgba(255, 158, 11, 0.9));
    }

    .radio > input:checked + label > svg,
    .radio > input:checked + label ~ label > svg {
        fill: #ff9e0b;
        filter: drop-shadow(0 0 15px rgba(255, 158, 11, 0.9));
    }

    /* Separación adicional entre inputs y estrellas */
    .form-section {
        margin-bottom: 30px;
    }

    /* Estilo de los títulos con el botón */
    h1, h2 {
        cursor: pointer;
        position: relative;
        display: inline-block;
        font-size: 2rem;
        color: transparent;
        background-image: linear-gradient(
            90deg,
            hsla(0 0% 100% / 1) 0%,
            hsla(0 0% 100% / 0) 120%
        );
        background-clip: text;
    }

    /* Diseño del botón aplicado al título */
    h1:hover, h2:hover {
        color: hsl(0, 0%, 100%);
        animation: path 1.5s linear 0.5s infinite;
    }

    @keyframes path {
        0%, 34%, 71%, 100% {
            transform: scale(1);
        }
        17% {
            transform: scale(1.2);
        }
        49% {
            transform: scale(1.2);
        }
        83% {
            transform: scale(1.2);
        }

        /* === removing default button style ===*/
        .button {
          margin: 0;
          height: auto;
          background: transparent;
          padding: 0;
          border: none;
          cursor: pointer;
          position: relative;
          font-size: 2em;
          font-family: Arial, sans-serif;
          text-transform: uppercase;
          color: transparent;
          letter-spacing: 3px;
          text-decoration: none;
          -webkit-text-stroke: 1px rgba(255,255,255,0.6);
        }

        /* Styling for the hover text */
        .button .hover-text {
          position: absolute;
          content: attr(data-text);
          color: #37FF8B;
          width: 0%;
          overflow: hidden;
          border-right: 6px solid #37FF8B;
          transition: 0.5s;
          -webkit-text-stroke: 1px rgba(255,255,255,0.6);
        }

        /* This is for the visible text */
        .button .actual-text {
          position: relative;
          color: transparent;
          -webkit-text-stroke: 1px rgba(255,255,255,0.6);
        }

        /* Hover effect */
        .button:hover .hover-text {
          width: 100%;
          filter: drop-shadow(0 0 23px #37FF8B);
        }
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
                <div class="container">
                    <input type="text" id="folio" name="folio" class="input" placeholder=" " required>
                    <label for="folio" class="label">Folio (para calificar la comida):</label>
                </div>

                <!-- Texto de Reseña -->
                <div class="container">
                    <textarea id="contenido" name="contenido" class="input" rows="4" placeholder=" " required></textarea>
                    <label for="contenido" class="label">Reseña:</label>
                </div>

                <!-- Calificación con estrellas -->
                <div class="mb-3">
                    <label class="form-label text-white">Calificación:</label>
                    <div class="radio">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                            <label for="star{{ $i }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.396.195-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.32-.158-.888.283-.95l4.898-.696 2.178-4.455c.197-.403.73-.403.927 0l2.178 4.455 4.898.696c.441.062.612.63.283.95l-3.522 3.356.83 4.73c.078.443-.35.787-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                </div>

                <!-- Botón de Envío -->
                <div class="text-center">
                    <button type="submit" class="button" data-text="Enviar Reseña">
                        <span class="actual-text">&nbsp;Enviar Reseña&nbsp;</span>
                        <span aria-hidden="true" class="hover-text">&nbsp;Enviar Reseña&nbsp;</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'block';

            setTimeout(function() {
                successMessage.style.opacity = 0;
            }, 3000);

            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 4000);
        }
    });
</script>
@endpush
