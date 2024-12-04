@extends('layout.sidebar')

@section('title', 'Añadir Reseña')

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

    .container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        position: relative;
        color: white;
        margin-bottom: 30px;
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
</style>
@endpush

@section('content')
<header class="bg-dark text-center py-3">
    <h1 class="text-warning">Reviews</h1>
</header>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-warning text-center">Agrega tu Reseña</h2>

            {{-- Mostrar mensaje de éxito solo si existe --}}
            @if(session('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('review.store') }}" method="POST" class="mt-4">

                @csrf

          
                <div class="container">
                    <input type="text" id="folio" name="folio" class="input" placeholder=" " required>
                    <label for="folio" class="label">Folio (para calificar la comida):</label>
                </div>

           
                <div class="container">
                    <textarea id="contenido" name="contenido" class="input" rows="4" placeholder=" " required></textarea>
                    <label for="contenido" class="label">Review:</label>
                </div>

          
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

              
                <div class="text-center">
                    <button type="submit" class="btn-primary">Enviar Review</button>
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
